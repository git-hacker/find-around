-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-01-14 09:10:58
-- 服务器版本： 5.5.48-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapxcx`
--

-- --------------------------------------------------------

--
-- 表的结构 `map_admin`
--

CREATE TABLE IF NOT EXISTS `map_admin` (
  `a_id` smallint(5) unsigned NOT NULL COMMENT '管理员ID',
  `account` varchar(32) NOT NULL COMMENT '登陆账号',
  `password` varchar(32) NOT NULL COMMENT '登录密码',
  `group_id` smallint(5) unsigned NOT NULL COMMENT '组ID',
  `ctime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `utime` int(10) unsigned NOT NULL COMMENT '修改时间',
  `last_login_time` int(10) unsigned NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL COMMENT '最后登陆IP',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态 0正常 9删除'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='管理员表';

--
-- 转存表中的数据 `map_admin`
--

INSERT INTO `map_admin` (`a_id`, `account`, `password`, `group_id`, `ctime`, `utime`, `last_login_time`, `last_login_ip`, `status`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, 1515722178, '36.106.89.42', 0),
(2, 'test', 'e10adc3949ba59abbe56e057f20f883e', 2, 0, 1515736837, 1481766233, '127.0.0.1', 9),
(3, 'ceshi', 'e10adc3949ba59abbe56e057f20f883e', 1, 1481703744, 1481706594, 1481769385, '127.0.0.1', 0),
(4, 'ceshi1', '4297f44b13955235245b2497399d7a93', 1, 1481703826, 1515736852, 0, '', 9),
(5, '1234', 'e10adc3949ba59abbe56e057f20f883e', 1, 1481792243, 1515736847, 0, '', 9);

-- --------------------------------------------------------

--
-- 表的结构 `map_admin_action`
--

