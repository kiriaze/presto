PressPlay

Consists of
    the latest wordpress,
    composer
        plugins
        simpleframework
    and boxfile setup for pagodabox.

Installation

Clone the git repo
    git clone https://github.com/kiriaze/PressPlay

run composer

create db

sudo chown -R _www DIR; sudo chmod -R g+w DIR;

update wp-config creds

restart apache

make dope shit.


Search and replace for simple within the child theme and replace it with your new theme name.

cd into theme, run bundle, then run guard -i.



curl -O http://wordpress.org/latest.tar.gz ; tar -xvzf latest.tar.gz ; mv wordpress/* . ; rmdir wordpress/ ; rm latest.tar.gz ; rmdir wordpress/ ; rm latest.tar.gz ; cp wp-config-sample.php wp-config.php ; mysql -u [username] -p[password] -e "create database [databasename];" ; nano wp-config.php; sudo apachectl graceful;