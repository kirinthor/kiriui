<?php

namespace kiriui\Component;

use Livewire\Component;

abstract class LivewireComponent extends Component
{
	/** @var array */
	protected static $assets = [];

	public static function assets(): array
	{
		return static::$assets;
	}
}
