<?php
/**
 * Created by PhpStorm.
 * User: lianjia
 * Date: 2018/9/17
 * Time: 上午11:22
 */

use PHPUnit\Framework\TestCase;

class ArrayWalkTest extends TestCase
{

    private $retryTimes = 10;

    private $test_arr = []; // keys and values

    public function testForeach() {
        $timer = Benchmark::getInstance();
        $this -> test_arr = array_combine(range(1, 100000), range(1, 100000));

        $cost = $timer -> tryManyTimes(function () {
            $i = 0;
            foreach ($this -> test_arr as $item) {
                if ($item == null) {
                    ++$i;
                }
            }
        }, $this -> retryTimes);

        echo "Foreach Costs :: " . $cost . PHP_EOL;
    }

    public function testArrayWalk() {
        $timer = Benchmark::getInstance();
        $this -> test_arr = array_combine(range(1, 100000), range(1, 100000));

        $cost = $timer -> tryManyTimes(function () {
            $i = 0;
            array_walk($this -> test_arr, function (&$value) use (&$i) {
                if ($value == null) {
                    ++$i;
                }
            });
        }, $this -> retryTimes);

        echo "ArrayWalk Costs :: " . $cost . PHP_EOL;
    }
}