#!/usr/bin/env bash


# Use single quotes instead of double quotes to make it work with special-character 
# Configuration variables
MYSQL_PASSWORD='root'
#za sada nam ovo nije potrebno
#USER_ZA_SERVER='userv'
#USER_ZA_SERVER_PASSWORD='pass'


#updating and upgrading
echo "***********************************************************"
echo "Updating"
echo "***********************************************************"
sudo apt-get update -y
echo "***********************************************************"
echo "Upgrade"
echo "***********************************************************"
# sudo apt-get upgrade -y
echo "***********************************************************"
echo "Adding user"
echo "***********************************************************"
#za sada nam ovo nije potrebno
#USER_ZA_SERVER='userv'
#USER_ZA_SERVER_PASSWORD='pass'
#sudo adduser $USER_ZA_SERVER --gecos "First Last,RoomNumber,WorkPhone,HomePhone" --disabled-password
#echo $USER_ZA_SERVER:$USER_ZA_SERVER_PASSWORD | sudo chpasswd

echo "***********************************************************"
echo "Omogucavamo logovanje preko sifre ovo samo za lokal"
echo "***********************************************************"
sudo sed -i -e 's/^PasswordAuthentication no$/PasswordAuthentication yes/g' /etc/ssh/sshd_config
sudo service ssh restart




#installing nginx
echo "***********************************************************"
echo "Install NGINX"
echo "***********************************************************"
sudo apt-get install nginx -y
sudo ufw allow 'Nginx HTTP'


#Installing mysql server with root password
echo "***********************************************************"
echo "Install MYSQL. Password for root is ${MYSQL_PASSWORD}"
echo "***********************************************************"
sudo debconf-set-selections <<< "mysql-server-5.7 mysql-server/root_password password ${MYSQL_PASSWORD}"
sudo debconf-set-selections <<< "mysql-server-5.7 mysql-server/root_password_again password ${MYSQL_PASSWORD}"
sudo apt install mysql-server-5.7 -y



echo "***********************************************************"
echo "Install EXPECT"
echo "***********************************************************"
sudo apt-get install expect -y


