<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateServiceCommand extends Command
{
    public $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:service {name} {model_class_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $model_class_name = $this->argument('model_class_name');

        $this->convertPascalToSnakeCase($model_class_name);

        $path = $this->getPath($name);
        $class_name = $this->getClassName($path);

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name, $model_class_name));
        
        // dd($namespace, $path, $class_name);

        // $UpperCamelCaseName = 

        // preg_replace();
    }

    public function getClassNameSpace($name)
    {
        $root_namespace = $this->getRootNamespace();

        // Trim the front whitespace
        $name = ltrim($name, '\\/');

        // Replace backslash to regular slash
        $name = str_replace('/', '\\', $name);

        $class_namespace = Str::replaceFirst($root_namespace, '', $name);

        return $root_namespace ."Services";
    }

    public function getRootNamespace()
    {
        return $this->laravel->getNamespace();
    }

    public function getClassName($name)
    {
        $class_name = explode('/', $name)
            [count(explode('/', $name)) - 1];

        return $class_name;
    }

    public function getPath($name)
    {
        $name = Str::replaceFirst($this->getRootNamespace(), '', $name);

        return $this->laravel['path'].'/Services/'.str_replace('\\', '/', $name).'.php';
    }

    public function getStubPath($name)
    {
        return $this->laravel['path'].'/Console/stubs/'.$name;
    }

    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    protected function buildClass($name, $model_class_name)
    {
        $replace = [];

        $class_name = $this->getClassName($name);

        $replace_words = [
            "{{ namespace }}" => $this->getClassNameSpace($name),
            "{{ model_class_name }}" => $model_class_name,
            "{{ model_variable_name }}" => $this->convertPascalToSnakeCase($model_class_name),
            "{{ serviceClassName }}" => $class_name,
        ];

        return str_replace(
            array_keys($replace_words),
            array_values($replace_words),
            $this->files->get($this->getStubPath("controller.service.stub"))
        );
    }

    protected function convertPascalToSnakeCase($string)
    {
        $result = preg_replace("/([A-Z])/", '_$1', $string);
        $result = strtolower(trim($result, "_"));

        return $result;
    }
}
