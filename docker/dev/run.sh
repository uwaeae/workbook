#!/usr/bin/env bash

set -eu
cd /www-root

# Warte, bis Datenbank online
MYSQL_HOST=${MYSQL_HOST:-mysql}
attempt=0
while [ $attempt -lt 120 ]; do
	attempt=$((attempt + 1))
	echo "Waiting for DB to be up (attempt: $attempt/120) ...";
	if mysqladmin ping -h"$MYSQL_HOST" --silent; then
		break
	fi
	sleep 5
done
if [ $attempt -eq 120 ]; then exit 1; fi

# Datenbank-Migrationen, Datei-Berechtigungen
# mkdir -p tmp logs webroot/files
# ./composer.phar install
# php ./bin/cake.php migrations migrate
# chmod -R a+rwX tmp logs
# chmod a+rwX webroot/files || true

exec apache2-foreground
