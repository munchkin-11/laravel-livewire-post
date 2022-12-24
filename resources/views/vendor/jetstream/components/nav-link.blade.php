@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-sky-400 text-sm font-medium leading-5 text-white focus:outline-none focus:border-sky-700 transition' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-100 hover:text-slate-200 hover:border-sky-700 focus:outline-none focus:text-gray-200 focus:border-sky-600 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
