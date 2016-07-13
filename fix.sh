#!/bin/bash
# Copyright (c) 2016 Jacob Martin
# MIT license

# Fixes the permissions of the application for secure serving.
# Note that "www-data" is used here; feel free to change this for your own
# web server's username.

# If you don't have permissions to modify files and folders in the first place,
# this script will not work for you until you fix that with:
# sudo chown $USER -R .

function allowWrite() {
	find $1 -type f -exec chmod 664 {} +
	find $1 -type d -exec chmod 775 {} +
	chown $USER:www-data -R $1
}

find . -type f -exec chmod 644 {} +
find . -type d -exec chmod 755 {} +
chown $USER:$USER -R .

allowWrite "storage"
allowWrite "bootstrap/cache"

chmod +x fix.sh
chmod +x artisan
