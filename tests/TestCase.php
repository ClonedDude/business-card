<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function runTest(): mixed
    {
        DB::beginTransaction();
        $result = null;

        try {
            $result = parent::runTest();
            
            DB::rollBack();
        } catch (Throwable $e) {
            if (! is_null(static::$latestResponse)) {
                static::$latestResponse->transformNotSuccessfulException($e);
            }

            DB::rollBack();
            throw $e;
        }

        return $result;
    }

}
