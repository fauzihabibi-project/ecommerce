<?php

namespace App\Livewire\Categories;

use App\Models\Categories;
use Livewire\Component;

class EditCategory extends Component
{
    public $categoryId;
    public $name;

    // Jalankan saat komponen di-mount (terbuka)
    public function mount($id)
    {
        $category = Categories::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    // Simpan hasil edit
    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $this->categoryId,
        ]);

        $category = Categories::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
        ]);

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Category updated successfully!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);

        return redirect()->route('categories');
    }

    public function render()
    {
        return view('livewire.categories.edit-category');
    }
}
