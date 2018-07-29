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

# 插件的命名规范
* 插件目录名称为小写的英文字母（采用下划线分割单词的方式）
* 插件类名与插件目录一致，（采用首字母大写的驼峰命名方式）
* 插件的方法采用 名称+Action的方式，默认传递两个参数 $req 和 $preData , $req 为 RequestHelper的实例 而$preData 为 before方法执行后的数据结果，默认等同于 $req
* 插件返回为 ResponeHelper的方法，返回默认为json格式
* 普通插件在plugins目录里，插件只有一个入口文件。
* admin为特殊的插件，特殊点在于使用sys进行定义，同时插件名由于是admin，如果采用了mod=入口类名的方式进行调用，入口类名的传参和命名规则与普通插件的一致

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


