<?php

namespace App\Http\Controllers;

use App\Helpers\ClassHelper;
use App\Helpers\ResponseHelper;
use App\Services\PruebaService;
use App\Http\Controllers\Controller;
use App\Requests\Services\PruebaService as RulesRequest;

class PruebaController extends Controller
{
    /**
     * Nombre de la clase
     *
     * @var string
     */
    public string $className;

    /**
     * Construct
     *
     * @return void
     */
    public function _construct()
    {
        $this->className = ClassHelper::getName(__CLASS__);
    }

    /**
     * Example method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function exampleMethod()
    {
        $exampleMethod = PruebaService::exampleMethod();
        return ResponseHelper::json($exampleMethod, "ExampleMessage");
    }
}
