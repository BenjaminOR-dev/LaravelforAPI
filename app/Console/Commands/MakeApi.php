<?php

namespace App\Console\Commands;

use App\Helpers\VarHelper;
use Illuminate\Support\Str;
use App\Helpers\StubsHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

/**
 * MakeApi
 *
 * @package App\Console\Commands
 * @author Ing. Benjamin Olvera Rosales
 */
class MakeApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api {nombreArchivo?} {--cs=null} {--csa=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un archivo de rutas API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $fileName;
    public $makeController = false;
    public $nameController = '';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $validator = Validator::make(array_merge($this->arguments(), $this->options()), [
            'nombreArchivo'  => ['required', 'string', 'max:255'],
            'cs'             => ['nullable', 'string', 'max:255'],
            'csa'            => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $this->error("\n[ERROR] No se pudo completar la acción debido a errores en los parámetros\n");
            foreach ($validator->errors()->all() as $error) {
                $this->warn(" - {$error}\n");
            }
            exit;
        }

        $this->fileName = Str::camel($this->argument('nombreArchivo'));

        if ($this->option('cs') != 'null') { //Controller
            $this->createController('cs');

        } elseif ($this->option('csa') != 'null') { //Controller API
            $this->createController('csa');
        }

        $this->createFileApiRoute();
        $this->info("El comando se ha ejecutado correctamente!");
    }

    /**
     * Create Controller
     *
     * @param string $option
     *
     * @return void
     */
    public function createController(string $option)
    {
        $this->nameController = ($this->option($option) != '') ? $this->option($option) : $this->fileName;
        $this->nameController = Str::ucfirst($this->nameController);
        $pathController = base_path('app\\Http\\Controllers') . '\\' . "{$this->nameController}.php";

        if (!File::exists($pathController)) {
            $plus = ($option == 'csa') ? '--api' : '';
            Artisan::call("make:customController {$this->nameController} {$plus}");
        } else {
            $this->warn("\n[ATENCIÓN] El archivo de controlador '{$this->nameController}.php' ya existe\n");
        }

        $this->makeController = true;
    }

    /**
     * Create file api routes
     */
    public function createFileApiRoute()
    {
        $fileApiPath = base_path('routes\\api') . "\\{$this->fileName}.php";
        if (!File::exists($fileApiPath)) {
            File::put($fileApiPath, StubsHelper::getSourceFile($this->getStubPath(), $this->getStubData()));
        } else {
            $this->warn("\n[ATENCIÓN] El archivo de rutas api '{$this->fileName}.php' ya existe\n");
        }
    }

    /**
     * Return the stub file path
     *
     * @return string
     */
    public function getStubPath()
    {
        if ($this->makeController) {
            return base_path('stubs') . '\\' . 'fileApi.controller.stub';
        } else {
            return base_path('stubs') . '\\' . 'fileApi.stub';
        }
    }

    /**
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubData()
    {
        return [
            'fileName'       => VarHelper::camelCaseToSpaces(Str::ucfirst($this->fileName)),
            'fileNameSlug'   => Str::slug(VarHelper::camelCaseToSpaces($this->fileName), '-', 'es'),
            'nameController' => "{$this->nameController}Controller"
        ];
    }
}
