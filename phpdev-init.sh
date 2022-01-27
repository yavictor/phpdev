#!/bin/sh
echo "Update and upgrade"
sudo apt-get update -y && sudo apt-get upgrade -y
echo "Installing mysql"
sudo apt-get install mysql-server mysql-client -y
echo "Installing phpmyadmin"
sudo apt-get install phpmyadmin -y