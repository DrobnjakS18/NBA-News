1)Instaliramo virtualbox
https://www.virtualbox.org/wiki/Downloads

2)Instaliramo VirtualBox Extension Pack
https://www.virtualbox.org/wiki/Downloads

3)Instaliramo Vagrant
https://www.vagrantup.com/downloads.html

4)Open Command promnt or Terminal and navigate it to your project root where Vagrant file  is.
Pokrenemo sledecu komandu:
vagrant up

5)Logovanje je omoguceno preko sifre:
vagrant:vagrant
ili 
vagrant ssh

6) Instaliramo vendore 
cd /var/www/project/
composer install


7)Set database
CREATE DATABASE nba_news DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

8)podesiti .env fajl po ugledu na .env.example fajl.

9)app key uneti uz pomoc komande: 
php artisan key:generate

10(kada se sredio .env fajl onda pokrenuti sledece(tu ce biti uradjena migracija sa seedovima):
php artisan migrate --seed

11)














*****************************
**INFO
*****************************
1)Za instalaciju servera je pracen sledeci link:
https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04

2) Sve sto je public ide u folder public koji se direktno nalazi u rootu projekta

3)Swap memory
https://www.digitalocean.com/community/tutorials/how-to-add-swap-space-on-ubuntu-18-04
koristi brzi nacin...

4)Prvo pogledaj da li je dobro sredjeno sto se tice usera. 
If you have blank white screen try to change permission on to storage folder with following command line
chmod -R o+w storage/ bootstrap/cache
