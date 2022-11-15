<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\StubsHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

/**
 * MakeService
 *
 * @package App\Console\Commands
 * @author Ing. Benjamin Olvera Rosales
 */
class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {nombreArchivo?} {--api=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un archivo Service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $fileName;

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

        $this->fileName = Str::ucfirst(Str::camel($this->argument('nombreArchivo'))) . 'Service';

        if ($this->option('api') != 'null') { //Service api
            $this->createService('api');
        } else {
            $this->createService();
        }

        $this->info("El comando se ha ejecutado correctamente!");
    }

    /**
     * Create file api routes
     */
    public function createService(?string $type = null)
    {
        $fileApiPath = base_path('app\\Services') . '\\' . "{$this->fileName}.php";

        if (!File::exists($fileApiPath)) {
            if ($type == 'api') {
                $stub = $this->getStubApiPath();
            } else {
                $stub = $this->getStubPath();
            }

            File::put($fileApiPath, StubsHelper::getSourceFile($stub, $this->getStubData()));
        } else {
            $this->warn("\n[ATENCIÓN] El Service '{$this->fileName}.php' ya existe\n");
        }
    }

    /**
     * Return the stub file path
     *
     * @return string
     */
    public function getStubPath()
    {
        return base_path('stubs') . '\\' . 'service.stub';
    }

    /**
     * Return the stub file path
     *
     * @return string
     */
    public function getStubApiPath()
    {
        return base_path('stubs') . '\\' . 'service.api.stub';
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
            'className' => $this->fileName,
        ];
    }
}
