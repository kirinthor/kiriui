<?php

namespace kiriui;
use kiriui\Components\BladeComponent;
use kiriui\Components\LivewireComponent;

use kiriui\Console\PublishCommand;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
final class kiriuiServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->mergeConfigFrom(__DIR__.'/../config/kiriui.php', 'kiriui');
	}

	public function boot()	: void
	{
		$this->bootResources();
		$this->bootBladeComponents();
		$this->bootLivewireComponents();
		$this->bootDirectives();
		$this->bootPublishing();
	}

	private function bootResources(): void
	{
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'kiriui');
	}

	private function bootBladeComponents(): void
	{
		$this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
			$prefix = config('kiriui.prefix', '');
			$assets = config('kiriui.assets', []);


			foreach (config('kiriui.components', []) as $alias => $component) {
				$blade->component($component, $alias, $prefix);

				$this->registerAssets($component, $assets);
			}
		});
	}

	private function bootLivewireComponents(): void
	{
		// Skip if Livewire isn't installed.
		if (! class_exists(Livewire::class)) {
			return;
		}

		$prefix = config('kiriui.prefix', '');
		$assets = config('kiriui.assets', []);

		/** @var LivewireComponent $component */
		foreach (config('kiriui.livewire', []) as $alias => $component) {
			$alias = $prefix ? "$prefix-$alias" : $alias;

			Livewire::component($alias, $component);

			$this->registerAssets($component, $assets);
		}
	}

	private function registerAssets($component, array $assets): void
	{
		foreach ($component::assets() as $asset) {
			$files = (array) ($assets[$asset] ?? []);

			collect($files)->filter(function (string $file) {
				return Str::endsWith($file, '.css');
			})->each(function (string $style) {
				kiriui::addStyle($style);
			});

			collect($files)->filter(function (string $file) {
				return Str::endsWith($file, '.js');
			})->each(function (string $script) {
				kiriui::addScript($script);
			});
		}
	}

	private function bootDirectives(): void
	{
		Blade::directive('kiriStyles', function (string $expression) {
			return "<?php echo kiriui\\kiriui::outputStyles($expression); ?>";
		});

		Blade::directive('kiriScripts', function (string $expression) {
			return "<?php echo kiriui\\kiriu::outputScripts($expression); ?>";
		});
	}

	private function bootPublishing(): void
	{
		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__.'/../config/kiriui.php' => $this->app->configPath('kiriui.php'),
			], 'kiriui-config');

			$this->publishes([
				__DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/kiriui'),
			], 'kiriui-views');
			$this->publishes([
				__DIR__.'/../dist' => $this->app->resourcePath('dist/vendor/kiriui'),
			], 'kiriui-dist');
		}
	}
}
