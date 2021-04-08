<?php

namespace Akunbeben\Laravository\Console;

use Illuminate\Console\GeneratorCommand;

class RepositoryProviderMakeCommand extends GeneratorCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $name = 'repository:provider';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install the Repository Service Provider';

  /**
   * The type of class being generated.
   *
   * @var string
   */
  protected $type = 'Repository';

  /**
   * Get the desired class name from the input.
   *
   * @return string
   */
  protected function getNameInput()
  {
    return 'RepositoryServiceProvider';
  }

  protected function getArguments()
  {
    return [];
  }

  /**
   * Get the stub file for the generator.
   *
   * @return string
   */
  protected function getStub()
  {
    return __DIR__ . '/../Stub/provider.stub';
  }

  /**
   * Get the default namespace for the class.
   *
   * @param  string  $rootNamespace
   * @return string
   */
  protected function getDefaultNamespace($rootNamespace)
  {
    return $rootNamespace . '\Providers';
  }
}
