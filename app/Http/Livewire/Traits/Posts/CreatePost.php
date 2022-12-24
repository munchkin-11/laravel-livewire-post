<?php

namespace App\Http\Livewire\Traits\Posts;


trait CreatePost
{
    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();

        $this->modalFormVisible = true;
    }

    public function modelDataCreate()
    {
        if (isset($this->thumbnail)) {
            $path = $this->thumbnail->store('posts', 'public');
        }

        $post = $this->model();
        $post->title = $this->title;
        $post->slug = $this->strHelper()->slug($this->title);
        $post->body = $this->body;
        $post->thumbnail = $path ?? null;

        $post->user()->associate(auth()->user());

        $category = $this->categoryModel()->findOrFail($this->category);
        $post->category()->associate($category);

        $post->save();

        return $post;
    }

    public function store()
    {
        $this->validate();
        $this->modelDataCreate()->save();
        $this->modalFormVisible = false;
        $this->reset();
        $this->thumbnail = null;
        $this->iterator++;
        session()->flash('success', 'Success to create new post');
    }
}
