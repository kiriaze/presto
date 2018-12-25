## Preface
Presto is a local wordpress environment, run natively on osx. Runs off sqlite db for quick and easy development.

## Installation
1. Clone repo recursively to include the submodule theme wordpress-starter. `git clone --recursive git@github.com:kiriaze/presto.git`
2. Either copy or rename .env.example and update variables.
3. Run `sh setup.sh`, which will open up a browser window to your app.
	- Remove the .git file from app/content/themes/wordpress-starter, and rename the theme.
4. Run `npm setup` within the wordpress-starter theme to get started.

### Notes
- Look at `composer.json` before running `sh setup.sh` incase you'd rather not install the plugins I've recommended. This has only been tested on a mac environment.

- Take a look [here](https://gist.github.com/kiriaze/9fc0d101651326dac67c) for more information regarding other optional configurations or setup, if you'd rather use the built in osx php/apache/hosts etc.

- By running the install script, sqlite is used and referenced for local development, however this isn't recommended for production environments, rather reference this [link](https://gist.github.com/kiriaze/9fc0d101651326dac67c) for a more production ready environment. 

###### In regards to deployment
For use with ServerPilot, you must clone the repo to the root of the app rather than within `public`, then delete public dir and symlink it to app. `ln -s app public`

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