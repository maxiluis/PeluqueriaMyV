#!/usr/bin/env bash

# Use single quotes instead of double quotes to make it work with special-character passwords
PASSWORD='12345678'
PROJECTFOLDER='peluqueria'

sudo apt-get update
sudo apt-get -y upgrade

sudo apt-get install -y apache2
sudo apt-get install -y php5

sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get -y install mysql-server
sudo apt-get install php5-mysql

sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

# create project folder
sudo mkdir "/var/www/html/${PROJECTFOLDER}"

# setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
    DocumentRoot "/var/www/html/${PROJECTFOLDER}/public"
    <Directory "/var/www/html/${PROJECTFOLDER}/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf

# enable mod_rewrite
sudo a2enmod rewrite

# restart apache
service apache2 restart

# remove default apache index.html
sudo rm "/var/www/html/index.html"

# install git
sudo apt-get -y install git

# git clone Peluqueria
sudo git clone https://github.com/maxiluis/PeluqueriaMyV.git "/var/www/html/${PROJECTFOLDER}"

# install Composer (not necessary by default)
#curl -s https://getcomposer.org/installer | php
#mv composer.phar /usr/local/bin/composer

# go to project folder, load Composer packages (not necessary by default)
#cd "/var/www/html/${PROJECTFOLDER}"
#composer install --dev

# run SQL statements from PELUQUERIA folder
sudo mysql -h "localhost" -u "root" "-p${PASSWORD}" < "/var/www/html/${PROJECTFOLDER}/_install/01-create-database.sql"
sudo mysql -h "localhost" -u "root" "-p${PASSWORD}" < "/var/www/html/${PROJECTFOLDER}/_install/02-create-table-client.sql"
sudo mysql -h "localhost" -u "root" "-p${PASSWORD}" < "/var/www/html/${PROJECTFOLDER}/_install/03-create-table-product.sql"
sudo mysql -h "localhost" -u "root" "-p${PASSWORD}" < "/var/www/html/${PROJECTFOLDER}/_install/04-insert-demo-data-into-table-song.sql"

# put the password into the application's config. This is quite hardcore, but why not :)
sudo sed -i "s/your_password/${PASSWORD}/" "/var/www/html/${PROJECTFOLDER}/application/config/config.php"

# final feedback
echo "Voila!"
