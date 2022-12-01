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
    protected function getClassName(int $indexClassPosition = 1)
    {
        return ClassHelper::getName(debug_backtrace()[$indexClassPosition]['class']);
    }

    /**
     * Get the name of the method
     *
     * @return string
     */
    protected function getMethodName(int $indexMethodPosition = 1)
    {
        return debug_backtrace()[$indexMethodPosition]['function'];
    }

    /**
     * Get the class name and method name
     *
     * @return string
     */
    protected function getClassNameAndMethod(int $indexClassAndMethodPosition = 2)
    {
        return $this->getClassName($indexClassAndMethodPosition) . '::' . $this->getMethodName($indexClassAndMethodPosition) . '()';
    }

    /**
     * Make a debug log for init method
     *
     * @return void
     */
    protected function logInitMethod(int $indexClassAndMethodPosition = 3)
    {
        debug_("Inicia {$this->getClassNameAndMethod($indexClassAndMethodPosition)}");
    }

    /**
     * Make a debug log for end method
     *
     * @return void
     */
    protected function logEndMethod(int $indexClassAndMethodPosition = 3)
    {
        debug_("Finaliza {$this->getClassNameAndMethod($indexClassAndMethodPosition)}");
    }

    /**
     * Validate for service
     *
     * @param string $rulesRequest
     * @param array $data
     * @param bool $validateData = true
     * @param bool $makeValidatedToData
     * @return void
     */
    protected function validate(string $rulesRequest, array &$data, bool $validateData = true, bool $applyValidatedToData = true)
    {
        $this->logInitMethod();

        if ($validateData) $data = ValidatorHelper::make($rulesRequest, $data, $applyValidatedToData);
        debug_('Datos de entrada', $data);

        $this->logEndMethod();
    }

    /**
     * DB Begin Transaction
     *
     * @param bool $transactionExists
     * @return void
     */
    protected function dbBeginTransaction(bool $transactionExists = false)
    {
        $this->logInitMethod();

        if (!$transactionExists) {
            debug_("Se crea la transacción");
            DB::beginTransaction();
        }

        $this->logEndMethod();
    }

    /**
     * DB Commit
     *
     * @param bool $transactionExists
     * @return void
     */
    protected function dbCommit(bool $transactionExists = false)
    {
        $this->logInitMethod();

        if (!$transactionExists) {
            debug_("Se realiza el commit");
            DB::commit();
        }

        $this->logEndMethod();
    }

    /**
     * DB Rollback
     *
     * @param bool $transactionExists
     * @return void
     */
    protected function dbRollback(Throwable $th, bool $transactionExists = false)
    {
        $this->logInitMethod();

        if (!$transactionExists) {
            debug_("ROLLBACK: {$th->getMessage()}");
            DB::rollBack();
        }

        $this->logEndMethod();
    }
}
