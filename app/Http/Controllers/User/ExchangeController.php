<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CryptoAccount;
use Illuminate\Support\Facades\Auth;
use App\Models\SettingsCont;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\CryptoRecord;
use App\Traits\Apitrait;

class ExchangeController extends Controller
{
    use Apitrait;

    public function assetview()
    {
        $settings = SettingsCont::where('id', '1')->first();
        if ($settings->use_crypto_feature == 'false') {
            abort(404);
        }

        return view('user.asset', [
            'title' =>  'Exchange currency',
            'cbalance' => CryptoAccount::where('user_id', Auth::user()->id)->first(),
        ]);
    }

    public function history()
    {
        return view('user.crypto-transaction', [
            'title' => 'Swapping History',
            'transactions' => DB::table('crypto_records')->orderByDesc('id')->paginate(10),
        ]);
    }

    public function getprice($base, $quote, $amount)
    {

        $settings = SettingsCont::where('id', '1')->first();
        $pluscharge = $amount * $settings->fee / 100;
        $amout_to = $amount - $pluscharge;

        if ($quote == "usd") {
            $dollar = $this->get_rate($base, 'usd');
            $mainbal = $amout_to * $dollar;
            $prices = round($mainbal, 8);
        } elseif ($base == "usd" and $quote != 'usdt') {
            $dollar =  $this->get_rate($quote, 'usd');
            $mainbal = $amout_to / $dollar;
            $prices = round($mainbal, 8);
        } elseif ($quote == "usdt") {
            // $dollar =  $this->get_rate($base,'usd');
            // $mainbal = $amout_to * $dollar;
            $prices = round($amout_to, 8);
        } elseif ($base == "usdt") {
            $dollar =  $this->get_rate($quote, 'usd', "price");
            $mainbal = $amout_to / $dollar;
            $prices = round($mainbal, 8);
        } elseif ($base !== "usd" && $quote !== "usd") {
            $rate1 =  $this->get_rate($base, 'usd', "price");
            $rate2 =  $this->get_rate($quote, 'usd', "price");
            $real_rate = $rate1 / $rate2;
            $mainbal = $amout_to * $real_rate;
            $prices = round($mainbal, 8);
        }
        if (($base == "usd" && $quote == "usdt") or ($base == "usdt" && $quote == "usd")) {
            $prices = $amout_to;
        }

        return response()->json(['status' => 200, 'data' => $prices]);
    }


    public function exchange(Request $request)
    {

        $cryptobalances = CryptoAccount::where('user_id', Auth::user()->id)->first();
        $acntbal = Auth::user()->account_bal;
        $src = $request->source;
        $cdest = $request->destination;
        $user = User::find(Auth::user()->id);

        if ($request->source == 'usd') {
            if ($acntbal < $request->amount) {
                return response()->json(['status' => 201, 'message' => 'Insuficient fund in your source account']);
            }

            User::where('id', Auth::user()->id)->update([
                'account_bal' => $acntbal - $request->amount,
            ]);

            if ($request->destination == 'btc') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'btc' => $cryptobalances->btc + $request->quantity,
                    ]);
            }
            if ($request->destination == 'eth') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'eth' => $cryptobalances->eth + $request->quantity,
                    ]);
            }
            if ($request->destination == 'link') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'link' => $cryptobalances->link + $request->quantity,
                    ]);
            }
            if ($request->destination == 'usdt') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'usdt' => $cryptobalances->usdt + $request->quantity,
                    ]);
            }
            if ($request->destination == 'ltc') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'ltc' => $cryptobalances->ltc + $request->quantity,
                    ]);
            }
            if ($request->destination == 'bch') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'bch' => $cryptobalances->bch + $request->quantity,
                    ]);
            }
            if ($request->destination == 'xrp') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'xrp' => $cryptobalances->xrp + $request->quantity,
                    ]);
            }
            if ($request->destination == 'bnb') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'bnb' => $cryptobalances->bnb + $request->quantity,
                    ]);
            }
            if ($request->destination == 'ada') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'ada' => $cryptobalances->ada + $request->quantity,
                    ]);
            }
            if ($request->destination == 'xlm') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'xlm' => $cryptobalances->xlm + $request->quantity,
                    ]);
            }
            if ($request->destination == 'aave') {
                DB::table('crypto_accounts')
                    ->where('user_id', $user->id)
                    ->update([
                        'aave' => $cryptobalances->aave + $request->quantity,
                    ]);
            }

            $record = new CryptoRecord();
            $record->source = strtoupper($request->source);
            $record->dest = strtoupper($request->destination);
            $record->amount = $request->amount;
            $record->quantity = $request->quantity;
            $record->save();

            return response()->json(['status' => 200, 'success' => 'Exchange Successful, Refreshing your Balances']);
        }

        if ($request->source != 'usd' and  $request->destination != 'usd') {

            if ($cryptobalances->$src < $request->amount) {
                return response()->json(['status' => 201, 'message' => 'Insuficient fund in your source account']);
            }

            // $acnt = CryptoAccount::find($cryptobalances->id);
            // $acnt->$src = $cryptobalances->$src  - $request->amount;
            // $acnt->$cryptobalances->cdest = $cryptobalances->cdest + $request->quantity;
            // $acnt->save();


            CryptoAccount::where('user_id', $user->id)
                ->update([
                    $request->source => $cryptobalances->$src - $request->amount,
                ]);

            CryptoAccount::where('user_id', $user->id)
                ->update([
                    $request->destination => $cryptobalances->$cdest + $request->quantity,
                ]);

            $record = new CryptoRecord();
            $record->source = strtoupper($request->source);
            $record->dest = strtoupper($request->destination);
            $record->amount = $request->amount;
            $record->quantity = $request->quantity;
            $record->save();

            return response()->json(['status' => 200, 'success' => 'Exchange Successful, Refreshing your Balances']);
        }

        if ($request->source != 'usd' and  $request->destination == 'usd') {

            if ($cryptobalances->$src < $request->amount) {
                return response()->json(['status' => 201, 'message' => 'Insuficient fund in your source account']);
            }

            DB::table('crypto_accounts')
                ->where('user_id', $user->id)
                ->update([
                    $request->source => $cryptobalances->$src - $request->amount,
                ]);

            User::where('id', Auth::user()->id)->update([
                'account_bal' => $acntbal + $request->quantity,
            ]);

            $record = new CryptoRecord();
            $record->source = strtoupper($request->source);
            $record->dest = strtoupper($request->destination);
            $record->amount = $request->amount;
            $record->quantity = $request->quantity;
            $record->save();

            return response()->json(['status' => 200, 'success' => 'Exchange Successful, Refreshing your Balances']);
        }
    }

    public function getBalance($coin)
    {
        $settings = Settings::where('id', '1')->first();
        $settingss = SettingsCont::where('id', '1')->first();
        $user = Auth::user();
        $acntbals = DB::table('crypto_accounts')->where('user_id', $user->id)->first();

        if (empty($acntbals->$coin)) {
            $balanc = 0;
        } else {
            $balanc = $acntbals->$coin;
        }

        $dollar = $this->get_rate($coin, 'usd');
        $mainbal = $balanc * $dollar;

        if ($settings->s_currency == 'USD') {
            $price = number_format(round($mainbal));
        } else {
            if (empty($settingss->currency_rate)) {
                $rate = 1;
            } else {
                $rate = $settingss->currency_rate;
            }

            $othercurr = $mainbal * $rate;
            $price = number_format(round($othercurr));
        }

        return response()->json([
            'data' => $price,
            'status' => 200
        ]);
    }
}