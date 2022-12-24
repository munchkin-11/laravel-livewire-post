<?php

namespace App\Http\Livewire\Traits\Posts;


trait DestroyPost
{
    public function selectShowModal()
    {
        $this->resetValidation();
        $this->modalSelectVisible = true;
    }

    public function destroyForSelect()
    {

        $post = $this->model();
        $selected = $post->query()->whereIn('id', $this->selectItem);
        foreach ($selected->get() as $value) {
            $this->storageHelper()->disk('public')->delete($value->thumbnail);
        }
        $selected->delete();

        $this->selectItem = [];
        $this->selectAll = false;
        $this->modalSelectVisible = false;
        $this->resetValidation();
        session()->flash('danger', 'Success to delete post by select');
    }

    public function deleteShowModal($ids)
    {
        $this->resetValidation();
        $this->reset();
        $this->destroyIds = $ids;
        $this->modalDeleteVisible = true;
    }

    public function destroy()
    {
        $post = $this->model()->findOrFail($this->destroyIds);
        $post->delete();
        $this->modalDeleteVisible = false;
        session()->flash('danger', 'Success deleted a post');
    }

    public function destroyThumbnail()
    {
        $post = $this->model()->findOrFail($this->modelIds);
        $this->storageHelper()->disk('public')->delete($post->thumbnail);
        $post->thumbnail = null;
        $post->save();
        $this->modalFormVisible = false;
        session()->flash('danger', 'Success deleted a thumbnail post');
    }
}
