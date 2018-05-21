# PHP5 PHP7 字符串拼接效率测试

# 测试环境

- PHP5

- PHP7 

- Xdebug

- VLD

# 测试结果

```
PHP5
.time By .= is : 0.0050616264343262
.time By . is : 6.156693148613
.time By sprintf() is : 8.7994904279709
.time By vsprintf() is : 0.014266705513
.time by Join() / Implode() is : 0.0092714786529541

```

```
PHP7

.time By .= is : 0.0071661710739136
.time By . is : 1.8765479326248
.time By sprintf() is : 2.0971804380417
.time By vsprintf() is : 0.0076944351196289
.time by Join() / Implode() is : 0.0083096981048584

```