<div>
    @if (session()->has('success'))
        <div class="py-3 px-5 w-full text-lg font-bold text-white bg-emerald-600">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('danger'))
        <div class="py-3 px-5 w-full text-lg font-bold text-white bg-rose-600">
            {{ session('danger') }}
        </div>
    @endif
    @if (session()->has('info'))
        <div class="py-3 px-5 w-full text-lg font-bold text-white bg-rose-600">
            {{ session('info') }}
        </div>
    @endif

    <div class="w-full h-screen bg-gradient-to-br from-slate-900 via-slate-900 to-slate-900">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col">
                <div class="-mb-2 py-8 flex flex-wrap flex-grow justify-between">
                    <div>
                        <x-jet-input id="search" class=" w-full" type="search" placeholder="Search..." name="search"
                            wire:model="search" />
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="group">
                            <select name="page" id="page" wire:model="perPage"
                                class="border-slate-600 bg-transparent text-white focus:border-sky-500 rounded-md shadow-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="border"></span>
                        <x-jet-button type="button" wire:click="createShowModal">
                            Create a new post
                        </x-jet-button>

                        {{-- sytax @if dan @endif tidak dapat digunakan ke component seperti x-jet-button --}}
                        <button type="button" wire:click="selectShowModal"
                            class="inline-flex items-center px-4 py-2 bg-rose-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-rose-600 active:bg-rose-900 focus:outline-none focus:border-rose-900 focus:ring focus:ring-rose-300 disabled:opacity-25 transition"
                            @if ($bulkDisabled) disabled @endif>
                            Select Delete
                        </button>
                    </div>
                </div>
                <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block w-full overflow-x-auto shadow-sm sm:rounded-lg border-b border-slate-600">
                        <table class="min-w-full">
                            <thead>
                                <tr
                                    class="bg-slate-600 border-b border-slate-800 text-xs leading-4 text-slate-100 uppercase tracking-wider">
                                    <th class="px-6 py-3 text-left font-semibold">
                                        <x-jet-checkbox id="select_all" wire:model="selectAll" />
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold">
                                        Title
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold">
                                        Slug
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold">
                                        User
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold">
                                        Category
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-slate-700">
                                @forelse ($items as $item)
                                    <tr
                                        class="hover:bg-slate-800 text-white hover:shadow-xl transition-transform hover:-translate-y-1 duration-300">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-black/50">
                                            <x-jet-checkbox id="select_all" wire:model="selectItem"
                                                value="{{ $item->id }}" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-black/50">
                                            {{ $item->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-black/50">
                                            {{ $item->slug }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-black/50">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-black/50">
                                            {{ $item->category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-black/50">
                                            <div class="flex items-center justify-end space-x-4">
                                                <button type="button"
                                                    wire:click="updateShowModal({{ $item->id }})">
                                                    <x-icon-edit
                                                        class="w-4 h-4 fill-current text-blue-500 hover:text-gray-500 hover:w-6 hover:h-6 transition-all duration-300" />
                                                </button>
                                                <button type="button"
                                                    wire:click="deleteShowModal({{ $item->id }})">
                                                    <x-icon-trash
                                                        class="w-4 h-4 fill-current text-rose-500 hover:text-gray-500 hover:w-6 hover:h-6 transition-all duration-300" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4 font-semibold text-gray-100 bg-blue-400 text-center capitalize"
                                            colspan="6">
                                            no result posts data !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">

                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <x-jet-dialog-modal wire:model="modalFormVisible">
            <x-slot name="title">
                @if ($modelIds)
                    {{ __('update Post') }}
                @else
                    {{ __('Create Post') }}
                @endif
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 mb-3">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title"
                        :value="old('title')" autocomplete="title" />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mb-3">
                    <x-jet-label for="body" value="{{ __('Body') }}" />
                    <x-jet-input id="body" type="text" class="mt-1 block w-full" wire:model.defer="body"
                        :value="old('body')" autocomplete="body" />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mb-3">
                    <x-jet-label for="category" value="{{ __('Category') }}" />
                    <select name="category" id="category" wire:model="category"
                        class="w-full bg-transparent text-white border-gray-600 focus:border-sky-500 rounded-md shadow-sm">
                        <option value="">Choose a Category ...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        <x-jet-input-error for="category" class="mt-2" />
                    </select>
                </div>
                <div x-data="{ thumbnailName: null, thumbnailPreview{{ $iterator }}: null }" class="col-span-6 sm:col-span-4 mb-3">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" wire:model="thumbnail" x-ref="thumbnail"
                        id="thumbnail{{ $iterator }}"
                        x-on:change="
                                        thumbnailName = $refs.thumbnail.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            thumbnailPreview{{ $iterator }} = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.thumbnail.files[0]);
                                " />

                    <x-jet-label for="thumbnail" value="{{ __('Thumbnail') }}" />

                    <!-- Current Profile thumbnail -->
                    @if ($modelIds && $load->thumbnail)
                        <div class="mt-2" x-show="!thumbnailPreview{{ $iterator }}">
                            <img src="{{ asset('/storage/' . $load->thumbnail) }}" alt="{{ $load->title }}"
                                class="rounded-md h-40 w-40 object-center object-cover">
                        </div>
                    @endif

                    <!-- New Profile thumbnail Preview -->
                    @if ($thumbnail !== null)
                        <div class="mt-2" x-show="thumbnailPreview{{ $iterator }}" style="display: none;">
                            <span class="block rounded-md w-40 h-40 bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + thumbnailPreview{{ $iterator }} + '\');'">
                            </span>
                        </div>
                    @endif

                    <x-jet-secondary-button class="mt-2 mr-2" type="button"
                        x-on:click.prevent="$refs.thumbnail.click()">
                        {{ __('Select A New thumbnail') }}
                    </x-jet-secondary-button>

                    @if ($modelIds)
                        @if ($load->thumbnail !== null)
                            <x-jet-secondary-button type="button" class="mt-2" wire:click="destroyThumbnail">
                                {{ __('Remove Thumbnail') }}
                            </x-jet-secondary-button>
                        @endif
                    @endif

                    <x-jet-input-error for="thumbnail" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                @if ($modelIds)
                    <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                @else
                    <x-jet-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
                        {{ __('Submit') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
        <div>
            <x-jet-dialog-modal wire:model="modalDeleteVisible">
                <x-slot name="title">
                    {{ __('Delete Post') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to delete this post? Once this post is deleted, all of its resources and data will be permanently deleted.') }}

                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalDeleteVisible')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-3" wire:click="destroy" wire:loading.attr="disabled">
                        {{ __('Delete Post') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
        <div>
            <x-jet-dialog-modal wire:model="modalSelectVisible">
                <x-slot name="title">
                    {{ __('Delete Post by selected') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to delete selected post? Once selected post is deleted, all of its resources and data will be permanently deleted.') }}

                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalSelectVisible')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-3" wire:click="destroyForSelect" wire:loading.attr="disabled">
                        {{ __('Delete Post') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>
