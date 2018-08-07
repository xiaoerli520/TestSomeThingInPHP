<?php
/**
 * Created by PhpStorm.
 * User: shixi_qingzhe
 * Date: 18/5/31
 * Time: 下午2:20
 */

require_once __DIR__ . '/lib.php';

class ForeachTest extends \PHPUnit_Framework_TestCase
{
    private $Count = 500000;

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

    public function testForeachWithExplode()
    {
        $timer = Benchmark::getInstance();

        $array = range(1, $this -> Count);

        $str = implode(",",$array);

        unset($array);

        $timer -> Start();

        $sum = 0;

        foreach (explode(",", $str) as $item) {
            $sum = $sum + $item;
        }

        $timer -> Stop();

        echo "with explode each" . $timer -> GetTime()."\n";

    }

    public function testForeachWithoutExplode()
    {
        $timer = Benchmark::getInstance();

        $array = range(1, $this -> Count);

        $str = implode(",",$array);

        unset($array);

        $arr = explode(",", $str);

        $timer -> Start();

        $sum = 0;

        foreach ($arr as $item) {
            $sum = $sum + $item;
        }

        $timer -> Stop();

        echo "without explode each" . $timer -> GetTime()."\n";
    }
}