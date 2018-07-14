CREATE TABLE `ng_plugins` (
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


CREATE TABLE `ng_plugins_rel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bussine_id` int(10) unsigned NOT NULL COMMENT '大Bid',
  `plugin_id` int(10) unsigned NOT NULL COMMENT '插件id',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `mtime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_bp_id` (`bussine_id`,`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件引用关系表';


CREATE TABLE `ng_company_account` (
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