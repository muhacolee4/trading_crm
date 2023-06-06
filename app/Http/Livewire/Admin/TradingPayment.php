<?php

namespace App\Http\Livewire\Admin;

use App\Traits\PingServer;
use Livewire\Component;
use Livewire\WithFileUploads;

class TradingPayment extends Component
{
    public $amount;
    public $toPay;
    public $wallet;
    public $walletAddress;
    public $method;
    public $screenshot;
    use WithFileUploads;
    use PingServer;

    public function mount()
    {
        $response = $this->fetctApi('/settings');
        $this->toPay = false;
        $this->method = $response['data']['currency_name'];
        $this->walletAddress =  $response['data']['wallet_address'];
        $this->wallet = $response['data'];
    }

    public function render()
    {
        return view('livewire.admin.trading-payment');
    }

    public function setToPay()
    {
        $this->toPay = true;
    }

    public function unSetToPay()
    {
        $this->toPay = false;
    }


    public function completePayment()
    {
        $response = $this->fetctApi('/save-payment', [
            'amount' => $this->amount,
        ], 'POST');

        if ($response->failed()) {
            session()->flash('message', $response['message']);
        } else {
            session()->flash('success', $response['message']);
        }
        return redirect()->route('tra.pay');
    }
}