<?php

namespace Akunbeben\Laravository\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand
{
  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'make:repository';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new Repository class';

  /**
   * The type of class being generated.
   *
   * @var string
   */
  protected $type = 'Repository';

  public function handle()
  {
    // First we need to ensure that the given name is not a reserved word within the PHP
    // language and that the class name will actually be valid. If it is not valid we
    // can error now and prevent from polluting the filesystem using invalid files.
    if ($this->isReservedName($this->getNameInput())) {
      $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

      return false;
    }

    $name = $this->qualifyClass($this->getNameInput());

    $path = $this->getPath($name);

    // Next, We will check to see if the class already exists. If it does, we don't want
    // to create the class and overwrite the user's code. So, we will bail out so the
    // code is untouched. Otherwise, we will continue generating this class' files.
    if ((!$this->hasOption('force') ||
        !$this->option('force')) &&
      $this->alreadyExists($this->getNameInput())
    ) {
      $this->error($this->type . ' already exists!');

      return false;
    }

    if ($this->option('model')) {
      $this->createModel();
    }

    $this->createInterface();

    // Next, we will generate the path to the location where this class' file should get
    // written. Then, we will build the class and make the proper replacements on the
    // stub files so that it gets the correctly formatted namespace and class name.
    $this->makeDirectory($path);

    $this->files->put($path, $this->sortImports($this->buildClass($name)));

    $this->info($this->type . ' created successfully.');
  }

  /**
   * Create Model file
   * 
   * @return void
   */
  protected function createModel()
  {
    $this->call('make:model', [
      'name' => $this->argument('name'),
    ]);
  }

  /**
   * Create Interface file
   * 
   * @return void
   */
  protected function createInterface()
  {
    $this->call('make:repository-interface', [
      'name' => $this->getNameInput() . 'Interface'
    ]);
  }

  /**
   * Replace the namespace for the given stub.
   *
   * @param  string  $stub
   * @param  string  $name
   * @return $this
   */
  protected function replaceNamespace(&$stub, $name)
  {
    $searches = [
      ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
      ['{{ namespace }}', '{{ rootNamespace }}', '{{ namespacedUserModel }}'],
      ['{{namespace}}', '{{rootNamespace}}', '{{namespacedUserModel}}'],
    ];

    foreach ($searches as $search) {
      $stub = str_replace(
        $search,
        [$this->getNamespace($name), $this->rootNamespace(), $this->userProviderModel()],
        $stub
      );
    }

    return $this;
  }

  /**
   * Get the model for the default guard's user provider.
   *
   * @return string|null
   */
  protected function userProviderModel()
  {
    return $this->argument('name');
  }

  /**
   * Get the desired class name from the input.
   *
   * @return string
   */
  protected function getNameInput()
  {
    return trim($this->argument('name') . 'Repository');
  }

  /**
   * Get the stub file for the generator.
   *
   * @return string
   */
  protected function getStub()
  {
    return __DIR__ . '/../Stub/repository.stub';
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the model to which the repository will be generated'],
    ];
  }

  /**
   * Get the default namespace for the class.
   *
   * @param  string  $rootNamespace
   * @return string
   */
  protected function getDefaultNamespace($rootNamespace)
  {
    return $rootNamespace . '\Repositories\Eloquent';
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [
      ['model', 'm', InputOption::VALUE_NONE, 'Create a new model for the repository'],
    ];
  }
}
