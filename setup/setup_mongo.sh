#!/bin/sh

# install mongo
if [ ! -f /etc/yum.repos.d/10gen.repo ]; then
    repo=`cat << EOS
[10gen]
name=10gen Repository
baseurl=http://downloads-distro.mongodb.org/repo/redhat/os/x86_64
gpgcheck=0
enabled=1
EOS`
    sudo sh -c "echo \"$repo\" > /etc/yum.repos.d/10gen.repo"
fi
sudo yum install mongo-10gen mongo-10gen-server -y
sudo /etc/init.d/mongod start
sudo chkconfig mongod on
