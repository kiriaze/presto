# Init script for PressPlay

echo "Commencing Wordpress Site Setup"

# Make a database, if we don't already have one
echo "Creating database (if it's not already there)"
mysql -u root --password=root -e "CREATE DATABASE IF NOT EXISTS db_name"
mysql -u root --password=root -e "GRANT ALL PRIVILEGES ON db_name.* TO wp@localhost IDENTIFIED BY 'wp';"

# Run Composer
composer install --prefer-dist

# Download WordPress
if [ ! -f wp/wp-config.php ]
then
	echo "Creating wp-config.php and installing WordPress"
	wp core config --dbname="db_name" --dbuser=wp --dbpass=wp --dbhost="localhost"
	wp core install --url=vvv-simple.dev --title="PressPlay" --admin_user=admin --admin_password=password --admin_email=demo@example.com
fi

# The Vagrant site setup script will restart Nginx for us

echo "Wordpress site now installed";