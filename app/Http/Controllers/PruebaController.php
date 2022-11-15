<?php

namespace App\Http\Controllers;

use App\Helpers\ClassHelper;
use App\Helpers\ResponseHelper;
use App\Services\PruebaService;
use App\Http\Controllers\Controller;
use App\Requests\Services\PruebaService as RulesRequest;

class Prueba extends Controller
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
     * Retorna una lista de los recursos
     *
     * @param  \App\Requests\Services\PruebaService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $index = PruebaService::index($request->validated, false);
        return ResponseHelper::json($index, "ExampleMessage");
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Requests\Services\PruebaService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $store = PruebaService::store($request->validated, false);
        return ResponseHelper::json($store, "ExampleMessage");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Requests\Services\PruebaService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $show = PruebaService::show($request->validated, false);
        return ResponseHelper::json($show, "ExampleMessage");
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Requests\Services\PruebaService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request, int $id)
    {
        $update = PruebaService::update($request->validated, false);
        return ResponseHelper::json($update, "ExampleMessage");
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Requests\Services\PruebaService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroy = PruebaService::destroy($request->validated, false);
        return ResponseHelper::json($destroy, "ExampleMessage");
    }
}
