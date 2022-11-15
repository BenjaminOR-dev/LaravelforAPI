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
     * Example method
     *
     * @return <type> $example
     */
    public static function exampleMethod()
    {
        $self = new Self();

        # Code

        //return [];
    }
}
