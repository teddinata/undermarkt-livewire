<?php

namespace App\Http\Livewire\Console\Orders;

use App\Invoice;
use Livewire\Component;

class Show extends Component
{
     /**
     * public variable
     */
    public $invoice;

    /**
     * mount or construct function
     */
    public function mount($id)
    {
        $this->invoice  = Invoice::find($id);
    }

    public function render()
    {
        return view('livewire.console.orders.show');
    }
}