echo "***********************************************************"
echo "Install SECURE MYSQL."
echo "***********************************************************"
#Configuration for secure mysql
SECURE_MYSQL=$(expect -c "
set timeout 3
spawn sudo mysql_secure_installation
expect \"Enter password for user root:\"
send \"$MYSQL_PASSWORD\r\"
expect \"Press y|Y for Yes, any other key for No:\"
send \"n\r\"
expect \"Change the password for root ? ((Press y|Y for Yes, any other key for No) :\"
send \"n\r\"
expect \"Remove anonymous users? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect \"Disallow root login remotely? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect \"Remove test database and access to it? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect \"Reload privilege tables now? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect eof
")
#isprati dodatnu konfiguraciju na serveru delu za live
#
# Execution mysql_secure_installation
#
echo "${SECURE_MYSQL}"



echo "***********************************************************"
echo "Install PHP 7.2 and php7.2 php7.2-cli  php7.2-fpm php7.2-mysql php7.2-curl php7.2-common php7.2-json php7.2-opcache  php7.2-mbstring php7.2-zip php7.2-xml -y"
echo "***********************************************************"
sudo apt-get install  php7.2 php7.2-cli  php7.2-fpm php7.2-mysql php7.2-curl php7.2-common php7.2-json php7.2-opcache  php7.2-mbstring php7.2-zip php7.2-xml php7.2-bcmath  -y
echo "***********************************************************"
echo "Chackout PHP version"
echo "***********************************************************"
php -v


echo "***********************************************************"
echo "Edit PHP.INI. cgi.fix_pathinfo=0"
echo "***********************************************************"
#The g modifier is used to perform a global match (find all matches rather than stopping after the first match).
# 's/REGULAR_EXP/REPLACEMNET/OPTION'
# man sed for more info
sudo sed -i -e 's/^;cgi\.fix_pathinfo=1$/cgi.fix_pathinfo=0/g' /etc/php/7.2/fpm/php.ini

echo "***********************************************************"
echo "Edit PHP.INI. iprove max file size"
echo "***********************************************************"
# man sed for more info
sudo sed -i -e 's/^upload_max_filesize = 2M$/upload_max_filesize = 100M/g' /etc/php/7.2/fpm/php.ini
sudo sed -i -e 's/^post_max_size = 100M$/post_max_size = 100M/g' /etc/php/7.2/fpm/php.ini
#videti za live da li je dovoljno 128 MB => memory_limit = 128M
sudo sed -i -e 's/^post_max_size = 8M$/post_max_size = 100M/g' /etc/php/7.2/fpm/php.ini


echo "***********************************************************"
echo "sredjejemno ownera"
echo "***********************************************************"
sudo sed -i -e 's/^user = www-data$/user = vagrant/g' /etc/php/7.2/fpm/pool.d/www.conf
sudo sed -i -e 's/^group = www-data$/user = vagrant/g' /etc/php/7.2/fpm/pool.d/www.conf


echo "***********************************************************"
echo "Restart PHP7.2-FPM"
echo "***********************************************************"
sudo service php7.2-fpm restart


echo "***********************************************************"
echo "Configure /etc/nginx/sites-available/default https://www.nginx.com/resources/admin-guide/load-balancer/ http://nginx.org/en/docs/http/ngx_http_proxy_module.html https://www.digitalocean.com/community/tutorials/understanding-nginx-http-proxying-load-balancing-buffering-and-caching" 
echo "***********************************************************"
echo "
server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;

    root /var/www/project/public/;
    index index.php index.html index.htm;

    server_name localhost;

    #add_header X-Frame-Options \"SAMEORIGIN\";
    #add_header X-XSS-Protection \"1; mode=block\";
    #add_header X-Content-Type-Options \"nosniff\";

    location / {
       try_files \$uri \$uri/ /index.php?\$query_string;
    }
    charset   utf-8;
    error_page 404 /index.php;
    error_page 500 502 503 504 /50x.html;
    location = /50x.html {
        root /var/www/project/public/;
    }
    location ~ \.php$ {
        try_files \$uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;

        if (\$request_method = 'OPTIONS') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            #
            # Custom headers and headers various browsers *should* be OK with but aren't
            #
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
            #
            # Tell client that this pre-flight info is valid for 20 days
            #
            add_header 'Access-Control-Max-Age' 1728000;
            add_header 'Content-Type' 'text/plain charset=UTF-8';
            add_header 'Content-Length' 0;
            return 204;
        }
        if (\$request_method = 'POST') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
            add_header 'Access-Control-Expose-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
        }
        if (\$request_method = 'GET') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
            add_header 'Access-Control-Expose-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
        }
    }

    location ~ \.(zip|jpeg|jpg|png|gif|DAE|dae|woff|ttf|otf|glb|gltf|fbx|drc)$ {
        if (\$request_method = 'OPTIONS') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            #
            # Custom headers and headers various browsers *should* be OK with but aren't
            #
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
            #
            # Tell client that this pre-flight info is valid for 20 days
            #
            add_header 'Access-Control-Max-Age' 1728000;
            add_header 'Content-Type' 'text/plain charset=UTF-8';
            add_header 'Content-Length' 0;
            return 204;
        }
        if (\$request_method = 'POST') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
            add_header 'Access-Control-Expose-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
        }
        if (\$request_method = 'GET') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
            add_header 'Access-Control-Expose-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range,Authorization';
        }
    }
    location ~ /\. {
        access_log off;
        log_not_found off; 
        deny all;
    }

}" > /etc/nginx/sites-available/default 

