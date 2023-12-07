<?php

namespace PRGANYRN\PROJECT\TEST\Controller;

class TestController
{
    public function TestFunction(): void
    {
        echo "TestController : TestFunction".PHP_EOL;
    }

    public function TestFunctionReg(string $testId, string $testString): void
    {
        echo "TestController : TestFunction, testId : $testId, testString : $testString".PHP_EOL;
    }
}
