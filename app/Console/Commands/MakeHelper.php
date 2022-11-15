<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\StubsHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

/**
 * MakeHelper
 *
 * @package App\Console\Commands
 * @author Ing. Benjamin Olvera Rosales
 */
class MakeHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {nombreArchivo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un archivo Helper';

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

        $this->fileName = Str::ucfirst(Str::camel($this->argument('nombreArchivo'))) . 'Helper';

        $this->createHelper();
        $this->info("El comando se ha ejecutado correctamente!");
    }

    /**
     * Create file api routes
     */
    public function createHelper()
    {
        $fileApiPath = base_path('app\\Helpers') . '\\' . "{$this->fileName}.php";
        if (!File::exists($fileApiPath)) {
            File::put($fileApiPath, StubsHelper::getSourceFile($this->getStubPath(), $this->getStubData()));
        } else {
            $this->warn("\n[ATENCIÓN] El Helper '{$this->fileName}.php' ya existe\n");
        }
    }

    /**
     * Return the stub file path
     *
     * @return string
     */
    public function getStubPath()
    {
        return base_path('stubs') . '\\' . 'helper.stub';
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
