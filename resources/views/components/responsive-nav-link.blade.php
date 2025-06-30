@props(['active'])

@php
$classes = ($active ?? false)
    ? 'menu-link px-3 py-2 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300'
    : 'menu-link px-3 py-2 text-gray-600 dark:text-gray-400 hover:text-red-700 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-800 transition duration-150 ease-in-out';
@endphp

<div class="menu-item px-3 my-0">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        
        <span class="menu-icon" data-kt-element="icon">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </span>
        <span class="menu-title">
            {{ $slot }}
        </span>
    </a>
</div>
