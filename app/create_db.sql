DROP TABLE users;
DROP TABLE groups;
DROP TABLE acos;
DROP TABLE aros;
DROP TABLE aros_acos;
DROP TABLE licenses;
DROP TABLE user_shop_accounts;
DROP TABLE request_headers;
DROP TABLE user_shop_apply_order_tmpls;
DROP TABLE user_shop_receive_fee_tmpls;
DROP TABLE user_shop_ship_tmpls;
DROP TABLE user_shop_evaluate_tmpls;
DROP TABLE user_shop_relist_crons;
DROP TABLE shops;

CREATE TABLE users (
  id INT(8) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  group_id INT(8) NOT NULL,
  license_id INT(8) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  deleted TINYINT NOT NULL DEFAULT 0,
  deleted_date DATETIME DEFAULT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY NAME_KEY (username)
);

CREATE TABLE groups (
  id INT(8) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE acos (
  id INT(10) NOT NULL AUTO_INCREMENT,
  parent_id INT(10) DEFAULT NULL,
  model varchar(255) DEFAULT NULL,
  foreign_key INT(10) DEFAULT NULL,
  alias varchar(255) DEFAULT NULL,
  lft INT(10) DEFAULT NULL,
  rght INT(10) DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE aros (
  id INT(10) NOT NULL AUTO_INCREMENT,
  parent_id INT(10) DEFAULT NULL,
  model varchar(255) DEFAULT NULL,
  foreign_key INT(10) DEFAULT NULL,
  alias varchar(255) DEFAULT NULL,
  lft INT(10) DEFAULT NULL,
  rght INT(10) DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE aros_acos (
  id INT(10) NOT NULL AUTO_INCREMENT,
  aro_id INT(10) NOT NULL,
  aco_id INT(10) NOT NULL,
  _create varchar(2) NOT NULL DEFAULT '0',
  _read varchar(2) NOT NULL DEFAULT '0',
  _update varchar(2) NOT NULL DEFAULT '0',
  _delete varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY ARO_ACO_KEY (aro_id ,aco_id)
);

CREATE TABLE licenses (
  id INT(8) NOT NULL AUTO_INCREMENT,
  name VARCHAR(127) NOT NULL,
  shop_id INT(8),
  max_account INT(8),
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE user_shop_account (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user_id INT(8) NOT NULL,
  shop_id INT(8) NOT NULL,
  shop_username VARCHAR(50) NOT NULL,
  shop_password VARCHAR(255),
  cookie_file VARCHAR(255),
  request_header_id INT(8),
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  deleted TINYINT NOT NULL,
  deleted_date DATETIME DEFAULT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY USER_SHOP_NAME_KEY (user_id, shop_id, shop_username)
);

CREATE TABLE request_headers (
  id INT(8) NOT NULL AUTO_INCREMENT,
  useragent VARCHAR(255),
  PRIMARY KEY(id)
);

CREATE TABLE user_shop_apply_order_tmpl (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user_id INT(8) NOT NULL,
  shop_id INT(8) NOT NULL,
  body TEXT,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY USER_SHOP_TYPE_KEY (user_id, shop_id)
);

CREATE TABLE user_shop_receive_fee_tmpl (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user_id INT(8) NOT NULL,
  shop_id INT(8) NOT NULL,
  body TEXT,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY USER_SHOP_TYPE_KEY (user_id, shop_id)
);

CREATE TABLE user_shop_ship_tmpl (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user_id INT(8) NOT NULL,
  shop_id INT(8) NOT NULL,
  body TEXT,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY USER_SHOP_TYPE_KEY (user_id, shop_id)
);

CREATE TABLE user_shop_evaluate_tmpl (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user_id INT(8) NOT NULL,
  shop_id INT(8) NOT NULL,
  body TEXT,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY USER_SHOP_TYPE_KEY (user_id, shop_id)
);

CREATE TABLE user_shop_relist_cron (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user_id INT(8) NOT NULL,
  shop_id INT(8) NOT NULL,
  `interval` INT(8) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY USER_SHOP_TYPE_KEY (user_id, shop_id)
);

CREATE TABLE shops (
  id INT(8) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL,
  PRIMARY KEY(id)
);

