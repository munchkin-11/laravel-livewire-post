@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-slate-100']) }}>
    {{ $value ?? $slot }}
</label>
