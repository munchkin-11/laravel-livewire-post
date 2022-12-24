<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-sky-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring focus:ring-sky-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
