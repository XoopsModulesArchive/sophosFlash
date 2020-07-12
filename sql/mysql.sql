#
# Table structure for table `xoops_sophosflash`
#
CREATE TABLE sophosflash (
  title varchar(30) NOT NULL default '',
  type varchar(7) NOT NULL default '',
  repdate varchar(10) NOT NULL default '',
  repdatestamp timestamp(14) NOT NULL,
  name varchar(20) NOT NULL default '',
  link varchar(70) NOT NULL default '',
  retrieved datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (title)
);


