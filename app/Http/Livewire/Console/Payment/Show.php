<?php

namespace App\Http\Livewire\Console\Payment;

use App\PaymentInformation;
use Livewire\Component;

class Show extends Component
{
    public $payment;

    public function mount($id)
    {
        $this->payment = PaymentInformation::find($id);
    }

    public function render()
    {
        return view('livewire.console.payment.show');
    }
}
