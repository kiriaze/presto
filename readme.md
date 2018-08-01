[PressPlay Readme](https://gist.github.com/kiriaze/9fc0d101651326dac67c)

## Installation
	1. `composer install`
	2. `php -S localhost:8000 -t app/`

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