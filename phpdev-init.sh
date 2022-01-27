#!/bin/sh
echo "Update and upgrade"
sudo apt-get update -y && sudo apt-get upgrade -y
echo "Installing curl and git"
sudo apt install curl git
echo "Installing nginx"
sudo apt install nginx
echo "Installing mysql"
sudo apt install mysql-server -y
echo "Installing php-fpm and initialising"
sudo apt -y install php7.4 php7.4-cli php7.4-fpm php7.4-json php7.4-pdo php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php-pear php7.4-bcmath
sudo systemctl start php7.4-fpm.service
echo "Installing phpmyadmin"
sudo apt install phpmyadmin -y
echo "Installing vs code"
sudo apt install software-properties-common apt-transport-https wget
wget -q https://packages.microsoft.com/keys/microsoft.asc -O- | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://packages.microsoft.com/repos/vscode stable main"
sudo apt update
sudo apt install code
echo "Installing Oh My Zsh"
sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)" "" --unattended
echo "Password reset mysql for root user"
sudo mysql -u root -Bse "UPDATE mysql.user SET plugin = 'mysql_native_password', authentication_string  = '' WHERE user = 'root';"
sudo systemctl restart mysql.service