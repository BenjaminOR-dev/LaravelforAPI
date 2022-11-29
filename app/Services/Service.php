<?php

namespace App\Services;

use Throwable;
use App\Helpers\ClassHelper;
use App\Helpers\ValidatorHelper;
use Illuminate\Support\Facades\DB;

class Service
{
    /**
     * Get the name of the class
     *
     * @return string
     */
    public function getClassName()
    {
        return ClassHelper::getName(static::class);
    }

    /**
     * Get the name of the method
     *
     * @return string
     */
    public function getMethodName()
    {
        return debug_backtrace()[1]['function'] . '()';
    }

    /**
     * Get the class name and method name
     *
     * @return string
     */
    public function getClassNameAndMethod()
    {
        return $this->getClassName() . '::' . $this->getMethodName();
    }

    /**
     * Make a debug log for init method
     *
     * @return void
     */
    public function logInitMethod()
    {
        debug_("Inicia {$this->getClassNameAndMethod()}");
    }

    /**
     * Make a debug log for end method
     *
     * @return void
     */
    public function logEndMethod()
    {
        debug_("Finaliza {$this->getClassNameAndMethod()}");
    }

    /**
     * Validate for service
     *
     * @param string $rulesRequest
     * @param array $data
     * @param bool $returnValidated
     * @return array
     */
    public function validate(string $rulesRequest, array &$data, bool $returnValidated = true)
    {
        $data = ValidatorHelper::make($rulesRequest, $data, $returnValidated);
        debug_("Validación de {$this->getClassNameAndMethod()}", $data);
    }

    /**
     * DB Begin Transaction
     *
     * @param bool $transactionExists
     * @return void
     */
    public function dbBeginTransaction(bool $transactionExists = false)
    {
        if (!$transactionExists) {
            debug_("Se crea la transacción");
            DB::beginTransaction();
        }
    }

    /**
     * DB Commit
     *
     * @param bool $transactionExists
     * @return void
     */
    public function dbCommit(bool $transactionExists = false)
    {
        if (!$transactionExists) {
            debug_("Se realiza el COMMIT de la transacción");
            DB::commit();
        }
    }

    /**
     * DB Rollback
     *
     * @param bool $transactionExists
     * @return void
     */
    public function dbRollback(Throwable $th, bool $transactionExists = false)
    {
        if (!$transactionExists) {
            debug_("Se realiza ROLLBACK de la transacción: {$th->getMessage()}");
            DB::rollBack();
        }
    }
}
