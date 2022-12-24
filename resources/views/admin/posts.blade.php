<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-100 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    @livewire('admin.posts')
</x-app-layout>
