

CREATE TABLE `BACKUP` (
  `wo_num` varchar(11) NOT NULL,
  `client` varchar(35) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `zip` varchar(12) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `phone_sys_type` varchar(35) DEFAULT NULL,
  `vm_sys_type` varchar(35) DEFAULT NULL,
  `bronze_date` varchar(20) DEFAULT NULL,
  `silver_date` varchar(20) DEFAULT NULL,
  `orig_inst_date` varchar(20) DEFAULT NULL,
  `telco` varchar(35) DEFAULT NULL,
  `telco_date` varchar(20) DEFAULT NULL,
  `problem` varchar(300) DEFAULT NULL,
  `order_date` varchar(20) DEFAULT NULL,
  `order_contact` varchar(35) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `CPU_ver` varchar(20) DEFAULT NULL,
  `request_date` varchar(20) DEFAULT NULL,
  `request_time` varchar(20) DEFAULT NULL,
  `billing_notes` varchar(400) DEFAULT NULL,
  `work_description` varchar(400) DEFAULT NULL, `status` varchar(10) NOT NULL,  PRIMARY KEY (`wo_num`)
);



CREATE TABLE `CLIENTS` (
  `client` varchar(50) NOT NULL,
  `address` varchar(75) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(20) DEFAULT 'FL',
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `orig_inst` varchar(20) DEFAULT NULL,
  `telco` varchar(50) DEFAULT NULL,
  `phone_sys_type` varchar(50) DEFAULT NULL,
  `vm_sys_type` varchar(50) DEFAULT NULL,
  `bronze_date` varchar(40) DEFAULT NULL,
  `silver_date` varchar(40) DEFAULT NULL,
  `telco_date` varchar(40) DEFAULT NULL,
  `order_contact` varchar(40) DEFAULT NULL
);



CREATE TABLE `CUSTOMER_WORK_ORDERS` (
  `wo_num` varchar(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `address` varchar(75) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(15) DEFAULT NULL,
  `zip` varchar(13) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `orig_inst_date` varchar(20) DEFAULT NULL,
  `phone_sys_type` varchar(50) DEFAULT NULL,
  `vm_sys_type` varchar(50) DEFAULT NULL,
  `bronze_date` varchar(20) DEFAULT NULL,
  `silver_date` varchar(20) DEFAULT NULL,
  `telco` varchar(50) DEFAULT NULL,
  `telco_date` varchar(50) DEFAULT NULL,
  `problem` varchar(200) DEFAULT NULL,
  `order_date` varchar(20) DEFAULT NULL,
  `order_contact` varchar(50) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `CPU_ver` varchar(20) DEFAULT NULL,
  `request_date` varchar(20) DEFAULT NULL,
  `request_time` varchar(20) DEFAULT NULL,
  `billing_notes` varchar(200) DEFAULT NULL,
  `work_description` varchar(350) DEFAULT NULL, `status` varchar(10) NOT NULL,
  PRIMARY KEY (`wo_num`)
);

CREATE TABLE `password` (
  `password` varchar(40) NOT NULL
);

INSERT INTO `password` VALUES('1ca218a9233e0deca14c8843ae541e88');


CREATE TABLE `del_password` (
  `password` varchar(40) NOT NULL
);

INSERT INTO `del_password` VALUES('28a6ea6267e236340b8774d47f460a5f');
