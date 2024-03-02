<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\ServiceProviderInjector;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class RepositoryMakeCommand extends GeneratorCommand
{
    use ServiceProviderInjector;

    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new Repository class';

    public function handle()
    {
        $name = $this->extractName($this->argument('name'));
        $codeToAdd = "\n\t\t\$this->app->bind(\n" .
            "\t\t\t\\App\\Interfaces\\Eloquent" . str_replace('/', '\\', $name) . "RepositoryInterface::class,\n" .
            "\t\t\t\\App\\Repositories\\" . str_replace('/', '\\', $this->argument('name')) . "::class\n" .
            "\t\t);\n";

        $repositoryServiceProvider = app_path('Providers/RepositoryServiceProvider.php');

        $this->injectCodeToRegisterMethod($repositoryServiceProvider, $codeToAdd);

        Artisan::call('make:interface', [
            'name' => 'Eloquent' . $name . 'RepositoryInterface'
        ]);

        Artisan::call('make:service', [
            'name' => $name . 'Service'
        ]);
        return parent::handle();
    }

    protected function getStub()
    {
        $path = __DIR__ . '/stubs/repository.stub';
        return $path;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Repositories';
    }

    private function extractName(string $name): string
    {
        $pattern = '/^Eloquent(.*)Repository$/';
        $matches = [];
        preg_match($pattern, $name, $matches);
        $word = $matches[1];
        return $word;
    }
}