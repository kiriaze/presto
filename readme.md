# PressPlay

Composer backed project for easy WordPress sites using the Simple Framework. [Get Simple](getsimple.io/)

## Requirements
- [Composer](getcomposer.org/)
- [Git] (brew this shit -> https://github.com/kiriaze/mac-dev-env)
- [Skills] ( ooo baby )

## Installation

````bash
$ git clone https://raw.github.com/kiriaze/PressPlay PROJECTNAME
$ cd PROJECTNAME
$ composer install
````

create db
update wp-config.php
comment out wp files in git ignore
rm -rf .git from root
rm -rf .git from simple-child/simple-framework
rename
    simple-framework to project name
    style.css names
add youre new remote and push on!


sudo chown -R _www DIR;
sudo chmod -R g+w DIR;

restart apache

drag project theme to into codekit

make dope shit.


## Credits

Constantine Kiriaze
[http://www.kiriaze.com](http://www.kiriaze.com)
[@kiriaze](https://twitter.com/kiriaze)


## Consists of
    the latest wordpress,
    composer
        plugins
        simple framework
        simple parent framework
        simple child theme
    .htaccess
        for permalinks and media redirection to remote - saves space
    project repo should also house a db dump

## To Do:

attempting one liner for future ref in conjunction with init.sh

curl -O http://wordpress.org/latest.tar.gz ; tar -xvzf latest.tar.gz ; mv wordpress/* . ; rmdir wordpress/ ; rm latest.tar.gz ; rmdir wordpress/ ; rm latest.tar.gz ; cp wp-config-sample.php wp-config.php ; mysql -u [username] -p[password] -e "create database [databasename];" ; nano wp-config.php; sudo apachectl graceful;