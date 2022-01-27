#!/bin/sh
echo -n "\033[37;1;42mUpdate and upgrade\033[0m"
sudo apt update -y && sudo apt upgrade -y
echo -n "\033[37;1;42mInstalling curl and git\033[0m"
sudo apt install curl git
echo -n "\033[37;1;42mInstalling nginx\033[0m"
sudo apt install nginx
echo -n "\033[37;1;42mInstalling mysql\033[0m"
sudo apt install mysql-server -y
echo -n "\033[37;1;42mInstalling php-fpm and initialising\033[0m"
sudo apt -y install php7.4 php7.4-cli php7.4-fpm php7.4-json php7.4-pdo php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php-pear php7.4-bcmath
sudo systemctl start php7.4-fpm.service
echo -n "\033[37;1;42mInstalling phpmyadmin\033[0m"
sudo apt install phpmyadmin -y
echo -n "\033[37;1;42mInstalling vs code\033[0m"
sudo apt install software-properties-common apt-transport-https wget
wget -q https://packages.microsoft.com/keys/microsoft.asc -O- | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://packages.microsoft.com/repos/vscode stable main"
sudo apt update
sudo apt install code
echo -n "\033[37;1;42mInstalling Oh My Zsh\033[0m"
sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)" "" --unattended
echo -n "\033[37;1;42mPassword reset mysql for root user\033[0m"
sudo mysql -u root -Bse "UPDATE mysql.user SET plugin = 'mysql_native_password', authentication_string  = '' WHERE user = 'root';"
sudo systemctl restart mysql.service
