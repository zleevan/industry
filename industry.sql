-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 04 月 14 日 13:06
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `industry`
--

-- --------------------------------------------------------

--
-- 表的结构 `qw_article`
--

CREATE TABLE IF NOT EXISTS `qw_article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL COMMENT '分类id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `days` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '摘要',
  `thumbnail` varchar(255) NOT NULL COMMENT '缩略图',
  `content` text NOT NULL COMMENT '内容',
  `t` int(10) unsigned NOT NULL COMMENT '时间',
  `n` int(10) unsigned NOT NULL COMMENT '点击',
  PRIMARY KEY (`aid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `qw_article`
--

INSERT INTO `qw_article` (`aid`, `sid`, `title`, `keywords`, `days`, `description`, `thumbnail`, `content`, `t`, `n`) VALUES
(1, 3, '美的油烟机', '高端', '', '就是好用，就是这么好用', '/Public/attached/201604/1460377373.jpg', '<p>\r\n	就是强，就是牛逼\r\n</p>\r\n<p>\r\n	<img src="/qwadmin-master/Public/kindeditor/php/../../attached/image/20160411/20160411122424_22667.jpg" alt="" /><img src="/qwadmin-master/Public/kindeditor/php/../../attached/image/20160411/20160411122424_24010.jpg" alt="" /><img src="/qwadmin-master/Public/kindeditor/php/../../attached/image/20160411/20160411122424_78999.jpg" alt="" />\r\n</p>', 1460377503, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qw_auth_group`
--

CREATE TABLE IF NOT EXISTS `qw_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `qw_auth_group`
--

INSERT INTO `qw_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '1,2,58,65,59,60,61,62,3,56,4,6,5,7,8,9,10,51,52,53,57,11,54,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,29,30,31,32,33,34,36,37,38,39,40,41,42,43,44,45,46,47,63,48,49,50,55'),
(2, '管理员', 1, '13,14,23,22,21,20,19,18,17,16,15,24,36,34,33,32,31,30,29,27,26,25,1'),
(3, '普通用户', 1, '1'),
(6, '333', 0, '1,2');

-- --------------------------------------------------------

--
-- 表的结构 `qw_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `qw_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qw_auth_group_access`
--

INSERT INTO `qw_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- 表的结构 `qw_auth_rule`
--

CREATE TABLE IF NOT EXISTS `qw_auth_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `islink` tinyint(1) NOT NULL DEFAULT '1',
  `o` int(11) NOT NULL COMMENT '排序',
  `tips` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- 转存表中的数据 `qw_auth_rule`
--

INSERT INTO `qw_auth_rule` (`id`, `pid`, `name`, `title`, `icon`, `type`, `status`, `condition`, `islink`, `o`, `tips`) VALUES
(1, 0, 'Index/index', '控制台', 'menu-icon fa fa-tachometer', 1, 1, '', 1, 1, '友情提示：经常查看操作日志，发现异常以便及时追查原因。'),
(2, 0, '', '系统设置', 'menu-icon fa fa-cog', 1, 1, '', 1, 2, ''),
(3, 2, 'Setting/setting', '网站设置', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 3, '这是网站设置的提示。'),
(4, 2, 'Menu/index', '后台菜单', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 4, ''),
(5, 2, 'Menu/add', '新增菜单', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 5, ''),
(6, 4, 'Menu/edit', '编辑菜单', '', 1, 1, '', 0, 6, ''),
(7, 2, 'Menu/update', '保存菜单', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 7, ''),
(8, 2, 'Menu/del', '删除菜单', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 8, ''),
(9, 2, 'Database/backup', '数据库备份', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 9, ''),
(10, 9, 'Database/recovery', '数据库还原', '', 1, 1, '', 0, 10, ''),
(11, 2, 'Update/update', '在线升级', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 11, ''),
(12, 2, 'Update/devlog', '开发日志', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 12, ''),
(13, 0, '', '管理员组', 'menu-icon fa fa-users', 1, 1, '', 1, 13, ''),
(14, 13, 'Member/index', '用户管理', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 14, ''),
(15, 13, 'Member/add', '新增用户', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 15, ''),
(16, 13, 'Member/edit', '编辑用户', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 16, ''),
(17, 13, 'Member/update', '保存用户', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 17, ''),
(18, 13, 'Member/del', '删除用户', '', 1, 1, '', 0, 18, ''),
(19, 13, 'Group/index', '用户组管理', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 19, ''),
(20, 13, 'Group/add', '新增用户组', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 20, ''),
(21, 13, 'Group/edit', '编辑用户组', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 21, ''),
(22, 13, 'Group/update', '保存用户组', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 22, ''),
(23, 13, 'Group/del', '删除用户组', '', 1, 1, '', 0, 23, ''),
(24, 0, '', '网站内容', 'menu-icon fa fa-desktop', 1, 1, '', 1, 24, ''),
(25, 24, 'Article/index', '产品管理', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 25, '网站虽然重要，身体更重要，出去走走吧。'),
(26, 24, 'Article/add', '新增产品', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 26, ''),
(27, 24, 'Article/edit', '编辑作品', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 27, ''),
(29, 24, 'Article/update', '保存作品', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 29, ''),
(30, 24, 'Article/del', '删除文章', '', 1, 1, '', 0, 30, ''),
(31, 24, 'Category/index', '分类管理', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 31, ''),
(32, 24, 'Category/add', '新增分类', 'menu-icon fa fa-caret-right', 1, 1, '', 1, 32, ''),
(33, 24, 'Category/edit', '编辑分类', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 33, ''),
(34, 24, 'Category/update', '保存分类', 'menu-icon fa fa-caret-right', 1, 1, '', 0, 34, ''),
(36, 24, 'Category/del', '删除分类', '', 1, 1, '', 0, 36, ''),
(75, 73, '', '编辑留言', '', 1, 1, '', 1, 0, ''),
(74, 73, '', '编辑需求', '', 1, 1, '', 1, 0, ''),
(43, 24, 'Flash/index', '焦点图', 'menu-icon fa fa-desktop', 1, 1, '', 1, 43, ''),
(44, 24, 'Flash/add', '新增焦点图', '', 1, 1, '', 1, 44, ''),
(45, 37, 'Flash/update', '保存焦点图', '', 1, 1, '', 0, 45, ''),
(46, 37, 'Flash/edit', '编辑焦点图', '', 1, 1, '', 0, 46, ''),
(47, 37, 'Flash/del', '删除焦点图', '', 1, 1, '', 0, 47, ''),
(48, 0, 'Personal/index', '个人中心', 'menu-icon fa fa-user', 1, 1, '', 1, 48, ''),
(49, 48, 'Personal/profile', '个人资料', 'menu-icon fa fa-user', 1, 1, '', 1, 49, ''),
(50, 48, 'Logout/index', '退出', '', 1, 1, '', 1, 50, ''),
(51, 9, 'Database/export', '备份', '', 1, 1, '', 0, 51, ''),
(52, 9, 'Database/optimize', '数据优化', '', 1, 1, '', 0, 52, ''),
(53, 9, 'Database/repair', '修复表', '', 1, 1, '', 0, 53, ''),
(54, 11, 'Update/updating', '升级安装', '', 1, 1, '', 0, 54, ''),
(55, 48, 'Personal/update', '资料保存', '', 1, 1, '', 0, 55, ''),
(56, 3, 'Setting/update', '设置保存', '', 1, 1, '', 0, 56, ''),
(57, 9, 'Database/del', '备份删除', '', 1, 1, '', 0, 57, ''),
(58, 2, 'variable/index', '自定义变量', '', 1, 1, '', 1, 0, ''),
(59, 58, 'variable/add', '新增变量', '', 1, 1, '', 0, 0, ''),
(60, 58, 'variable/edit', '编辑变量', '', 1, 1, '', 0, 0, ''),
(61, 58, 'variable/update', '保存变量', '', 1, 1, '', 0, 0, ''),
(62, 58, 'variable/del', '删除变量', '', 1, 1, '', 0, 0, ''),
(73, 0, '', '需求管理', 'menu-icon fa glyphicon glyphicon glyphicon-file', 1, 1, '', 1, 5, ''),
(72, 70, '', '新增用户', '', 1, 1, '', 1, 1, ''),
(71, 70, '', '管理用户', '', 1, 1, '', 1, 0, ''),
(70, 0, '', '用户管理', 'menu-icon fa fa-users', 1, 1, '', 1, 4, '');

-- --------------------------------------------------------

--
-- 表的结构 `qw_category`
--

CREATE TABLE IF NOT EXISTS `qw_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '父ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `o` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `fsid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `qw_category`
--

INSERT INTO `qw_category` (`id`, `pid`, `name`, `o`) VALUES
(1, 0, '厨房用具', 1),
(2, 1, '大型厨具', 3),
(3, 2, '油烟机', 1),
(4, 2, '电磁炉', -1);

-- --------------------------------------------------------

--
-- 表的结构 `qw_devlog`
--

CREATE TABLE IF NOT EXISTS `qw_devlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v` varchar(225) NOT NULL COMMENT '版本号',
  `y` int(4) NOT NULL COMMENT '年分',
  `t` int(10) NOT NULL COMMENT '发布日期',
  `log` text NOT NULL COMMENT '更新日志',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `qw_devlog`
--

INSERT INTO `qw_devlog` (`id`, `v`, `y`, `t`, `log`) VALUES
(1, '1.0.0', 2016, 1440259200, 'QWADMIN第一个版本发布。');

-- --------------------------------------------------------

--
-- 表的结构 `qw_flash`
--

CREATE TABLE IF NOT EXISTS `qw_flash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `o` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qw_links`
--

CREATE TABLE IF NOT EXISTS `qw_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `o` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qw_log`
--

CREATE TABLE IF NOT EXISTS `qw_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `t` int(10) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `qw_log`
--

INSERT INTO `qw_log` (`id`, `name`, `t`, `ip`, `log`) VALUES
(1, 'admin', 1460375004, '::1', '登录成功。'),
(2, 'admin', 1460376970, '::1', '编辑菜单，ID：26'),
(3, 'admin', 1460376989, '::1', '编辑菜单，ID：27'),
(4, 'admin', 1460377017, '::1', '编辑菜单，ID：29'),
(5, 'admin', 1460377183, '::1', '新增分类，ID：1，名称：厨房用具'),
(6, 'admin', 1460377221, '::1', '新增分类，ID：2，名称：大型厨具'),
(7, 'admin', 1460377227, '::1', '分类修改排序，ID：2'),
(8, 'admin', 1460377252, '::1', '新增分类，ID：3，名称：油烟机'),
(9, 'admin', 1460377255, '::1', '分类修改排序，ID：3'),
(10, 'admin', 1460377255, '::1', '分类修改排序，ID：3'),
(11, 'admin', 1460377256, '::1', '分类修改排序，ID：3'),
(12, 'admin', 1460377257, '::1', '分类修改排序，ID：3'),
(13, 'admin', 1460377258, '::1', '分类修改排序，ID：3'),
(14, 'admin', 1460377260, '::1', '分类修改排序，ID：3'),
(15, 'admin', 1460377279, '::1', '新增分类，ID：4，名称：电磁炉'),
(16, 'admin', 1460377503, '::1', '新增文章，AID：1'),
(17, 'admin', 1460378279, '::1', '登录成功。'),
(18, 'admin', 1460378343, '::1', '编辑菜单，ID：25'),
(19, 'admin', 1460380562, '::1', '新增菜单，名称：公司管理'),
(20, 'admin', 1460380865, '::1', '编辑菜单，ID：66'),
(21, 'admin', 1460380889, '::1', '编辑菜单，ID：66'),
(22, 'admin', 1460380967, '::1', '编辑菜单，ID：66'),
(23, 'admin', 1460381016, '::1', '编辑菜单，ID：66'),
(24, 'admin', 1460381070, '::1', '新增菜单，名称：公司管理'),
(25, 'admin', 1460381091, '::1', '新增菜单，名称：新增公司'),
(26, 'admin', 1460381129, '::1', '新增菜单，名称：公司组管理'),
(27, 'admin', 1460381177, '::1', '数据表''qw_article''优化完成！'),
(28, 'admin', 1460381188, '::1', '数据表优化完成！'),
(29, 'admin', 1460637427, '::1', '登录成功。'),
(30, 'admin', 1460637514, '::1', '删除菜单ID：66'),
(31, 'admin', 1460637574, '::1', '删除菜单ID：37'),
(32, 'admin', 1460637613, '::1', '删除菜单ID：Array'),
(33, 'admin', 1460637647, '::1', '编辑菜单，ID：43'),
(34, 'admin', 1460637671, '::1', '编辑菜单，ID：44'),
(35, 'admin', 1460637727, '::1', '删除菜单ID：Array'),
(36, 'admin', 1460637780, '::1', '删除菜单ID：Array'),
(37, 'admin', 1460637847, '::1', '编辑菜单，ID：13'),
(38, 'admin', 1460637902, '::1', '新增菜单，名称：用户管理'),
(39, 'admin', 1460638014, '::1', '编辑菜单，ID：70'),
(40, 'admin', 1460638072, '::1', '新增菜单，名称：管理用户'),
(41, 'admin', 1460638088, '::1', '新增菜单，名称：新增用户'),
(42, 'admin', 1460638113, '::1', '编辑菜单，ID：72'),
(43, 'admin', 1460638345, '::1', '新增菜单，名称：需求管理'),
(44, 'admin', 1460638366, '::1', '编辑菜单，ID：73'),
(45, 'admin', 1460638421, '::1', '新增菜单，名称：编辑需求'),
(46, 'admin', 1460638432, '::1', '新增菜单，名称：编辑留言');

-- --------------------------------------------------------

--
-- 表的结构 `qw_member`
--

CREATE TABLE IF NOT EXISTS `qw_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(225) NOT NULL,
  `head` varchar(255) NOT NULL COMMENT '头像',
  `sex` tinyint(1) NOT NULL COMMENT '0保密1男，2女',
  `birthday` int(10) NOT NULL COMMENT '生日',
  `phone` varchar(20) NOT NULL COMMENT '电话',
  `qq` varchar(20) NOT NULL COMMENT 'QQ',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `password` varchar(32) NOT NULL,
  `t` int(10) unsigned NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `qw_member`
--

INSERT INTO `qw_member` (`uid`, `user`, `head`, `sex`, `birthday`, `phone`, `qq`, `email`, `password`, `t`) VALUES
(1, 'admin', '/Public/attached/201601/1453389194.png', 1, 1420128000, '13800138000', '331349451', 'xieyanwei@qq.com', '66d6a1c8748025462128dc75bf5ae8d1', 1442505600);

-- --------------------------------------------------------

--
-- 表的结构 `qw_person`
--

CREATE TABLE IF NOT EXISTS `qw_person` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `head` varchar(255) NOT NULL,
  `name` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `qw_person`
--

INSERT INTO `qw_person` (`id`, `account`, `password`, `head`, `name`, `mobile`, `email`, `salt`) VALUES
(6, 'zlwzlw', 'eb818d62825eac20d32b22d1190838b7395abfeb', '', '', '13680997268', '422234924@qq.com', 'F130QsZEZOzHeVMzQd+5fYJt8fcRF14ReQfQ60+4zxI=');

-- --------------------------------------------------------

--
-- 表的结构 `qw_setting`
--

CREATE TABLE IF NOT EXISTS `qw_setting` (
  `k` varchar(100) NOT NULL COMMENT '变量',
  `v` varchar(255) NOT NULL COMMENT '值',
  `type` tinyint(1) NOT NULL COMMENT '0系统，1自定义',
  `name` varchar(255) NOT NULL COMMENT '说明',
  PRIMARY KEY (`k`),
  KEY `k` (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qw_setting`
--

INSERT INTO `qw_setting` (`k`, `v`, `type`, `name`) VALUES
('sitename', '恰维网络', 0, ''),
('title', 'QWADMIN', 0, ''),
('keywords', '关键词', 0, ''),
('description', '网站描述', 0, ''),
('footer', '2016©恰维网络', 0, ''),
('test', '测试', 1, '测试变量');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
