<?php

namespace App\Http\Livewire\Console\Categories;

use App\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    /**
    * public variable
    */
    public $name;
    public $image;

    /**
     * store function
     */
    public function store()
    {
        // $extension = pathinfo($this->image->getFilename(), PATHINFO_EXTENSION) ?? '';
        // if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif', 'jpg'])) {
        //     $this->reset('image');
        // }
        // $this->validate([
        //     'image' => 'image|max:102400', // .5MB Max
        //     // 'image'    => 'required|image',
        //     'name'     => 'required',
        // ]);

        // $this->image->store('public/categories');

        // $category = Category::create([
        //     'name' => $this->name,
        //     'slug' => Str::slug($this->name, '-'),
        //     'image'=> $this->image->hashName()
        // ]);
        // Validasi apakah file gambar diunggah
    $this->validate([
        'image' => 'required|image|max:102400', // .5MB Max
        'name'  => 'required',
    ]);

    // Pengecekan apakah file gambar tersedia
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
        $this->image->store('public/categories');

        $category = Category::create([
            'name'  => $this->name,
            'slug'  => Str::slug($this->name, '-'),
            'image' => $this->image->hashName(),
        ]);

        // Tambahkan logika atau tindakan lain setelah pembuatan Category
    }

    // Jika file gambar tidak diunggah, tangani sesuai kebutuhan
    // ...

    // Reset nilai input setelah proses selesai
    $this->reset(['name', 'image']);

        if($category) {
            session()->flash('success', 'Data saved successfully');
        } else {
            session()->flash('error', 'Data failed to save');
        }

        return redirect()->route('console.categories.index');

    }

    public function render()
    {
        return view('livewire.console.categories.create');
    }
}
