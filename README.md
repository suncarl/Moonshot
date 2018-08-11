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
* 模版中css／js调用地址说明
** 通用的资源物理目录在 ./public/assest/ 里面，通过模版调用使用 /wxapp/asset/{具体的js/css} 这样调用
** admin 插件的资源目录在 ./admin/templates/ 里面 ，通过模版调用使用 /assets/admin/{具体的js/css} 这样调用
** 普通插件的资源目录在 ./plugins/插件名称里面/ 里面， 通过模版调用使用 /assets/plugin/{具体的插件名称/具体js/css} 这样调用

* 提供path_for 方法
```
{{ path_for('sys',{'bid':111,'pl_name':admin},{'mod':index,'act':t}) }}
```
* 提供 URL 方法简化 path_for
```
{{ URL('sys','111/admin',{'mod':index,'act':t}) }}
```

# 数据库的使用技巧
* 查找当条记录，使用 first() 方法
```
    $map = [
        'name'=> $name
    ];
    $res = $this->db->table('sys_config')->where($map)->first()
    $res = (array)$res;
```
* 查找多条记录，使用 get() 方法
```
    $map = [
        'name'=> $name
    ];
    $res = $this->db->table('sys_config')->where($map)->get()
    $res = reset($res);
```
* 使用自定义查询 使用 whereRaw()
```
    $map['mtime'] = time();
    $flag =$this->db->table('sys_config')->whereRaw('exam_id = ? and openid = ? and cday = ? ',[$exam_id,$openid,$cday])->update($map);

```
* 删除记录 delete()
```
    $map['mtime'] = time();
    $flag =$this->db->table('sys_config')->where($map)->delete();

```
* 插入数据并返回id 使用 insertGetId()
```
    $add_map['mtime'] = time();
    $this->db->table('sys_config')->insertGetId($add_map);
```
* 原子自增 increment()
```
    $map['mtime'] = time();
    $this->db->table('sys_config')->where($map)->increment('chance_num');
```
* 指定查询字段和排序和条数
```
    $map['mtime'] = time();
    $this->db->table('sys_config')->select('id','name')->where($map)->orderBy('id','desc')->limit(10)->get();
```

* 随机获取  orderByRaw('RAND()')
```
    $map['mtime'] = time();
    $this->db->table('sys_config')->select('id','name')->where($map)->orderByRaw('RAND()')->limit(10)->get();

```
* 返回条数 count()
```
    $this->db->table('sys_config')->select('id','name')->where($map)->count();
```
* 唯一 记述 distinct() and count()

```
    $this->db->table('sys_config')->select('id','name')->where($map)->distinct('field')->count('field');
```
* 分组 groupBy()
```
    $this->db->table('sys_config')->select('id','name')->where($map)->groupBy('filed')->get()
```


* 连表，分页，复合查询
```
        $page = 10;
        $pre_page = 20;
        $res = $this->db->table("sys_config as et")
        ->join("sys_user as award","et.id","=","award.exam_id")
        ->LeftJoin("sys_setting as ba","et.openid","=","ba.openid")
        ->where($map)
        ->whereRaw('ng_award.award_total > ? and ng_award.award_total > ng_award.award_apply_total',[0])
        ->orderBy('et.ctime','desc')
        ->forPage($page,$pre_page)
        ->select("et.*","ba.name as bussine_name","ba.logo_url")
        ->get();
```


# docs
* twig文档 https://www.kancloud.cn/yunye/twig-cn/159454
* slim文档 https://www.slimframework.com/docs/v3/start/installation.html
* 包裹查找 https://packagist.org/
* 图形验证码 https://github.com/gregwar/captcha
* slim-session https://github.com/bryanjhv/slim-session
* cookie https://github.com/delight-im/PHP-Cookie


fork push test!
