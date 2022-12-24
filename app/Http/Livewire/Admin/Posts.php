<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\Posts\{VariablePost, ValidationPost, HelperPost, CreatePost, DestroyPost, UpdatePost};
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Posts extends Component
{
    // di Livewire jka ingin menggunkan pagination , harus menggunakan ini
    use WithPagination;
    // di Livewire jka ingin menggunkan upload file , harus menggunakan ini
    use WithFileUploads;
    // Dipisahkan ke App\Http\Livewire\Traits\Posts , ini tidak harus, hanya untuk kerapihan dan selera melihat code
    use VariablePost, HelperPost, ValidationPost, CreatePost, UpdatePost, DestroyPost;

    public function mount()
    {
        $this->resetPage();
        // mengambil dari input search
        $this->search = request()->query('search', $this->search);
        // menghitung post jika di select
        $this->selectItem = collect();
    }

    public function read()
    {
        // menampilkan data post
        // Penjelasan :

        // maksud dari kondisi ini "$this->search === null" Jika input search kosong
        return $this->search === null ?
            $this->model()->with(['user', 'category']) // tampilkan tanpa ada scope search yang ada di model
            ->latest()
            ->paginate($this->perPage) :
            $this->model()->with(['user', 'category']) // kebalikannya jika ada input search tampilkan ini
            ->latest()
            ->search(trim($this->search))
            ->paginate($this->perPage);
    }

    public function render()
    {
        // enable button jika ada table yang di pilih
        $this->bulkDisabled = count($this->selectItem) < 1;

        $categories = $this->categoryModel()->orderBy('name', 'asc')->get();

        return view('livewire.admin.posts', [
            'items' => $this->read(),
            'categories' => $categories
        ]);
    }
}
