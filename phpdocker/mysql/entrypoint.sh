#!/bin/bash
cd /application
service mysql start

mysql -uroot -p123456 -e "CREATE DATABASE IF NOT EXISTS chalhoub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

mysql -uroot -p123456 -e "CREATE USER 'chalhoub_user'@'localhost' IDENTIFIED BY '123456'; GRANT ALL PRIVILEGES ON *.* TO 'chalhoub_user'@'localhost' WITH GRANT OPTION;"

mysql -uroot -p123456 -e "CREATE USER 'chalhoub_user'@'%' IDENTIFIED BY '123456'; GRANT ALL PRIVILEGES ON *.* TO 'chalhoub_user'@'%' WITH GRANT OPTION; FLUSH PRIVILEGES;"

tail -f /dev/stdout