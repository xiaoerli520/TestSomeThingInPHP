<?php

use PHPUnit\Framework\TestCase;

class TestClass
{
    private static $sum = 0;

    public function addChain()
    {
         self::$sum++;
         return $this;
    }

    public function add()
    {
        self::$sum++;
    }


}

final class ChainCallTest extends TestCase
{
    protected $count = 1000000;

    public function testWithoutChain()
    {
        $testclass = new TestClass();
        $timer = Benchmark::getInstance();
        $timer ->Start();
        for ($i = 0;$i < $this -> count;$i++) {
            $testclass -> add();
        }
        $timer -> Stop();

        echo "Without Chain is :: ". $timer -> GetTime().PHP_EOL;
    }

    public function testWtihChain()
    {
        $testclass = new TestClass();
        $timer = Benchmark::getInstance();
        $timer ->Start();
        for ($i = 0;$i < $this -> count;$i++) {
            $testclass -> addChain();
        }
        $timer -> Stop();

        echo "With Chain is :: ". $timer -> GetTime().PHP_EOL;
    }
}