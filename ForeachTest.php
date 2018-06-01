<?php
/**
 * Created by PhpStorm.
 * User: shixi_qingzhe
 * Date: 18/5/31
 * Time: 下午2:20
 */

require_once __DIR__ . '/lib.php';

class ForeachTest
{
    private $Count = 50000;

    private $reTryTime = 100;



    public function testForeachWithReference()
    {
        $timer = Benchmark::getInstance();

        $array = range(1,$this -> Count);

        $sum = 0;

        $timer -> Start();
        foreach ($array as &$item) {
            $sum = $sum + $item;
        }
        $timer -> Stop();

        echo $timer -> GetTime()."\n";
    }

    public function testForeachWithoutReference()
    {
        $timer = Benchmark::getInstance();

        $array = range(1,$this -> Count);

        $sum = 0;

        $timer -> Start();
        foreach ($array as $item) {
            $sum = $sum + $item;
        }
        $timer -> Stop();

        echo $timer -> GetTime()."\n";

    }
}


$cls = new ForeachTest();

$cls -> testForeachWithoutReference();

$cls -> testForeachWithReference();


// 证明之前的带&的方法是没错的
// php54验证没有引用问题


$this_is_testiss = 1;
