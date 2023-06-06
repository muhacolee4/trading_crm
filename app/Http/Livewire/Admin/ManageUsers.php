<?php

namespace App\Http\Livewire\Admin;

use App\Models\Deposit;
use App\Models\Kyc;
use App\Models\Plans;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use App\Models\User;
use App\Models\User_plans;
use App\Models\Withdrawal;
use App\Traits\PingServer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\Component;

class ManageUsers extends Component
{
    use WithPagination, PingServer;

    protected $paginationTheme = 'bootstrap';
    public $pagenum = 10;
    public $searchvalue = '';
    public $orderby = 'id';
    public $orderdirection = 'desc';
    public $selectPage = false;
    public $selectAll = false;
    public $checkrecord = [];
    public $selected = '';
    public $action = 'Delete';
    public $username;
    public $fullname;
    public $email;
    public $password;
    public $message;
    public $subject;
    public $plan;
    public $datecreated;
    public $topamount;
    public $toptype;
    public $topcolumn = "Bonus";
    public $userTypes = "All";

    protected $rules = [
        'fullname' => 'required|max:255',
        'username' => 'required|unique:users,username',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8',
    ];


    public function getUsersProperty()
    {

        return User::search($this->searchvalue)
            ->orderBy($this->orderby, $this->orderdirection)
            ->paginate($this->pagenum);
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->checkrecord = $this->users->pluck('id')->map(fn ($id) => (string) $id);
        }
        return view('livewire.admin.manage-users', [
            'users' => $this->users,
            'plans' => Plans::all(),
        ]);
    }

    public function updatedCheckrecord()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checkrecord = $this->users->pluck('id')->map(fn ($id) => (string) $id);
        } else {
            $this->checkrecord = [];
        }
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }


    public function saveUser()
    {

        $this->validate();

        $thisid = DB::table('users')->insertGetId([
            'name' => $this->fullname,
            'email' => $this->email,
            'ref_by' => NULL,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        //assign referal link to user
        $settings = Settings::where('id', '=', '1')->first();
        $user = User::where('id', $thisid)->first();

        User::where('id', $thisid)
            ->update([
                'ref_link' => $settings->site_address . '/ref/' . $user->username,
            ]);

        session()->flash('success', 'User created Sucessfully!');
        return redirect()->route('manageusers');
    }

    public function addRoi()
    {

        $users = DB::table('users')
            ->whereIn('id', $this->checkrecord)
            ->get();
        $plan = Plans::where('id', $this->plan)->first();

        foreach ($users as $user) {
            $userplans = User_plans::where('user', $user->id)->where('plan', $plan->id)->where('active', 'yes')->get();
            if (count($userplans) > 0) {

                foreach ($userplans as $uplan) {

                    $amount = $uplan->amount * $plan->increment_amount / 100;

                    $newt = new Tp_Transaction();
                    $newt->user = $user->id;
                    $newt->plan = $plan->name;
                    $newt->amount = $amount;
                    $newt->type = 'ROI';
                    $newt->user_plan_id = $uplan->id;
                    $newt->created_at = Carbon::parse($this->datecreated);
                    $newt->updated_at = Carbon::parse($this->datecreated);
                    $newt->save();

                    User::where('id', $user->id)
                        ->update([
                            'roi' => $user->roi + $amount,
                            'account_bal' => $user->account_bal + $amount,
                        ]);

                    $dplan = User_plans::where('id', $uplan->id)->first();
                    $dplan->profit_earned = $uplan->profit_earned + $amount;
                    $dplan->save();
                }
            }
        }

        session()->flash('success', 'Action Successful');
        return redirect()->route('manageusers');
    }


    public function topup()
    {
        $users = DB::table('users')
            ->whereIn('id', $this->checkrecord)
            ->get();

        foreach ($users as $user) {

            $response = $this->callServer('typesystem', '/top-up', [
                'topUpType' => $this->toptype,
                'userBalance' => $user->account_bal,
                'userRoi' => $user->roi,
                'userRef' => $user->ref_bonus,
                'userBonus' => $user->bonus,
                'type' => $this->topcolumn,
                'amount' => $this->topamount,
            ]);

            if ($response->failed()) {
                return redirect()->route('manageusers')->with('message', $response['message']);
            }

            $formatResponse = json_decode($response);

            if ($formatResponse->data->whatType == "Bn2r5u8x/A?D(G+KbPeShVkYp3s6v9yonus") {
                User::where('id', $user->id)
                    ->update([
                        'bonus' => $formatResponse->data->bonus,
                        'account_bal' => $formatResponse->data->accountBalance,
                    ]);
            } elseif ($formatResponse->data->whatType == "A?D(G+KbPeShVkYp3s6v9yB&E)H@Mc") {
                User::where('id', $user->id)
                    ->update([
                        'account_bal' =>  $formatResponse->data->accountBalance,
                    ]);
            }

            //add history
            Tp_Transaction::create([
                'user' => $user->id,
                'plan' =>  $formatResponse->data->type,
                'amount' => $this->topamount,
                'type' => $this->topcolumn,
            ]);
        }

        session()->flash('success', 'Action Successful');
        return redirect()->route('manageusers');
    }

    //Delete user
    public function delsystemuser()
    {

        $users = DB::table('users')
            ->whereIn('id', $this->checkrecord)
            ->get();

        foreach ($users as $user) {

            if ($this->action == 'Delete') {
                //delete the user's withdrawals and deposits
                $deposits = Deposit::where('user', $user->id)->get();
                if (!empty($deposits)) {
                    foreach ($deposits as $deposit) {
                        Deposit::where('id', $deposit->id)->delete();
                    }
                }
                $withdrawals = Withdrawal::where('user', $user->id)->get();
                if (!empty($withdrawals)) {
                    foreach ($withdrawals as $withdrawals) {
                        Withdrawal::where('id', $withdrawals->id)->delete();
                    }
                }
                //delete the user plans
                $userp = User_plans::where('user', $user->id)->get();
                if (!empty($userp)) {
                    foreach ($userp as $p) {
                        //delete plans that their owner does not exist 
                        User_plans::where('id', $p->id)->delete();
                    }
                }

                // delete user from verification list
                if (DB::table('kycs')->where('user_id', $user->id)->exists()) {
                    Kyc::where('user_id', $user->id)->delete();
                }


                User::where('id', $user->id)->delete();
            }

            if ($this->action == 'Clear') {

                $deposits = Deposit::where('user', $user->id)->get();
                if (!empty($deposits)) {
                    foreach ($deposits as $deposit) {
                        Deposit::where('id', $deposit->id)->delete();
                    }
                }

                $withdrawals = Withdrawal::where('user', $user->id)->get();
                if (!empty($withdrawals)) {
                    foreach ($withdrawals as $withdrawals) {
                        Withdrawal::where('id', $withdrawals->id)->delete();
                    }
                }

                User::where('id', $user->id)->update([
                    'account_bal' => '0',
                    'roi' => '0',
                    'bonus' => '0',
                    'ref_bonus' => '0',
                ]);
            }
        }

        session()->flash('success', 'Action successful!');
        return redirect()->route('manageusers');
    }
}