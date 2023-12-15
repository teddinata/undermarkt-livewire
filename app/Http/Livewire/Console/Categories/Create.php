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
        $this->validate([
            'image' => 'image|max:102400', // .5MB Max
            // 'image'    => 'required|image',
            'name'     => 'required',
        ]);

        $this->image->store('public/categories');

        $category = Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-'),
            'image'=> $this->image->hashName()
        ]);

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
