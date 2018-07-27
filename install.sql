CREATE TABLE `ng_sys_plugins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category`  VARCHAR (100) NOT NULL DEFAULT '默认' COMMENT '插件类别名称',
  `sub_cate` VARCHAR (100) NULL DEFAULT '默认' COMMENT '插件子类别名称',
  `title` VARCHAR (150) NOT NULL COMMENT '插件名称',
  `desc` VARCHAR (255) NULL COMMENT '插件描述',
  `author` VARCHAR (255) NOT NULL COMMENT '插件作者',
  `version` VARCHAR (150) NOT NULL COMMENT '版本',
  `operation` varchar(200) NOT NULL COMMENT '操作人',
  `status` tinyint(1) unsigned DEFAULT 1 NULL COMMENT '状态 0:关闭;1:打开',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `mtime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_cate` (`category`),
  KEY `idx_title` (`title`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件管理表';


CREATE TABLE `ng_sys_plugins_rel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bussine_id` int(10) unsigned NOT NULL COMMENT '大Bid',
  `plugin_id` int(10) unsigned NOT NULL COMMENT '插件id',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `mtime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_bp_id` (`bussine_id`,`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件引用关系表';


CREATE TABLE `ng_sys_company_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL COMMENT '账号',
  `avatar` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `nickname` varchar(150) NOT NULL COMMENT '名称',
  `alias` varchar(150) NOT NULL COMMENT '别名',
  `hash_val` varchar(16) NOT NULL COMMENT '哈希值',
  `version` varchar(16) NOT NULL DEFAULT '1.0' COMMENT '版本号',

  `contact_user` varchar(150) NOT NULL COMMENT '联系人',
  `contact_phone` varchar(150) NOT NULL COMMENT '联系电话',
  `desc` varchar(255) COMMENT '简介',
  `logo_url` varchar(200) DEFAULT NULL COMMENT 'logo 地址',
  `operation` varchar(200) NOT NULL COMMENT '操作人',
  `expire_time` int(11) NOT NULL COMMENT '有效时间',
  `status` tinyint(1) unsigned DEFAULT 1 NULL COMMENT '状态 0:关闭;1:打开',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `mtime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_account` (`account`),
  KEY `idx_hash_val` (`hash_val`),
  KEY `idx_nickname` (`nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='企业账号信息表';

#功能权限表
CREATE TABLE `ng_sys_menu` (
  `id` smallint(6) unsigned NOT NULL,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `app` varchar(100) NOT NULL DEFAULT '' COMMENT '应用名称app/插件名称',
  `model` varchar(30)  NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(50)  NULL DEFAULT '' COMMENT '操作名称',
  `data` varchar(250)  NULL DEFAULT '' COMMENT '额外参数',
  `placehold` varchar(50) null COMMENT '替换符合，通常用于bid',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单类型  0：只作为菜单; 1：权限认证+菜单；2:外链',
  `link` varchar(255) NULL  COMMENT '外链URL，仅在type为2时生效',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，1显示，0不显示',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `icon` varchar(50) DEFAULT NULL COMMENT '菜单图标',
  `remark` varchar(255)  NULL DEFAULT '' COMMENT '备注',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `mtime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_app` (`app`),
  KEY `idx_listorder` (`listorder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='后台管理菜单表';

#insert datas
insert into  `ng_sys_menu` (`id`, `parentid`, `app`, `model`, `action`, `data`, `placehold`, `type`,`link`, `status`, `name`, `icon`, `remark`, `listorder` ,`ctime`,`mtime`) VALUES
(1,0,'admin','site','index','','',1,'',1,'网站管理','th','',30,1532693502,1532693502),
(2,0,'admin','mini','index','','',1,'',1,'小程序管理','th','',25,1532693502,1532693502),
(3,0,'admin','user','index','','',1,'',1,'用户管理','th','',20,1532693502,1532693502),
(4,0,'admin','setting','index','','',1,'',1,'设置管理','th','',15,1532693502,1532693502);