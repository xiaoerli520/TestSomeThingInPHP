<?php
/**
 * Created by PhpStorm.
 * User: lianjia
 * Date: 2018/9/15
 * Time: 下午1:35
 */

use PHPUnit\Framework\TestCase;

class TestClass
{
    private $testVar = 'test777';

    private static $instance = null;

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setTestVar($var)
    {
        $this -> testVar = $var ?? '';
    }

    public function __set($name, $value)
    {
        $this -> $name = $value;
    }

    public function getTestVar()
    {
        return $this -> testVar;
    }

    public function __get($name)
    {
        return $this -> $name;
    }
}

final class MagicMethodTest extends TestCase
{
    private $retryTimes = 1000;

    private $count = 10000;

    public function testMagicSet()
    {

        $timer = Benchmark::getInstance();

        $inst = TestClass::getInstance();

        $timeAvg = $timer -> tryManyTimes(function () use ($inst) {
            $inst -> testVar = 'test777';
        }, $this -> retryTimes);

        echo "Magic Set Cost :: ". $timeAvg. PHP_EOL;
    }

    public function testWithoutMagicSet()
    {
        $timer = Benchmark::getInstance();

        $inst = TestClass::getInstance();

        $timeAvg = $timer -> tryManyTimes(function () use ($inst) {
            $inst -> setTestVar('test777');
        }, $this -> retryTimes);

        echo "WithOut Magic Set Cost :: ". $timeAvg. PHP_EOL;
    }

    public function testMagicGet()
    {
        $timer = Benchmark::getInstance();

        $inst = TestClass::getInstance();

        $timeAvg = $timer -> tryManyTimes(function () use ($inst) {
            $res = $inst -> testVar;
        }, $this -> retryTimes);

        echo "Magic Get Cost :: ". $timeAvg. PHP_EOL;
    }

    public function testWithOutMagicGet()
    {
        $timer = Benchmark::getInstance();

        $inst = TestClass::getInstance();

        $timeAvg = $timer -> tryManyTimes(function () use ($inst) {
            $res = $inst -> getTestVar();
        }, $this -> retryTimes);

        echo "Without Magic Get Cost :: ". $timeAvg. PHP_EOL;
    }
}