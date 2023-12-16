<?php

namespace App\Http\Livewire\Console\Vouchers;

use App\Voucher;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;


    /**
     * public variable
     */
    public $title;
    public $voucher;
    public $nominal_voucher;
    public $total_minimal_shopping;
    public $content;
    public $image;

    /**
     * store function
     */
    public function store()
    {
        $this->validate([
            'image'             => 'nullable|image',
            'title'             => 'required',
            'voucher'           => 'required',
            'nominal_voucher'   => 'required',
            'total_minimal_shopping' => 'required',
            'content'                => 'required'
        ]);

        // $this->image->store('public/vouchers');

        if ($this->image) {
            $extension = pathinfo($this->image->getFilename(), PATHINFO_EXTENSION);

            // Validasi ekstensi file gambar
            if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif', 'jpg'])) {
                $this->reset('image');
                // Atau tambahkan pesan kesalahan jika perlu
                $this->addError('image', 'Invalid image format. Please upload a valid image.');
                return;
            }

            // Lanjutkan dengan penyimpanan dan pembuatan Category jika validasi berhasil
            $this->image->store('public/vouchers');

            $voucher = Voucher::create([
                'title'                     => $this->title,
                'voucher'                   => $this->voucher,
                'nominal_voucher'           => $this->nominal_voucher,
                'total_minimal_shopping'    => $this->total_minimal_shopping,
                'content'                   => $this->content,
                'image'                     => $this->image->hashName()
            ]);

            // Tambahkan logika atau tindakan lain setelah pembuatan Category
        }

        // jika tidak ada gambar yang diunggah
        $voucher = Voucher::create([
            'title'                     => $this->title,
            'voucher'                   => $this->voucher,
            'nominal_voucher'           => $this->nominal_voucher,
            'total_minimal_shopping'    => $this->total_minimal_shopping,
            'content'                   => $this->content,
            'image'                     => 'noimage.png'
        ]);


        if($voucher) {
            session()->flash('success', 'Data Voucher saved successfully');
        } else {
            session()->flash('error', 'Data Voucher failed to save');
        }

        return redirect()->route('console.vouchers.index');
    }

    public function render()
    {
        return view('livewire.console.vouchers.create');
    }
}
