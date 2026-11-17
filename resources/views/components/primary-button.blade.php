<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#22AF85] border border-transparent rounded-xl font-bold text-sm text-white hover:bg-[#178a67] focus:outline-none focus:ring-2 focus:ring-[#22AF85]/40 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
