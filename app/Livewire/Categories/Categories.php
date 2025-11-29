<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Categories as ModelsCategories;

class Categories extends Component
{
    protected $listeners = [
        'deleteCategory' => 'delete'
    ];
    
    public function delete($id)
    {
        $category = ModelsCategories::find($id);

        if (! $category) {
            $this->js(<<<JS
            Swal.fire({
                icon: 'error',
                title: 'Kategori tidak ditemukan',
                showConfirmButton: false,
                timer: 1500
            });
        JS);
            return;
        }

        $category->delete();

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Category deleted successfully!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
    }

    public function render()
    {
        $categories = ModelsCategories::all();
        return view('livewire.categories.categories', [
            'categories' => $categories
        ]);
    }
}
