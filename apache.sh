#!/bin/bash
# Create blanks Database if doesn't exist in /data
if [ ! -f /data/quicknav.db ]; then cat /tmp/database.txt | sqlite3 /data/quicknav.db; fi

# Apache stuff
exec /usr/sbin/apache2 -D FOREGROUND
