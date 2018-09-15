<?php
/**
 * Created by PhpStorm.
 * User: lianjia
 * Date: 2018/9/15
 * Time: 下午2:09
 *
 * for ($i = 0; $i < count(range(1,2));$i++) {}
 * 是否会计算多次count
 *
 */

$arr = [1, 2, 3];

for ($i = 0;$i < count($arr);$i++) {
    // sth
}