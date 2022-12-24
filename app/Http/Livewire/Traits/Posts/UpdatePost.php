<?php

namespace App\Http\Livewire\Traits\Posts;


trait UpdatePost
{

    public function loadModel()
    {
        $this->load = $this->model()->findOrFail($this->modelIds);
        $this->title = $this->load->title;
        $this->slug = $this->load->slug;
        $this->body = $this->load->body;
        $this->thumbnail = $this->load->thumbnail;
        $this->category = $this->load->category_id;
    }

    public function updateShowModal($ids)
    {
        $this->resetValidation();
        $this->reset();
        $this->modelIds = $ids;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    public function modelDataUpdate()
    {
        $post = $this->model()->findOrFail($this->modelIds);

        if ($this->thumbnail !== null) {
            $path = $this->thumbnail->store('posts', 'public');
            if ($path) $this->storageHelper()->disk('public')->delete($post->thumbnail);
            $post->thumbnail = $path;
            $post->save();
        }

        $post->title = $this->title;
        $post->slug = $this->strHelper()->slug($this->title);
        $post->body = $this->body;
        $post->thumbnail = $path ?? null;

        $category = $this->categoryModel()->findOrFail($this->category);
        $post->category()->associate($category);

        $post->user()->associate(auth()->user());

        $post->save();

        return $post;
    }

    public function update()
    {
        $this->validate();
        $this->modelDataUpdate()->save();
        $this->modalFormVisible = false;
        $this->iterator++;
        $this->thumbnail = null;
        session()->flash('info', 'Success updated a post');
    }
}
