@props(['disabled' => false, 'rows' => 3, 'value' => '', 'placeholder' => ''])

<textarea rows="{{ $rows }}" @disabled($disabled) placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
@if ($value)
    {{ $value }}
@endif
</textarea>