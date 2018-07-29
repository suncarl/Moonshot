# Moonshot
登录月亮的计划，把不可能变成可能。
无聊时，使用slimphp 做的一个插件管理系统。
使用管理后台+运营后台+api的结构，支撑现在业务的各种形态。

管理后台以及运营后台都当成一个独立的特殊的插件去处理，其他的业务逻辑为一个小插件。


# features
* fast
* document
* easy

#to do lists
* template
* rpc
* pagege
* model
* admin
* manager
* privileges
* miniprogram
* 调用插件
* 验证码
* url生成


# done
* use plugin
* use redis for cache
* use mysql as db
* uploaded

# 模版 useage
* 模版变量连接符合 ～
```
{% set var1='123' %}
{% set var2='admin' %}
then:
{{ var1~var2 }}
result:
123admin

```

* 提供path_for 方法
```
{{ path_for('sys',{'bid':111,'pl_name':admin},{'mod':index,'act':t}) }}
```
* 提供 URL 方法简化 path_for
```
{{ URL('sys','111/admin',{'mod':index,'act':t}) }}
```


