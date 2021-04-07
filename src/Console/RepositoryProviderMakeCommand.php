<?php

namespace Akunbeben\Laravository\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class RepositoryProviderMakeCommand extends GeneratorCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $name = 'repository:install';

  /**
   * Replace the class name for the given stub.
   *
   * @param  string  $stub
   * @param  string  $name
   * @return string
   */
  protected function replaceClass($stub, $name = 'RepositoryServiceProvider')
  {
    $stub = parent::replaceClass($stub, $name);
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
