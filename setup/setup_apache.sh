#!/bin/sh

# install apache
sudo yum yum install httpd -y
sudo /etc/init.d/httpd start
sudo chkconfig httpd on
