<?php

namespace kiriui\Components\Buttons;
use Illuminate\Contracts\View\View;
use kiriui\Components\BladeComponent;

class Button extends BladeComponent
{
	public function render(): view{
		return \view('kiriui::components.button');
	}
}
