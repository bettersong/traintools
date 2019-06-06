-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-09-06 00:39:26
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traintools`
--

-- --------------------------------------------------------

--
-- 表的结构 `bmanage`
--

CREATE TABLE `bmanage` (
  `bManageId` int(11) NOT NULL,
  `bManageBranch` char(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- 转存表中的数据 `bmanage`
--

INSERT INTO `bmanage` (`bManageId`, `bManageBranch`) VALUES
(1, '路局'),
(2, '工务段'),
(3, '车间'),
(4, '班组');

-- --------------------------------------------------------

--
-- 表的结构 `cecontrol`
--

CREATE TABLE `cecontrol` (
  `ceControlId` int(11) NOT NULL,
  `ceControlMaster` varchar(10) NOT NULL,
  `ceControlPosition` varchar(20) NOT NULL,
  `ceControlNote` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cecontrol`
--

INSERT INTO `cecontrol` (`ceControlId`, `ceControlMaster`, `ceControlPosition`, `ceControlNote`) VALUES
(1, '松速度', '算法啊发的', '没人可以阻止我'),
(2, '阿萨德 ', '森阿萨', '阿森'),
(3, '阿森', '算法啊发的', '没人可以阻止我'),
(4, '阿萨德 ', '森阿萨', '阿森'),
(5, '跟锋', '凤凰', '僧方'),
(6, '森刚', '封坛', '肉汤圆'),
(7, '汉的锋', '凤凰', '很高方'),
(8, '均衡刚', '封凤凰', '森好圆'),
(9, '213', '123', '213'),
(10, '213', '123', '123'),
(11, '1', '1', '1');

-- --------------------------------------------------------

--
-- 表的结构 `cemanage`
--

