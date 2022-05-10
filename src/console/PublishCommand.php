<?php

namespace kiriui\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'kiriui:publish {component}
                            {--view : Publicar solo la vista del componente}
                            {--force : Sobreescribre los archivos}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publicar la vista y la clase de un componente.';

	public function handle(Filesystem $filesystem): int
	{
		$components = config('kiriui.components');
		$alias = $this->argument('component');

		if (! $component = $components[$alias] ?? null) {
			$this->error("No se puede encontrar el componente [$alias] proporcionado. ");

			return 1;
		}

		$class = str_replace('kiriui\\Components\\', '', $component);
		$view = str_replace(['_', '.-'], ['-', '/'], Str::snake(str_replace('\\', '.', $class))).'.blade.php';


		if ($this->option('view') || ! $this->option('class') || ! $this->option('dist')) {
			$originalView = __DIR__.'/../../resources/views/components/'.$view;
			$publishedView = $this->laravel->resourcePath('views/vendor/blade-ui-kit/components/'.$view);
			$path = Str::beforeLast($publishedView, '/');

			if (! $this->option('force') && $filesystem->exists($publishedView)) {
				$this->error("The view at [$publishedView] already exists.");

				return 1;
			}

			$filesystem->ensureDirectoryExists($path);

			$filesystem->copy($originalView, $publishedView);

			$this->info('Successfully published the component view!');
		}


		return 0;
	}
}
