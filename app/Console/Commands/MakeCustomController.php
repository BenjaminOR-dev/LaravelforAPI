<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\StubsHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

/**
 * MakeCustomController
 *
 * @package App\Console\Commands
 * @author Ing. Benjamin Olvera Rosales
 */
class MakeCustomController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:customController {nombreArchivo?} {--api=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un archivo Controller';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $fileName;
    public $nameService;

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
            'nombreArchivo' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $this->error("\n[ERROR] No se pudo completar la acción debido a errores en los parámetros\n");
            foreach ($validator->errors()->all() as $error) {
                $this->warn(" - {$error}\n");
            }
            exit;
        }

        $this->fileName = Str::ucfirst(Str::camel($this->argument('nombreArchivo')));

        if ($this->option('api') != 'null') { //Controller api
            $this->createController('api');
            $this->createService('api');
        } else {
            $this->createController();
            $this->createService();
        }

        $this->info("El comando se ha ejecutado correctamente!");
    }

    /**
     * Create Service
     *
     * @param string $option
     *
     * @return void
     */
    public function createService(?string $option = null)
    {
        if (!$option) {
            $this->nameService = $this->fileName;
        } else {
            $this->nameService = ($this->option($option) != '') ? $this->option($option) : $this->fileName;
        }

        $this->nameService = Str::ucfirst($this->nameService);
        $pathService = base_path('app\\Services') . '\\' . "{$this->nameService}Service.php";

        if (!File::exists($pathService)) {
            $plus = ($option == 'api') ? '--api' : '';
            Artisan::call("make:service {$this->nameService} {$plus}");
        } else {
            $this->warn("\n[ATENCIÓN] El Service '{$this->nameService}.php' ya existe\n");
        }
    }

    /**
     * Create file api routes
     */
    public function createController(?string $type = null)
    {
        $fileApiPath = base_path('app\\Http\\Controllers') . '\\' . "{$this->fileName}Controller.php";

        if (!File::exists($fileApiPath)) {
            if ($type == 'api') {
                $stub = $this->getStubApiPath();
            } else {
                $stub = $this->getStubPath();
            }

            File::put($fileApiPath, StubsHelper::getSourceFile($stub, $this->getStubData()));
        } else {
            $this->warn("\n[ATENCIÓN] El Controller '{$this->fileName}.php' ya existe\n");
        }
    }

    /**
     * Return the stub file path
     *
     * @return string
     */
    public function getStubPath()
    {
        return base_path('stubs') . '\\' . 'controller.custom.plain.stub';
    }

    /**
     * Return the stub file path
     *
     * @return string
     */
    public function getStubApiPath()
    {
        return base_path('stubs') . '\\' . 'controller.custom.api.stub';
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
            'classNameController' => $this->fileName,
            'classNameService'    => $this->nameService,
        ];
    }
}
