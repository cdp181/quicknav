# quicknav
Docker which provides a configurable page of links with status and Wake-on-LAN capability.

NMAP is used to check port reachability

/data is used to store an sqlite3 database containing the configuration.
/appdata is used to access Sonarr and Radarr DBs in order to edit the TaskScheduler table manually.
Port 21337 is exposed to access the page.
