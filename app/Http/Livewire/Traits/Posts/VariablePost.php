<?php

namespace App\Http\Livewire\Traits\Posts;


trait VariablePost
{
    public $title;
    public $slug;
    public $body;
    public $thumbnail;

    public $category;

    public $perPage = 5;
    public $search = '';

    public $selectItem = [];
    public $selectAll = false;

    public $bulkDisabled = true;

    protected $updateQueryString = ['search'];

    public int $iterator = 0;

    public $modelIds;
    public $destroyIds;

    public $load;

    public $modalFormVisible = false;
    public $modalSelectVisible = false;
    public $modalDeleteVisible = false;
    public $modalRestoreVisible = false;
}
