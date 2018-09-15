<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/5/18
 * Time: 下午9:31
 * 几种字符串拼接的测试
 *
 * 最快字符串拼接方式  . , .= , sprintf , join, implode, concat
 */

use PHPUnit\Framework\TestCase;

final class ConcatTest extends TestCase
{
    private $Count = 10000;

    private $reTryTime = 10;

    private $tempStr = '19826318654817aasdasdadasd';

    public function testDotEqual()
    {
        $timer = Benchmark::getInstance();
        $timeAVG = $timer->tryManyTimes(function () {
            $result = "";
            for ($i = 0; $i < $this -> Count; $i++) {
                $result .= $this->tempStr;
            }
        }, $this -> reTryTime);
        echo "time By .= is : ".$timeAVG."\n";
    }

//    public function testDouhao()
//    {
//        $timer = Benchmark::getInstance();
//        $timeAvg = $timer -> tryManyTimes(function () {
//            $result = "";
//            for ($i = 0; $i < $this -> Count;$i++) {
//                $result = $result.$this -> tempStr;
//            }
//        }, $this -> reTryTime);
//        echo "time By , is : ".$timeAvg."\n";
//    }


    public function testDot()
    {
        $timer = Benchmark::getInstance();
        $timeAvg = $timer -> tryManyTimes(function () {
            $result = "";
            for ($i = 0; $i < $this -> Count;$i++) {
                $result = $result.$this -> tempStr;
            }
        }, $this -> reTryTime);
        echo "time By . is : ".$timeAvg."\n";
    }

    public function testSprintf()
    {
        $timer = Benchmark::getInstance();
        $timeAvg = $timer -> tryManyTimes(function() {
            $result = "";
            for ($i = 0;$i < $this -> Count;$i++) {
                $result = sprintf("%s%s", $result, $this -> tempStr);
            }
        }, $this -> reTryTime);
        echo "time By sprintf() is : ".$timeAvg."\n";
    }

    public function testVsprintf()
    {
        $timer = Benchmark::getInstance();
        $timeAvg = $timer -> tryManyTimes(function() {
            $arg = [];
            for ($i = 0;$i < $this -> Count;$i++) {
                $arg[] = $this -> tempStr;
            }
            $result = vsprintf("%s", $arg);
        }, $this -> reTryTime);
        echo "time By vsprintf() is : ".$timeAvg."\n";
    }

    public function testJoin()
    {
        $timer = Benchmark::getInstance();
        $timeAvg = $timer -> tryManyTimes(function () {
            // alloc the array
            $resultArr = [];
            for ($i = 0;$i < $this -> Count;$i++) {
                $resultArr[] = $this -> tempStr;
            }
            $result = implode('',$resultArr);
        }, $this -> reTryTime);
        echo "time by Join() / Implode() is : ".$timeAvg."\n";
    }
}

