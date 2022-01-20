<x-form.field>
    <button type="submit"
    {{ $attributes->class(['uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600',
    'bg-blue-500 text-white' => !$attributes['outline'],
    'text-blue border border-blue-600 hover:text-white' => $attributes['outline'],
    ]) }} 
    >
        {{ $slot }}
    </button>
</x-form.field>
