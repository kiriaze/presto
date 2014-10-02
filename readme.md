# PressPlay

Composer backed boilerplate project for easy WordPress sites

## Requirements
- [Composer](getcomposer.org/)

## Installation

````bash
$ git clone https://raw.github.com/kiriaze/PressPlay
$ cd PressPlay
$ composer install
````

update wp-config.php
comment out wp files in git ignore
rm -rf .git
add youre new remote and push on!


## Credits

Constantine Kiriaze
[http://www.kiriaze.com](http://www.kiriaze.com)
[@kiriaze](https://twitter.com/kiriaze)


Consists of
    the latest wordpress,
    composer
        plugins
        simple framework
        simple parent framework
        simple child theme
    .htaccess
        for permalinks and media redirection to remote - saves space

project repo should also house a db dump

Installation

Clone the git repo
    git clone https://github.com/kiriaze/PressPlay

run composer

rm -rf .git from root project
rm -rf .git from simple-framework ( or add another remote to your project repo, in order to pull future changes? )

git init, git remote add
    root project to project repo ( houses cleaned up repo, which others would simply have to rerun composer after pulling )
    project theme to theme repo

rename
    simple-framework to project name
    style.css names

create db

update wp-config creds

sudo chown -R _www DIR; sudo chmod -R g+w DIR;

restart apache

drag project theme to into codekit

update .gitignore
    remove wp-content
    add plugins, upgrade, vendor, plugins

make dope shit.


Search and replace for simple within the theme and replace it with your new theme name.


attempting one liner

curl -O http://wordpress.org/latest.tar.gz ; tar -xvzf latest.tar.gz ; mv wordpress/* . ; rmdir wordpress/ ; rm latest.tar.gz ; rmdir wordpress/ ; rm latest.tar.gz ; cp wp-config-sample.php wp-config.php ; mysql -u [username] -p[password] -e "create database [databasename];" ; nano wp-config.php; sudo apachectl graceful;