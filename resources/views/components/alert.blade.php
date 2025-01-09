<div x-data="{ open: true }" x-show="open" x-transition class="flex p-4 mb-3 rounded-lg mt-3" :class="{
    'bg-green-100 border-l-4 border-green-500 text-green-800': '{{ $type }}' === 'success',
    'bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800': '{{ $type }}' === 'warning',
    'bg-red-100 border-l-4 border-red-500 text-red-800': '{{ $type }}' === 'danger',
}">
    <div class="flex-grow">
        <p>{{ $message }}</p>
    </div>
    <button @click="open = false" class="ml-4 text-gray-500 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>