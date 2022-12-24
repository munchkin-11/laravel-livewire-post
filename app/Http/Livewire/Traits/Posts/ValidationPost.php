<?php

namespace App\Http\Livewire\Traits\Posts;


trait ValidationPost
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'body' => 'required',
            'thumbnail' => 'nullable|mimes:jpg,png,jpeg',
            'category' => 'required'
        ];
    }
}
