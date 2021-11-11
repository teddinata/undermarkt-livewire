<?php

namespace App\Http\Livewire\Console\Payment;

use App\PaymentInformation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    /**
     * search
     */
    protected $updatesQueryString = ['search'];

    public function render()
    {
        if($this->search != "") {

            $payments = PaymentInformation::where('invoice', 'like', '%' .$this->search. '%')->latest()->paginate(10);

        } else {

            $payments = PaymentInformation::latest()->paginate(10);

        }

        return view('livewire.console.payment.index', [
            'payments' => $payments
        ]);
    }
}