CREATE TABLE `cemanage` (
  `ceManageId` int(11) NOT NULL,
  `ceManageName` varchar(20) NOT NULL,
  `ceManageAmount` int(11) NOT NULL,
  `ceManageTime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cemanage`
--

INSERT INTO `cemanage` (`ceManageId`, `ceManageName`, `ceManageAmount`, `ceManageTime`) VALUES
(1, '阿发送扥', 342, '07:12:07'),
(2, '头疼', 56436, '19:18:24'),
(3, '阿森的送扥', 342, '08:12:07'),
(4, '额粉色疼', 5632436, '16:18:24');

-- --------------------------------------------------------

--
-- 表的结构 `clearrecord`
--

CREATE TABLE `clearrecord` (
  `clrecordId` int(15) NOT NULL,
  `clrecordLeader` varchar(10) NOT NULL,
  `clrecordDate` date NOT NULL,
  `clrecordStatus` varchar(20) NOT NULL,
  `clrecordNote` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `clearrecord`
--

INSERT INTO `clearrecord` (`clrecordId`, `clrecordLeader`, `clrecordDate`, `clrecordStatus`, `clrecordNote`) VALUES
(1, '324', '2018-08-05', '完成', '没人可以阻止我');

-- --------------------------------------------------------

--
-- 表的结构 `detail`
--

CREATE TABLE `detail` (
  `DetailId` int(10) NOT NULL,
  `DetailName` char(10) NOT NULL,
  `DetailRFIDType` int(10) NOT NULL,
  `DetailMaster` int(10) NOT NULL,
  `DetailWarehouse` int(10) NOT NULL,
  `deToolListId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- 转存表中的数据 `detail`
--

INSERT INTO `detail` (`DetailId`, `DetailName`, `DetailRFIDType`, `DetailMaster`, `DetailWarehouse`, `deToolListId`) VALUES
(1, '扳手11', 1, 1, 1, 21),
(2, '扳手', 1, 1, 1, 21),
(4, '老虎钳', 2, 2, 2, 0),
(5, '老虎钳', 2, 2, 2, 0),
(6, '老虎钳', 2, 2, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `devicclass`
--

CREATE TABLE `devicclass` (
  `deClassId` int(11) NOT NULL,
  `deClassName` varchar(20) NOT NULL,
  `deClassClass` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `devicclass`
--

INSERT INTO `devicclass` (`deClassId`, `deClassName`, `deClassClass`) VALUES
(1002, '有源', '大'),
(1027, '无源', '小');

-- --------------------------------------------------------

--
-- 表的结构 `deviclist`
--

CREATE TABLE `deviclist` (
  `deListId` bigint(11) NOT NULL,
  `deListName` varchar(20) NOT NULL,
  `deListQuantity` int(11) NOT NULL,
  `deListClass` varchar(20) NOT NULL,
  `deListType` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `deviclist`
--

INSERT INTO `deviclist` (`deListId`, `deListName`, `deListQuantity`, `deListClass`, `deListType`) VALUES
(1011, '234', 234, '234', '1027'),
(1012, '234', 234, '234', '1002'),
(1013, '234', 234, '234', '1002'),
(1014, '123', 123, '123', '1027'),
(1017, '111', 111, '111', '1002');

-- --------------------------------------------------------

--
-- 表的结构 `equipmentforms`
--

CREATE TABLE `equipmentforms` (
  `eqformsId` int(11) NOT NULL,
  `eqformsMaster` varchar(20) NOT NULL,
  `eqformsDate` date NOT NULL,
  `eqformsStatus` varchar(20) NOT NULL,
  `eqformsNote` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `equipmentforms`
--

INSERT INTO `equipmentforms` (`eqformsId`, `eqformsMaster`, `eqformsDate`, `eqformsStatus`, `eqformsNote`) VALUES
(1, '跟随等三等', '2018-08-04', '完成', '你来呀'),
(2, '发的的', '2018-08-11', '未完成', '阿森'),
(3, '地方广泛等三等', '2018-08-04', '完成', '你巅峰呀'),
(4, '法等啊的的', '2018-08-11', '未完成', '阿森');

-- --------------------------------------------------------

--
-- 表的结构 `historysign`
--

CREATE TABLE `historysign` (
  `hiSignId` int(11) NOT NULL,
  `hiSignDate` date NOT NULL,
  `hiSignPeopleY` int(11) NOT NULL,
  `hiSignPeopleS` int(11) NOT NULL,
  `hiSignNumber` int(11) NOT NULL,
  `hiSignNote` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `historysign`
--

INSERT INTO `historysign` (`hiSignId`, `hiSignDate`, `hiSignPeopleY`, `hiSignPeopleS`, `hiSignNumber`, `hiSignNote`) VALUES
(1, '2018-08-31', 324, 213, 23423423, '你来呀'),
(2, '2018-08-04', 213, 4532, 234, '小样'),
(3, '2018-08-31', 324, 213, 23423423, '你来呀'),
(4, '2018-08-04', 213, 4532, 234, '小样');

-- --------------------------------------------------------

--
-- 表的结构 `hworkorder`
--

CREATE TABLE `hworkorder` (
  `hwOrderId` int(11) NOT NULL,
  `hwOrderLeader` varchar(10) NOT NULL,
  `hwOrderTime` varchar(10) NOT NULL,
  `hwOrderState` varchar(10) NOT NULL,
  `hwOrderRemarks` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `hworkorder`
--

INSERT INTO `hworkorder` (`hwOrderId`, `hwOrderLeader`, `hwOrderTime`, `hwOrderState`, `hwOrderRemarks`) VALUES
(1001, '张三', '2018-1-1', '完成', '好');

-- --------------------------------------------------------

--
-- 表的结构 `peopleforms`
--

CREATE TABLE `peopleforms` (
  `peFormsId` int(11) NOT NULL,
  `peFormsName` varchar(20) NOT NULL,
  `peFormsTool` varchar(20) NOT NULL,
  `peFormsMaster` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `peopleforms`
--

INSERT INTO `peopleforms` (`peFormsId`, `peFormsName`, `peFormsTool`, `peFormsMaster`) VALUES
(1, '跟随等', '共度', '三等'),
(2, '三等', 'sdf孙', 'sdf孙'),
(3, '跟东方等', '共撒风度', '三as跟等'),
(4, '三sdf三等更等', 'sdf啊嘎嘎孙', 'sd风格啊三等f孙');

-- --------------------------------------------------------

--
-- 表的结构 `pmanage`
--

CREATE TABLE `pmanage` (
  `pManageId` int(11) NOT NULL,
  `pManageName` varchar(20) NOT NULL,
  `pManageSex` int(4) NOT NULL,
  `pManageBranch` int(10) NOT NULL,
  `pManagePosition` int(10) NOT NULL,
  `pManageStaffId` int(10) NOT NULL,
  `pManageContact` bigint(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `pmanage`
--

INSERT INTO `pmanage` (`pManageId`, `pManageName`, `pManageSex`, `pManageBranch`, `pManagePosition`, `pManageStaffId`, `pManageContact`) VALUES
(1, '张三', 2, 2, 7, 16, 15213653332),
(2, '李四', 2, 3, 9, 33, 15155635653),
(3, '王五', 1, 1, 1, 24, 15352369756),
(4, '赵六', 1, 1, 2, 42, 18865332693),
(9, '张江', 2, 2, 7, 23, 13125362536);

-- --------------------------------------------------------

--
-- 表的结构 `reportforms`
--

CREATE TABLE `reportforms` (
  `reFormsId` int(11) NOT NULL,
  `reFormsMaster` varchar(20) NOT NULL,
  `reFormsDate` date NOT NULL,
  `reFormsStatus` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `reportforms`
--

INSERT INTO `reportforms` (`reFormsId`, `reFormsMaster`, `reFormsDate`, `reFormsStatus`) VALUES
(1, '丰富的', '2018-08-11', '完成'),
(2, '打工打工', '2018-08-24', '未完成'),
(3, '三等的', '2018-08-11', '完成'),
(4, '打公分的工', '2018-08-24', '未完成');

-- --------------------------------------------------------

--
-- 表的结构 `review`
--

CREATE TABLE `review` (
  `reviewId` int(11) NOT NULL,
  `reviewLeader` varchar(10) NOT NULL,
  `reviewTime` varchar(10) NOT NULL,
  `reviewState` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `review`
--

INSERT INTO `review` (`reviewId`, `reviewLeader`, `reviewTime`, `reviewState`) VALUES
(1001, '李四', '2018-1-1', '完成');

-- --------------------------------------------------------

--
-- 表的结构 `rfidclass`
--

CREATE TABLE `rfidclass` (
  `RFIDClassId` int(11) NOT NULL,
  `RFIDClassType` char(10) NOT NULL,
  `RFIDClassNote` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `rfidclass`
--

INSERT INTO `rfidclass` (`RFIDClassId`, `RFIDClassType`, `RFIDClassNote`) VALUES
(1, '有源', '111'),
(2, '无源', '111');

-- --------------------------------------------------------

--
-- 表的结构 `rfidtag`
--

CREATE TABLE `rfidtag` (
  `RFIDTagId` int(11) NOT NULL,
  `RFIDTagType` int(11) NOT NULL,
  `RFIDTagCode` bigint(11) NOT NULL,
  `RFIDTagNote` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `rfidtag`
--

INSERT INTO `rfidtag` (`RFIDTagId`, `RFIDTagType`, `RFIDTagCode`, `RFIDTagNote`) VALUES
(1, 1, 1535959819, '111'),
(2, 1, 1535959819, '111'),
(4, 1, 1535962451, '111'),
(5, 1, 1535962451, '111'),
(6, 1, 1535962451, '111'),
(7, 1, 1535962423, '111');

-- --------------------------------------------------------

--
-- 表的结构 `todaysign`
--

CREATE TABLE `todaysign` (
  `toSignId` int(15) NOT NULL,
  `toSignName` varchar(10) NOT NULL,
  `toSignSign` char(10) NOT NULL,
  `toSignTime` time NOT NULL,
  `toSignPlace` varchar(30) NOT NULL,
  `toSignNotes` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `todaysign`
--

INSERT INTO `todaysign` (`toSignId`, `toSignName`, `toSignSign`, `toSignTime`, `toSignPlace`, `toSignNotes`) VALUES
(1, '老李', '是', '16:10:14', '江西', '没有'),
(2, '老熊', '不是', '01:03:05', '', ''),
(3, '老李', '是', '16:10:14', '江西', '没有'),
(4, '老熊', '不是', '01:03:05', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `toolsclass`
--

CREATE TABLE `toolsclass` (
  `toClassId` int(11) NOT NULL,
  `toClassName` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- 转存表中的数据 `toolsclass`
--

INSERT INTO `toolsclass` (`toClassId`, `toClassName`) VALUES
(1, '有源'),
(2, '无源'),
(3, '有源'),
(4, '无源');

-- --------------------------------------------------------

--
-- 表的结构 `toolsform`
--

CREATE TABLE `toolsform` (
  `toFormId` int(11) NOT NULL,
  `toFormName` varchar(20) NOT NULL,
  `toFormMaster` varchar(10) NOT NULL,
  `toFormNotes` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `toolsform`
--

INSERT INTO `toolsform` (`toFormId`, `toFormName`, `toFormMaster`, `toFormNotes`) VALUES
(1, '黄孙', '森阿森 ', '阿森 啊'),
(2, 'ad发', '阿森', '发'),
(3, '疯孙', '森法等森 ', '阿森ad跟啊'),
(4, '好', '刚刚', '发');

-- --------------------------------------------------------

--
-- 表的结构 `toolslist`
--

CREATE TABLE `toolslist` (
  `toListId` int(10) NOT NULL,
  `toListName` varchar(15) NOT NULL,
  `toListAmount` char(11) NOT NULL,
  `toListType` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `toolslist`
--

INSERT INTO `toolslist` (`toListId`, `toListName`, `toListAmount`, `toListType`) VALUES
(22, '老虎钳', '2', '1'),
(21, '扳手', '50', '1'),
(23, '螺丝刀', '2', '1'),
(24, '万用表', '2', '1'),
(32, '试电笔', '2', '1'),
(34, 'asdf', '自动统计', '2');

-- --------------------------------------------------------

--
-- 表的结构 `tworkorder`
--

CREATE TABLE `tworkorder` (
  `twOrderId` int(11) NOT NULL,
  `twOrderLocation` varchar(20) NOT NULL,
  `twOrderLeader` varchar(10) NOT NULL,
  `twOrderTime` date NOT NULL,
  `twOrderExTime` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `tworkorder`
--

INSERT INTO `tworkorder` (`twOrderId`, `twOrderLocation`, `twOrderLeader`, `twOrderTime`, `twOrderExTime`) VALUES
(1010, '高铁线路一', '123', '2018-08-02', '2018-08-03'),
(1011, '123', '1233333', '2018-08-04', '2018-08-05'),
(1012, '12', '12', '2018-08-07', '2018-08-08'),
(1018, '1', '1', '2018-08-02', '2018-08-02');

-- --------------------------------------------------------

--
-- 表的结构 `warehousemessage`
--

CREATE TABLE `warehousemessage` (
  `waMessageId` int(11) NOT NULL,
  `waMessageName` char(10) NOT NULL,
  `waMessageMaster` int(10) NOT NULL,
  `waMessageNotes` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `warehousemessage`
--

INSERT INTO `warehousemessage` (`waMessageId`, `waMessageName`, `waMessageMaster`, `waMessageNotes`) VALUES
(1, '仓库一', 3, '111'),
(2, '仓库二', 1, '111');

-- --------------------------------------------------------

--
-- 表的结构 `zmanage`
--

CREATE TABLE `zmanage` (
  `zManageId` int(11) NOT NULL,
  `zManagePosition` char(20) NOT NULL,
  `zManageBranch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- 转存表中的数据 `zmanage`
--

INSERT INTO `zmanage` (`zManageId`, `zManagePosition`, `zManageBranch`) VALUES
(1, '局领导', 1),
(2, '普通成员', 1),
(7, '段领导', 2),
(8, '普通成员', 1),
(9, '车间领导', 3),
(10, '普通成员', 3),
(11, '班组长', 4),
(12, '施工人员', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmanage`
--
ALTER TABLE `bmanage`
  ADD PRIMARY KEY (`bManageId`) USING BTREE;

--
-- Indexes for table `cecontrol`
--
ALTER TABLE `cecontrol`
  ADD PRIMARY KEY (`ceControlId`) USING BTREE;

--
-- Indexes for table `cemanage`
--
ALTER TABLE `cemanage`
  ADD PRIMARY KEY (`ceManageId`) USING BTREE;

--
-- Indexes for table `clearrecord`
--
ALTER TABLE `clearrecord`
  ADD PRIMARY KEY (`clrecordId`) USING BTREE;

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`DetailId`) USING BTREE;

--
-- Indexes for table `devicclass`
--
ALTER TABLE `devicclass`
  ADD PRIMARY KEY (`deClassId`) USING BTREE;

--
-- Indexes for table `deviclist`
--
ALTER TABLE `deviclist`
  ADD PRIMARY KEY (`deListId`) USING BTREE;

--
-- Indexes for table `equipmentforms`
--
ALTER TABLE `equipmentforms`
  ADD PRIMARY KEY (`eqformsId`) USING BTREE;

--
-- Indexes for table `historysign`
--
ALTER TABLE `historysign`
  ADD PRIMARY KEY (`hiSignId`) USING BTREE;

--
-- Indexes for table `hworkorder`
--
ALTER TABLE `hworkorder`
  ADD PRIMARY KEY (`hwOrderId`) USING BTREE;

--
-- Indexes for table `peopleforms`
--
ALTER TABLE `peopleforms`
  ADD PRIMARY KEY (`peFormsId`) USING BTREE;

--
-- Indexes for table `pmanage`
--
ALTER TABLE `pmanage`
  ADD PRIMARY KEY (`pManageId`) USING BTREE;

--
-- Indexes for table `reportforms`
--
ALTER TABLE `reportforms`
  ADD PRIMARY KEY (`reFormsId`) USING BTREE;

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewId`) USING BTREE;

--
-- Indexes for table `rfidclass`
--
ALTER TABLE `rfidclass`
  ADD PRIMARY KEY (`RFIDClassId`) USING BTREE;

--
-- Indexes for table `rfidtag`
--
ALTER TABLE `rfidtag`
  ADD PRIMARY KEY (`RFIDTagId`) USING BTREE;

--
-- Indexes for table `todaysign`
--
ALTER TABLE `todaysign`
  ADD PRIMARY KEY (`toSignId`) USING BTREE;

--
-- Indexes for table `toolsclass`
--
ALTER TABLE `toolsclass`
  ADD PRIMARY KEY (`toClassId`) USING BTREE;

--
-- Indexes for table `toolsform`
--
ALTER TABLE `toolsform`
  ADD PRIMARY KEY (`toFormId`) USING BTREE;

--
-- Indexes for table `toolslist`
--
ALTER TABLE `toolslist`
  ADD PRIMARY KEY (`toListId`) USING BTREE;

--
-- Indexes for table `tworkorder`
--
ALTER TABLE `tworkorder`
  ADD PRIMARY KEY (`twOrderId`) USING BTREE;

--
-- Indexes for table `warehousemessage`
--
ALTER TABLE `warehousemessage`
  ADD PRIMARY KEY (`waMessageId`) USING BTREE;

--
-- Indexes for table `zmanage`
--
ALTER TABLE `zmanage`
  ADD PRIMARY KEY (`zManageId`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bmanage`
--
ALTER TABLE `bmanage`
  MODIFY `bManageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cecontrol`
--
ALTER TABLE `cecontrol`
  MODIFY `ceControlId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `cemanage`
--
ALTER TABLE `cemanage`
  MODIFY `ceManageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `clearrecord`
--
ALTER TABLE `clearrecord`
  MODIFY `clrecordId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `detail`
--
ALTER TABLE `detail`
  MODIFY `DetailId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `devicclass`
--
ALTER TABLE `devicclass`
  MODIFY `deClassId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1028;
--
-- 使用表AUTO_INCREMENT `deviclist`
--
ALTER TABLE `deviclist`
  MODIFY `deListId` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;
--
-- 使用表AUTO_INCREMENT `equipmentforms`
--
ALTER TABLE `equipmentforms`
  MODIFY `eqformsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `historysign`
--
ALTER TABLE `historysign`
  MODIFY `hiSignId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `hworkorder`
--
ALTER TABLE `hworkorder`
  MODIFY `hwOrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
--
-- 使用表AUTO_INCREMENT `peopleforms`
--
ALTER TABLE `peopleforms`
  MODIFY `peFormsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `pmanage`
--
ALTER TABLE `pmanage`
  MODIFY `pManageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `reportforms`
--
ALTER TABLE `reportforms`
  MODIFY `reFormsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
--
-- 使用表AUTO_INCREMENT `rfidclass`
--
ALTER TABLE `rfidclass`
  MODIFY `RFIDClassId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `rfidtag`
--
ALTER TABLE `rfidtag`
  MODIFY `RFIDTagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `todaysign`
--
ALTER TABLE `todaysign`
  MODIFY `toSignId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `toolsclass`
--
ALTER TABLE `toolsclass`
  MODIFY `toClassId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `toolsform`
--
ALTER TABLE `toolsform`
  MODIFY `toFormId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `toolslist`
--
ALTER TABLE `toolslist`
  MODIFY `toListId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- 使用表AUTO_INCREMENT `tworkorder`
--
ALTER TABLE `tworkorder`
  MODIFY `twOrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1019;
--
-- 使用表AUTO_INCREMENT `warehousemessage`
--
ALTER TABLE `warehousemessage`
  MODIFY `waMessageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `zmanage`
--
ALTER TABLE `zmanage`
  MODIFY `zManageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