CREATE TABLE IF NOT EXISTS `map_admin_action` (
  `action_id` smallint(8) unsigned NOT NULL COMMENT '记录ID',
  `model` varchar(18) NOT NULL COMMENT '控制器',
  `method` varchar(18) NOT NULL COMMENT '方法',
  `action_name` varchar(30) NOT NULL COMMENT '权限名称',
  `group_name` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='权限表';

--
-- 转存表中的数据 `map_admin_action`
--

INSERT INTO `map_admin_action` (`action_id`, `model`, `method`, `action_name`, `group_name`) VALUES
(1, 'Member', 'memberList', '会员列表', 1),
(2, 'Member', 'deleteMember', '删除会员', 1),
(3, 'Member', 'editMember', '修改会员', 1);

-- --------------------------------------------------------

--
-- 表的结构 `map_admin_group`
--

CREATE TABLE IF NOT EXISTS `map_admin_group` (
  `group_id` smallint(5) unsigned NOT NULL COMMENT '组ID',
  `group_name` varchar(30) NOT NULL COMMENT '组名',
  `permission` text NOT NULL COMMENT '权限 序列化',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `utime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0正常 9删除'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台权限分组表';

--
-- 转存表中的数据 `map_admin_group`
--

INSERT INTO `map_admin_group` (`group_id`, `group_name`, `permission`, `ctime`, `utime`, `status`) VALUES
(1, '测试组', 'a:5:{i:0;s:1:"1";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"5";i:4;s:1:"6";}', 1481698457, 1481769367, 0),
(2, '广告组', 'a:5:{i:0;s:2:"65";i:1;s:2:"66";i:2;s:2:"67";i:3;s:2:"68";i:4;s:2:"69";}', 1481706644, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `map_history`
--

CREATE TABLE IF NOT EXISTS `map_history` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT '1',
  `uid` int(11) DEFAULT NULL,
  `ctime` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lnt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `map_history`
--

INSERT INTO `map_history` (`id`, `keyword`, `num`, `uid`, `ctime`, `status`, `lat`, `lnt`) VALUES
(77, '公交站', 5, 4, '1515725003', '0', '39.38326', '117.04412'),
(78, '公测', 1, 4, '1515725045', '0', '39.38326', '117.04412'),
(79, '酒店', 1, 8, '1515731371', '0', '39.11157989501953', '117.21061706542969'),
(80, '超市', 1, 8, '1515731387', '0', '39.11157989501953', '117.21061706542969'),
(84, '酒店', 3, 6, '1515732084', '0', '39.0873', '117.1201'),
(85, '公测', 2, 6, '1515732126', '0', '39.0873', '117.1201'),
(86, '公交站', 6, 6, '1515732350', '0', '39.08729', '117.1202'),
(87, '小白楼', 1, 8, '1515740456', '0', '39.11157989501953', '117.21061706542969'),
(88, '小白楼', 1, 8, '1515740456', '0', '39.11157989501953', '117.21061706542969'),
(89, '厕所', 3, 5, '1515758900', '0', '39.02453', '117.35227'),
(90, '小吃', 1, 5, '1515758999', '0', '39.02453', '117.35227'),
(91, '超市', 1, 4, '1515759573', '0', '39.075577', '117.16609'),
(92, '经贸科技', 2, 6, '1515759952', '0', '39.101032', '117.10535'),
(93, '后台在', 1, 6, '1515759997', '0', '39.101097', '117.105484'),
(94, '地铁站', 1, 4, '1515760327', '0', '39.075577', '117.16609'),
(95, '公交站', 1, 5, '1515804286', '0', '39.025555', '117.34566'),
(97, '少年', 1, 4, '1515812199', '0', '39.111652', '117.2106'),
(98, '鑫茂科技', 1, 4, '1515812303', '0', '39.087055', '117.12854'),
(99, '金茂科技', 2, 6, '1515812424', '0', '39.087055', '117.12854'),
(100, '华苑地铁站', 1, 6, '1515812534', '0', '39.087055', '117.12854'),
(101, '鑫茂科技', 4, 6, '1515812772', '0', '39.08756', '117.12485'),
(102, '酒店', 1, 4, '1515815358', '0', '39.38326', '117.04412'),
(103, '小白楼', 2, 4, '1515815391', '0', '39.11309', '117.21792'),
(104, '鑫茂', 1, 6, '1515815774', '0', '39.01953', '117.24022'),
(105, '小白楼', 2, 6, '1515815853', '0', '39.111656', '117.210594'),
(106, '超市', 1, 6, '1515815876', '0', '39.11269', '117.217476'),
(107, '海河东', 1, 10, '1515824200', '0', '39.112747', '117.21735'),
(108, '海哥东路', 1, 10, '1515824326', '0', '39.112747', '117.21735'),
(109, '想', 1, 6, '1515825371', '0', '39.111656', '117.210594'),
(110, '小', 1, 6, '1515825410', '0', '39.1116', '117.2106'),
(111, '饭店', 1, 6, '1515825452', '0', '39.1116', '117.2106'),
(112, '餐馆', 5, 6, '1515825509', '0', '39.1116', '117.210625');

-- --------------------------------------------------------

--
-- 表的结构 `map_markets`
--

CREATE TABLE IF NOT EXISTS `map_markets` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lnt` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `ctime` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `map_markets`
--

INSERT INTO `map_markets` (`id`, `keyword`, `photo`, `lat`, `lnt`, `remark`, `status`, `address`, `type`, `ctime`, `uid`) VALUES
(1, '众享通赢', 'http://mapxcx.suzwgt.com/Uploads/5a557f0599b85.png', '39.0851', '117.19937', '不错的公司', '0', '天津市天津市', '', '1515552519', 4);

-- --------------------------------------------------------

--
-- 表的结构 `map_user`
--

CREATE TABLE IF NOT EXISTS `map_user` (
  `id` int(11) NOT NULL COMMENT '用户表',
  `uname` varchar(255) DEFAULT NULL COMMENT '微信登录',
  `photo` varchar(255) DEFAULT NULL COMMENT '用户地址',
  `name` varchar(255) DEFAULT NULL COMMENT '用户名称',
  `sex` varchar(255) DEFAULT NULL COMMENT '用户电话',
  `pwd` varchar(255) DEFAULT NULL COMMENT '用户登录密码',
  `openid` varchar(255) DEFAULT NULL COMMENT '用户登录名',
  `status` varchar(255) DEFAULT '0',
  `addtime` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `map_user`
--

INSERT INTO `map_user` (`id`, `uname`, `photo`, `name`, `sex`, `pwd`, `openid`, `status`, `addtime`, `source`) VALUES
(4, 'Topqiang', 'https://wx.qlogo.cn/mmopen/vi_32/jBg4Hc9Vy7fneIPdkprk0uTP745rec7l2g2UJaUJYpXOGISSIGDZsBIMia3Y0xvV36Hkle99xVNo1zbeyJysHFw/0', 'Topqiang', '1', 'e10adc3949ba59abbe56e057f20f883e', 'oPy0a0e7_bJLO_RoeaaDWAgrJHGk', '0', '1515488180', 'wx'),
(5, 'Martin', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKU1tvv5qicJ1xWx5M0BOR6D1Tgq1MVhqns4TeHAxRliabNtfmwDKK3fpdqUogaC9WRfS2wB3qV7KGg/0', 'Martin', '1', 'e10adc3949ba59abbe56e057f20f883e', 'oPy0a0fP2oA_nRRU15WGA8r-UN6s', '0', '1515500671', 'wx'),
(6, '宋嘉欣', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJHJRRfE9TkiaXn4FOncZcIb9WLwKzYRrATcGY6dtia8mZibKD8TAQPjtgjYfeU965BV1IYscmibNhdzA/0', '宋嘉欣', '2', 'e10adc3949ba59abbe56e057f20f883e', 'oPy0a0TKmrEgscJhI99mfzM9O5lI', '0', '1515569142', 'wx'),
(8, '麻辣香锅', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKuLsA1AAjUSFYGAPLrqlVTSicjVsCHHyUQia2oFGdpwkKxxnfQfDfq6hdwHXxGZia4qEGI5ro6SibBqA/0', '麻辣香锅', '1', 'e10adc3949ba59abbe56e057f20f883e', 'oPy0a0UwSABUpbyd2AkWxbNPHbrA', '0', '1515722782', 'wx'),
(10, '冰秋', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLAWzNxwFnic42jp23uRCUjZSL42iaFSiaMbLiaYPFbvmeYoIR0icdus4TZkcib10zolQWibFxBEtibGabGXw/0', '冰秋', '2', 'e10adc3949ba59abbe56e057f20f883e', 'oPy0a0ehXB0klO4Qn-r9Nxo6L7KE', '0', '1515824168', 'wx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `map_admin`
--
ALTER TABLE `map_admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `map_admin_action`
--
ALTER TABLE `map_admin_action`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `map_admin_group`
--
ALTER TABLE `map_admin_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `map_history`
--
ALTER TABLE `map_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_markets`
--
ALTER TABLE `map_markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_user`
--
ALTER TABLE `map_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `map_admin`
--
ALTER TABLE `map_admin`
  MODIFY `a_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `map_admin_action`
--
ALTER TABLE `map_admin_action`
  MODIFY `action_id` smallint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录ID',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `map_admin_group`
--
ALTER TABLE `map_admin_group`
  MODIFY `group_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '组ID',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `map_history`
--
ALTER TABLE `map_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `map_markets`
--
ALTER TABLE `map_markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `map_user`
--
ALTER TABLE `map_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表',AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
