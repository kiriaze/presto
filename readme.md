# PressPlay

Composer backed project for easy WordPress sites using the [Simple Framework](http://getsimple.io/). Aimed at making efficient sites, that are as sexy on the outside as they are inside. And hella fast. Hella.

Learn more about Simple and its components or [skip to the good stuff](#installation)

- [getsimple.io](http://getsimple.io)
- [Simple](https://github.com/kiriaze/simple)
- [Simple Child](https://github.com/kiriaze/simple-child)
- [Simple HTML](https://github.com/kiriaze/simple-html)
- [Simple Framework](https://github.com/kiriaze/simple-framework)
- [VVV Simple](https://github.com/kiriaze/vvv-simple)
- [Simple Grid](https://github.com/kiriaze/Simple-Grid)
- [Simple Anchors](https://github.com/kiriaze/SimpleAnchors)
- [Animate Scss](https://github.com/kiriaze/animate.scss)

---

## Requirements
- [Composer](http://getcomposer.org/)
- [Git/Brews](http://brew.sh/)
- [Skills](http://bringvictory.com/)
- Open Mind. It's hella opinionated, cuz its awesome. Get with it already.

---

## Optional
Want your mac to dev fly shit all day? [check it homie.](https://github.com/kiriaze/mac-dev-env)

---

## Assumptions
You have a similar setup to the link above. OSX. Codekit.

Currently depends on Codekit for theme dev right out the box, cuz it just works like butter. Its possible to work with guard if you dont wanna deal with having a carefree life, but gets messy if both are used in a team environment. Guard shits on grunt, gulps alright too - but codekit takes the gold.

And if you're using a wysiwyg editor or mamp or a bloated ide like coda, **go back to school**.

---

## [Installation](id:installation)

    $ git clone https://raw.github.com/kiriaze/PressPlay PROJECTNAME
    $ cd PROJECTNAME
    $ composer install

1. add your project.dev to your hosts file
2. add your dir to httpd-vhosts file
3. sudo chown -R _www DIR;
4. sudo chmod -R g+w DIR;
5. restart apache
6. create db
7. update wp-config.php
8. comment out wp files in git ignore
9. rm -rf .git from root
10. rm -rf .git from simple-child/simple-framework
11. rename
    * simple-framework/simple-child to project name
    * style.css names
    * app.js THEMENAME/SHORTNAME refs
12. add youre new remote
13. drag project theme to into codekit
14. make dope shit.

---

## Consists of
1. the latest wordpress,
2. composer
    * plugins
        1. simple framework
        2. simple parent framework
        3. simple child theme
    * .htaccess
        1. permalinks
        2. media redirection to remote
    * project repo should also house a db dump

---

## To Do:

1. attempting one liner for future ref in conjunction with init.sh
2.
curl -O http://wordpress.org/latest.tar.gz ; tar -xvzf latest.tar.gz ; mv wordpress/* . ; rmdir wordpress/ ; rm latest.tar.gz ; rmdir wordpress/ ; rm latest.tar.gz ; cp wp-config-sample.php wp-config.php ; mysql -u [username] -p[password] -e "create database [databasename];" ; nano wp-config.php; sudo apachectl graceful;

---

## Credits

Constantine Kiriaze
[http://www.kiriaze.com](http://www.kiriaze.com)
[@kiriaze](https://twitter.com/kiriaze)