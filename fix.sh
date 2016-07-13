#!/bin/bash
# Copyright (c) 2016 Jacob Martin
# Fixes the permissions of the application for secure serving.
# Note that "www-data" is used here; feel free to change this for your own
# web server's username.

function allowWrite() {
	cd $1
	find . -type f -exec chmod 664 {} +
	find . -type d -exec chmod 775 {} +
	chown $USER:www-data -R .
	cd ~-
}

find . -type f -exec chmod 644 {} +
find . -type d -exec chmod 755 {} +
chown $USER:$USER -R .

allowWrite "storage"
allowWrite "bootstrap/cache"

chmod +x fix.sh
chmod +x artisan
