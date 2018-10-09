# PHP 相关效率测试

这是一些PHP相关的效率测试，全部使用PHP7.0的版本进行测试

# 测试环境

- PHP7.0 

- Xdebug

- VLD

# useage

```php
 phpunit --bootstrap ./lib.php ConcatTest.php
```

# 测试结果

## 字符串拼接方法

```
PHP7

.time By .= is : 0.0071661710739136
.time By . is : 1.8765479326248
.time By sprintf() is : 2.0971804380417
.time By vsprintf() is : 0.0076944351196289
.time by Join() / Implode() is : 0.0083096981048584

```

## 文件get操作

```
fopen + fclose = 8.23974609375E-6
f get content = 9.8371505737305E-6 
fgets = 1.4579296112061E-5
```

## Foreach

```
Foreach With Reference0.023320913314819
Foreach Without Reference0.0073831081390381
with explode each0.04508900642395
without explode each0.020189046859741
```

## magic 

```
Magic Set Cost :: 3.0422210693359E-7
WithOut Magic Set Cost :: 2.0098686218262E-7
Magic Get Cost :: 2.6059150695801E-7
Without Magic Get Cost :: 2.2578239440918E-7
```


## ++$i and $i++ 的OPCODE操作数对比

### after

```
function name:  (null)
number of ops:  4
compiled vars:  !0 = $i
line     #* E I O op                           fetch          ext  return  operands
-------------------------------------------------------------------------------------
  11     0  E >   ASSIGN                                                   !0, 9
  13     1        POST_INC                                         ~2      !0
         2        FREE                                                     ~2
         3      > RETURN                                                   1

```

### before

```
function name:  (null)
number of ops:  3
compiled vars:  !0 = $i
line     #* E I O op                           fetch          ext  return  operands
-------------------------------------------------------------------------------------
   9     0  E >   ASSIGN                                                   !0, 9
  11     1        PRE_INC                                                  !0
         2      > RETURN                                                   1

branch: #  0; line:     9-   11; sop:     0; eop:     2; out1:  -2
path #1: 0, 

```

这边可以看到 ，$i++ 是多了一步 FREE的操作 应该是将临时变量Free掉了

因为$i++是 需要将当前值返回之后再加 因此需要一个临时变量去做返回

++$i是返回增加之后的，过程中无需产生临时变量，也不用去free临时变量，效率较高

### for 中的计算是否 会多次计算条件

```
function name:  (null)
number of ops:  11
compiled vars:  !0 = $arr, !1 = $i
line     #* E I O op                           fetch          ext  return  operands
-------------------------------------------------------------------------------------
  13     0  E >   ASSIGN                                                   !0, <array>
  15     1        ASSIGN                                                   !1, 0
         2      > JMP                                                      ->5
         3    >   POST_INC                                         ~4      !1
         4        FREE                                                     ~4
         5    >   INIT_FCALL                                               'count'
         6        SEND_VAR                                                 !0
         7        DO_ICALL                                         $5      
         8        IS_SMALLER                                       ~6      !1, $5
         9      > JMPNZ                                                    ~6, ->3
  17    10    > > RETURN                                                   1

```

可以看出 是多次FCALL调用的 并没有优化哈


### foreach or array_walk

```
Foreach Costs :: 0.0025825977325439
ArrayWalk Costs :: 0.0090026617050171

```

### chainCall or non-chainCall

```
With Chain is :: 0.052052021026611
Without Chain is :: 0.048146963119507
```