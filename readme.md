## Preface
Look at `composer.json` before running `composer install` incase you'd rather not install the plugins I've recommended. This has only been tested on a mac environment.

Take a look [here](https://gist.github.com/kiriaze/9fc0d101651326dac67c) for more information regarding other optional configurations or setup, if you'd rather use the built in osx php/apache/hosts etc.

By running the install script, sqlite is used and referenced for local development, however this isn't recommended for production environments, rather reference this [link](https://gist.github.com/kiriaze/9fc0d101651326dac67c) for a more production ready environment. 

## Installation
1. `composer install`
2. Either copy or rename .env.example and update variables.
3. `php -S localhost:8000 -t app/`

### Other recommended plugins not included within the barebones composer.json

```
"require" : {
	"wpackagist-plugin/demo-data-creator"                   : "*",
	"wpackagist-plugin/bulk-content-creator"                : "*",
	"wpackagist-plugin/duplicate-post"                      : "*",
	"wpackagist-plugin/wordpress-importer"                  : "*",
	"wpackagist-plugin/intuitive-custom-post-order"         : "*",
	"wpackagist-plugin/author-recommended-posts"            : "*",
	"wpackagist-plugin/goodbye-captcha"                     : "*",

	"wpackagist-plugin/relevanssi"                          : "*",
	"wpackagist-plugin/wp-crontrol"                         : "*",

	"wpackagist-plugin/bulletproof-security"                : "*",
	"wpackagist-plugin/all-in-one-wp-security-and-firewall" : "*",
	"wpackagist-plugin/sucuri-scanner"                      : "*",

	"wpackagist-plugin/cloudflare-flexible-ssl"             : "*",
	"wpackagist-plugin/analytics-for-cloudflare"            : "*",

	"wpackagist-plugin/restricted-site-access"              : "*",
},

"require-dev" : {
	"wpackagist-plugin/monster-widget"                      : "*",
	"wpackagist-plugin/user-switching"                      : "*",
	"wpackagist-plugin/username-changer"                    : "*",
	"wpackagist-plugin/rewrite-rules-inspector"             : "*",
	"wpackagist-plugin/safe-redirect-manager"               : "*",
	"wpackagist-plugin/wordpress-reset"                     : "*",
}
```