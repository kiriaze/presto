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

## Optional ( But highly encouraged.. )
Want your mac to dev fly shit all day? [check it homie.](https://github.com/kiriaze/mac-dev-env)

---

## Assumptions
You have a similar setup to the link above. OSX. Codekit. SequelPro.

Currently depends on Codekit for theme dev right out the box, cuz it just works like butter. Its possible to work with guard if you dont wanna deal with having a carefree life, but gets messy if both are used in a team environment. Guard shits on grunt, gulps alright too - but codekit takes the gold.

And if you're using a wysiwyg editor or mamp or a bloated ide like coda, **_go back to school, kid._**

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

## [Installation](id:installation)

1. Clone repo and run composer.
	```
    $ git clone https://raw.github.com/kiriaze/PressPlay {Project-Name}
    $ cd {Project-Name}
    $ composer install
    ```

1. Run [ghost](https://github.com/kiriaze/ghost). ( Follow instructions through cli )
    ```
    curl -s https://raw.githubusercontent.com/kiriaze/ghost/master/ghost.sh > /tmp; bash /tmp/ghost
	```

2. Create your database. ( Will move this into ghost.sh soon )
  ```
  mysql -u {username} -p {password} -e "create database {databasename};"
  ```

3. Update wp-config.php credentials to connect to your db.

4. Update git remote in root of project and subsequent files.
  ```
  # Remove git from root of your project
  $ rm -rf {Project-Name}/.git
  # Add your new remote to the root of your project
  $ git remote add origin https://path-to-repo.com/repo.git
  # Remove git from project theme
  $ rm -rf {Project-Name}/wp-content/themes/{project-theme}/.git
  ```

5. Update Naming Conventions
    * Simple-child to {Project-Name} ( Or Simple-Framwork depending on which you choose to use )
    * Update style.css name refs accordingly.
    	```
        /*
        Theme Name:  	Simple Child
        Theme URI:  	http://simple-child.com
        Author:  		Constantine Kiriaze
        Author URI:  	http://kiriaze.com
        Description:  	Developed on Wordpress.
        Template:       simple
        Version:  		1.0.0
        License: 		GNU General Public License v2 or later
        License URI: 	http://www.gnu.org/licenses/gpl-2.0.html
        Text Domain: 	simple
        */
        ```
    * Update app.js THEMENAME/SHORTNAME refs
	    ```
        // THEMENAME is the full name of your project, e.g. MyAwesomeProject
        // SHORTNAME is the acronym of the THEMENAME, e.g. MAP
        var SHORTNAME = window.THEMENAME;
        ```

7. Drag your project _**Theme**_ into codekit. ( comes with preconfigured codekit.conf )

8. Set permissions to project directory ( WP specific )
  ```
  $ sudo chown -R _www {Project-Name}
  $ sudo chmod -R g+w {Project-Name}
  ```

9. Direct browser to {Project-Name}.dev/wp/wp-admin
10. Activate Project Theme.
11. Update Site URL in WP Admin. ( And other settings through theme options )
12. Make dope shit yo.


13. DB search/replace mysql query FTW
    ```
    update wp_posts set guid = replace(guid, "OLD", "NEW");
    update wp_options set option_value = replace(option_value, "OLD", "NEW");
    update wp_posts set post_content = replace(post_content, "OLD", "NEW");
    update wp_postmeta set meta_value = replace(meta_value, "OLD", "NEW");
    ```

#### Notes:
* When updating gitignore, run `$ git rm -r --cached .` then re add/commit
* Add acf-pro license into wp admin.
* If you add other plugins to your project, you have two options to keep them in sync.
	* Exclude from .gitignore with `!wp-content/plugins/{plugin-name}`
	* Add plugin to composer.json and run `composer update`

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
