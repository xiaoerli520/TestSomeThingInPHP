<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/5/18
 * Time: 下午9:16
 */
class BenchMarkException{}

class Benchmark
{
    const DEFAULT_RETRY_TIMES = 10;

    private  $StartTime;

    private  $EndTime;

    private  $During;

    private  $DuringArr = [];

    public static function getInstance()
    {
        return new self;
    }

    public function Start()
    {
        $this -> StartTime = microtime(1);
    }

    public function Stop()
    {
        $this -> EndTime = microtime(1);
    }

    public function GetTime()
    {
        $this -> During = $this -> EndTime - $this -> StartTime;
        return (float)$this -> During;
    }

    public function SetDuringArr($during)
    {
        $this -> DuringArr [] = $during;
    }

    public function GetDuringAvg()
    {
        if (count($this -> DuringArr) <= 0)
            return 0;
        else {
            $timeSum = 0.0;
            $countOfArr = count($this -> DuringArr);

            for ($i = 0;$i < $countOfArr;$i++) {
                $timeSum = $timeSum + $this -> DuringArr[$i];
            }
            return ($timeSum / $countOfArr);

        }

    }

    public function tryManyTimes(callable $function, $tryTimes = self::DEFAULT_RETRY_TIMES)
    {
        $this -> DuringArr = null;
        if (intval($tryTimes) <= 0) {
            die('TryTimes ERROR');
        }
        $tryTimes = intval($tryTimes);
        try {
            for ($i = 0;$i < $tryTimes;$i++) {
                $this -> Start();
                call_user_func($function);
                $this -> Stop();
                $this -> SetDuringArr($this -> GetTime());
            }

            return $this -> GetDuringAvg();
        } catch (Throwable $e) {
            $e -> getTraceAsString();
            die('Exception During Exec'."\n");
        }
    }

}
