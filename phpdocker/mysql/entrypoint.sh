#!/bin/bash
cd /application
service mysql start

mysql -uroot -p123456 -e "CREATE DATABASE IF NOT EXISTS chalhoub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

tail -f /dev/stdout