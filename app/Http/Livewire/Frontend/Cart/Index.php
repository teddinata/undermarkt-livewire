<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Facades\Cart;
use Livewire\Component;

class Index extends Component
{
    /**
     * public variable
     */
    public $cart;

    /**
     * mount or construct function
     */
    public function mount()
    {
        //dd(array(Cart::get()['products']));
        $this->cart = Cart::get();
        //dd(array($this->cart));

        //if cart empty
        if(count(array(Cart::get()['products'])) == 0) {
            return redirect()->route('root');
        }
    }

    /**
     * remove cart
     */
    public function removeCart($productId)
    {
        Cart::remove($productId);
        $this->cart = Cart::get();
        $this->emit('removeCart');
        //alert message
        $this->emit('alert', ['type' => 'success', 'message' => 'Product remove from cart.']);
    }

    public function render()
    {
        return view('livewire.frontend.cart.index');
    }
}
