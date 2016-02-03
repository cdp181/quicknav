#!/bin/bash

if [ ! -f /data/quicknav.db ]; then cat /tmp/database.txt | sqlite3 /data/quicknav.db; fi

exec /usr/sbin/apache2 -D FOREGROUND