#https://www.if-not-true-then-false.com/2011/nginx-and-php-fpm-configuration-and-optimizing-tips-and-tricks/
echo "***********************************************************"
echo "Configure /etc/nginx/nginx.conf -  worker_processes and worker_connections worker_rlimit_nofile"
echo "***********************************************************"
echo '
#Calculate possible max number of users per second: (worker_processes * worker_connections)/(keepalive_timeout * 2) = users/sec
user www-data;
#number of cpu cores, use htop to checkout
worker_processes auto;
pid /run/nginx.pid;
include /etc/nginx/modules-enabled/*.conf;
#Specifies the value for maximum file descriptors that can be opened by this process.
worker_rlimit_nofile 200000;
events {
        worker_connections 2048;
        multi_accept on;
}

http {

        ##
        # Basic Settings
        ##

        #this is only for VirtualBox, in live production it is on
        sendfile off;
        tcp_nopush on;
        tcp_nodelay on;
        keepalive_timeout 40;
        types_hash_max_size 2048;
        server_tokens off;
        client_max_body_size 100m;
        client_body_buffer_size 128k;

        # server_names_hash_bucket_size 64;
        # server_name_in_redirect off;

        include /etc/nginx/mime.types;
        default_type application/octet-stream;
                
        ##
        # SSL Settings
        ##

        ssl_protocols TLSv1 TLSv1.1 TLSv1.2; # Dropping SSLv3, ref: POODLE
        ssl_prefer_server_ciphers on;

        ##
        # Logging Settings
        ##

        access_log /var/log/nginx/access.log;
        error_log /var/log/nginx/error.log;

        ##
        # Gzip Settings


        gzip on;
        gzip_disable "msie6";

        gzip_vary on;
        gzip_proxied any;
        gzip_comp_level 6;
        gzip_buffers 16 8k;
        gzip_http_version 1.1;
        gzip_min_length 256;
        gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript application/javascript application/vnd.ms-fontobject application/x-font-ttf font/opentype image/svg+xml image/x-icon;

        ##
        # Virtual Host Configs
        ##

        include /etc/nginx/conf.d/*.conf;
        include /etc/nginx/sites-enabled/*;
}


#mail {
#       # See sample authentication script at:
#       # http://wiki.nginx.org/ImapAuthenticateWithApachePhpScript
#
#       # auth_http localhost/auth.php;
#       # pop3_capabilities "TOP" "USER";
#       # imap_capabilities "IMAP4rev1" "UIDPLUS";
#
#       server {
#               listen     localhost:110;
#               protocol   pop3;
#               proxy      on;
#       }
#
#       server {
#               listen     localhost:143;
#               protocol   imap;
#               proxy      on;
#       }
#}

' > /etc/nginx/nginx.conf


echo "***********************************************************"
echo "Restart NGINX"
echo "***********************************************************"
sudo service nginx restart


echo "***********************************************************"
echo "install htop for monitoring process"
echo "***********************************************************"
sudo apt-get install htop -y

echo "***********************************************************"
echo "Setup /var/www/project/   directory"
echo "***********************************************************"
sudo mkdir -p /var/www/project
sudo chown -R $USER:$USER /var/www/project
sudo chmod 755 /var/www/project


echo "***********************************************************"
echo "Installing composer..."
echo "***********************************************************"
cd ~
#development software
curl -sS https://getcomposer.org/installer -o composer-setup.php

sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer



echo "***********************************************************"
echo "Creating a Swap File"
echo "***********************************************************"
sudo fallocate -l 1G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
sudo swapon --show

sudo cp /etc/fstab /etc/fstab.bak
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab

cat /proc/sys/vm/swappiness
sudo sysctl vm.swappiness=10


echo "***********************************************************"
echo "Installing vendors..."
echo "***********************************************************"
cd /var/www/project/
composer install


echo "***********************************************************"
echo "Restart PHP5-FPM"
echo "***********************************************************"
sudo service php7.2-fpm restart

echo "***********************************************************"
echo "Restart NGINX"
echo "***********************************************************"
sudo service nginx restart

echo "***********************************************************"
echo "Instaliramo node i npm"
echo "***********************************************************"
cd ~
curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh
sudo bash nodesource_setup.sh
sudo apt install nodejs -y
nodejs -v
npm -v

echo "***********************************************************"
echo "Prebacujemo se na root"
echo "***********************************************************"
sudo su

echo "***********************************************************"
echo "Configure /etc/security/limits.conf for per user limits"
echo "***********************************************************"
echo '
* soft     nproc          200000    
* hard     nproc          200000   
* soft     nofile         200000   
* hard     nofile         200000
root soft     nproc          200000    
root hard     nproc          200000   
root soft     nofile         200000   
root hard     nofile         200000
' >> /etc/security/limits.conf


echo "***********************************************************"
echo "Configure /etc/pam.d/common-session for per user limits"
echo "***********************************************************"
echo '
session required pam_limits.so
' >> /etc/pam.d/common-session

echo "***********************************************************"
echo "Configure /etc/sysctl.conf for per user limits"
echo "***********************************************************"
echo '
fs.file-max = 200000
vm.swappiness=10
' >> /etc/sysctl.conf
sysctl -p


echo "***********************************************************"
echo "izlazimo sa root"
echo "***********************************************************"
sudo su vagrant


echo "***********************************************************"
echo "Edit /etc/php5/fpm/pool.d/www.conf php5-fpm"
echo "***********************************************************"
#racunamo na sledeci nacin: 
#A good way of figuring out this number is to think in terms of available memory. If you have 2GB: you assume Nginx + other processes will use at most 400MB, and you assume 20MB/process, you could do ( 2000MB - 400MB ) / 20 MB = roughly 80. ( MAX_MEMORY - 400MB ) / 20 MB.
#
sudo sed -i -e 's/^pm\.max_children = 5$/pm.max_children = 80/g' /etc/php/7.2/fpm/pool.d/www.conf
sudo sed -i -e 's/^pm\.start_servers = 2$/pm.start_servers = 5/g' /etc/php/7.2/fpm/pool.d/www.conf
sudo sed -i -e 's/^pm\.min_spare_servers = 1$/pm.min_spare_servers = 3/g' /etc/php/7.2/fpm/pool.d/www.conf
sudo sed -i -e 's/^pm\.max_spare_servers = 3$/pm.max_spare_servers = 6/g' /etc/php/7.2/fpm/pool.d/www.conf



echo "***********************************************************"
echo "See max limit of file descriptors cat /proc/sys/fs/file-max"
echo "***********************************************************"
cat /proc/sys/fs/file-max


echo "***********************************************************"
echo "See max hard limit ulimit -Hn"
echo "***********************************************************"
ulimit -Hn


echo "***********************************************************"
echo "See max soft limit ulimit -Sn"
echo "***********************************************************"
ulimit -Sn

echo "***********************************************************"
echo "See max   limit ulimit -n"
echo "***********************************************************"
ulimit -n



echo "***********************************************************"
echo "ufw - Uncomplicated Firewall - https://help.ubuntu.com/lts/serverguide/firewall.html.en"
echo "***********************************************************"
sudo ufw allow 22
UFW=$(expect -c "
set timeout 3
spawn sudo ufw enable
expect \"Proceed with operation (y|n)?\"
send \"y\r\"
expect eof
")
#isprati dodatnu konfiguraciju na serveru delu za live
#
# Execution mysql_secure_installation
#
echo "${UFW}"

#ovo je samo za lokal, biti oprezan da li treba otvoriti port na live serveru
#sudo ufw allow 3306/tcp

sudo service ufw restart
sudo ufw status numbered

#pokazuje otvorene portove
netstat -tln



echo "***********************************************************"
echo "Restart server. Please do vagrant halt!!!!!!!!!!!!! and then vagrant up"
echo "***********************************************************"
#sudo shutdown -r now
echo "***********************************************************"
echo "Note: if internet connection was broken while installing this script you have to run everything again and prepare good internet connection!!"
echo "***********************************************************"
#sudo shutdown -r now



