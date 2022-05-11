@php
	$tag = $href ? 'a' : 'button';

	$defaultAttributes = [
		'wire:loading.attr'  => 'disabled',
		'wire:loading.class' => '!cursor-wait',
	];

	$href === null
		? $defaultAttributes['type'] = 'button'
		: $defaultAttributes['href'] = $href;
@endphp
<{{ $tag }} {{ $attributes->merge($defaultAttributes) }}>
	@if ($icon)
		<i class="{{$icon}} ri-lg"></i>
	@endif
	{{ $label ?? $slot }}
</{{ $tag}}>
