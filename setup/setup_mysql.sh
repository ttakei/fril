#!/bin/sh

# install mysql
sudo yum install mysql-server -y
sudo /etc/init.d/mysqld start
sudo chkconfig mysqld on

# create mysql db
mysql -uroot -e"create database cakedb default character set utf8;"
mysql -uroot -e"grant all privileges on cakedb.* to cake_user@localhost identified by 'cake_pass' with grant option;"
