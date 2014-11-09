# PressPlay

Composer backed project for easy WordPress sites using the [Simple Framework](http://getsimple.io/). Aimed at making efficient sites, that are as sexy on the outside as they are inside. And hella fast. Hella.

Learn more about Simple and its components or [skip to the good stuff](#installation)

- [getsimple.io](http://getsimple.io)
- [Simple](https://github.com/kiriaze/simple) ( parent framework )
- [Simple Child](https://github.com/kiriaze/simple-child) ( child framework )
- [Simple HTML](https://github.com/kiriaze/simple-html) ( front end )
- [Simple Framework](https://github.com/kiriaze/simple-framework) ( standalone version - non parent/child )
- [VVV Simple](https://github.com/kiriaze/vvv-simple) ( an alternative to PressPlay, if you have vagrant setup, run this instead, a one click solution so to speak )
- [Simple Grid](https://github.com/kiriaze/Simple-Grid) ( and stupid simple grid thats semantic, extendable, and actually makes sense )
- [Simple Anchors](https://github.com/kiriaze/SimpleAnchors) ( a data attr scrolling plugin with some awesomeness baked in )
- [Animate Scss](https://github.com/kiriaze/animate.scss) ( fork of Dan Edens Animate.css )

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
You have a similar setup to the link above. OSX. Codekit. SequelPro.

Currently depends on Codekit for theme dev right out the box, cuz it just works like butter. Its possible to work with guard if you dont wanna deal with having a carefree life, but gets messy if both are used in a team environment. Guard shits on grunt, gulps alright too - but codekit takes the gold.

And if you're using a wysiwyg editor or mamp or a bloated ide like coda, **go back to school**.

---

## [Installation](id:installation)

    $ git clone https://raw.github.com/kiriaze/PressPlay PROJECTNAME
    $ cd PROJECTNAME
    $ composer install

1. add your project to your hosts file
    * `subl /etc/hosts` - subl to open in sublime.
    * add `127.0.0.1 {PROJECTNAME}.dev`
2. add to your vhosts file
    1. `subl /etc/apache2/extra/httpd-vhosts.conf`
    2. 
    ```
    <VirtualHost *:80>
        DocumentRoot "path/to/your/project"
        ServerName {PROJECTNAME}.dev
    </VirtualHost>
    ```
3. set permissions
    * `sudo chown -R _www DIR`
    * `sudo chmod -R g+w DIR`
5. restart apache
    * `sudo apachectl restart`
6. create your database.
7. update wp-config.php to connect to your db.
8. comment out wp files in git ignore.
9. rm -rf .git from root of project.
10. rm -rf .git from simple-child and/or simple-framework
11. rename these files:
    * simple-framework and/or simple-child to project name
    * style.css names
    * app.js THEMENAME/SHORTNAME refs
12. add youre new remote.
13. drag project theme to into codekit. ( comes with codekit.conf )
14. make dope shit.

---

## Consists of
1. the latest wordpress
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
