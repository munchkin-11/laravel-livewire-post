@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'bg-transparent text-white border-gray-600 focus:border-sky-500 focus:outline-none rounded-md shadow-sm',
]) !!}>
