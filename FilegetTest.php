<?php
/**
 * Created by PhpStorm.
 * User: shixi_qingzhe
 * Date: 18/5/27
 * Time: 上午11:00
 */

require_once __DIR__ . '/lib.php';

class FilegetTest extends \PHPUnit_Framework_TestCase
{
    private $Count = 50000;

    private $reTryTime = 100;

    public function testFopen()
    {
        $timer = Benchmark::getInstance();
        $testAVG = $timer -> tryManyTimes(function () {
            $f = fopen('/Users/gtx/PhpstormProjects/gearman/ConcatDeepCompare/file/test', 'r');
            $fc = fread($f, filesize('/Users/gtx/PhpstormProjects/gearman/ConcatDeepCompare/file/test'));
            $fct = strlen($fc);
            fclose($f);
        },$this -> reTryTime);

        echo "fopen + fclose = {$testAVG} \n";
    }

    public function testFgct()
    {
        $timer = Benchmark::getInstance();
        $testAVG = $timer -> tryManyTimes(function () {
            $fc = file_get_contents('/Users/gtx/PhpstormProjects/gearman/ConcatDeepCompare/file/test');
            $fu = strlen($fc);
        }, $this -> reTryTime);
        echo "f get ctx = {$testAVG} \n";
    }

    public function testFgets() // 逐行读取数据
    {
        $timer = Benchmark::getInstance();
        $testAVG = $timer -> tryManyTimes(function () {
            $f = fopen('/Users/gtx/PhpstormProjects/gearman/ConcatDeepCompare/file/test', 'r');
            $fc = "";
            if($f){
                while(!feof($f)) {
                    $fc .= fgets($f);
                }
            }
            $fcc = strlen($fc);
        }, $this -> reTryTime);
        echo "fgets = {$testAVG} \n";
    }
}