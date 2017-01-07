#!/bin/sh

# install php
wget http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
sudo rpm -Uvh remi-release-6.rpm
sudo yum install php php-mbstring php-mysql php-pgsql php-devel --enablerepo=remi-php56,remi -y
