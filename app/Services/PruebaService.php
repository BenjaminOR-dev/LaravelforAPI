<?php

namespace App\Services;

use App\Helpers\ClassHelper;
use App\Helpers\ValidatorHelper;
use Illuminate\Support\Facades\DB;
use App\Requests\Services\PruebaService as RulesRequest;

class PruebaService
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
     * @param  array<\App\Requests\Services\PruebaService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public static function index(array $data, bool $validateData = true)
    {
        $self = new Self();

        if ($validateData) $data = ValidatorHelper::make(RulesRequest\Index::class, $data);
        $request = new RulesRequest\Index($data);

        # code

        //return [];
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Requests\Services\PruebaService\Store>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public static function store(array $data, bool $validateData = true)
    {
        $self = new Self();

        if ($validateData) $data = ValidatorHelper::make(RulesRequest\Store::class, $data);
        $request = new RulesRequest\Store($data);

        DB::beginTransaction();
        try {
            # code

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        //return [];
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Requests\Services\PruebaService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public static function show(array $data, bool $validateData = true)
    {
        $self = new Self();

        if ($validateData) $data = ValidatorHelper::make(RulesRequest\Show::class, $data);
        $request = new RulesRequest\Show($data);

        # code

        //return [];
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Requests\Services\PruebaService\Update>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public static function update(array $data, bool $validateData = true)
    {
        $self = new Self();

        if ($validateData) $data = ValidatorHelper::make(RulesRequest\Update::class, $data);
        $request = new RulesRequest\Update($data);

        DB::beginTransaction();
        try {
            # code

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        //return [];
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Requests\Services\PruebaService\Destroy>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public static function destroy(array $data, bool $validateData = true)
    {
        $self = new Self();

        if ($validateData) $data = ValidatorHelper::make(RulesRequest\Destroy::class, $data);
        $request = new RulesRequest\Destroy($data);

        DB::beginTransaction();
        try {
            # code

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        //return [];
    }
}
