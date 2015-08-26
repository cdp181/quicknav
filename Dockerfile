FROM phusion/baseimage:0.9.15
MAINTAINER cdp181 <chris@smokingcures.com>
ENV DEBIAN_FRONTEND noninteractive

# Set correct environment variables
ENV HOME /root

# Use baseimage-docker's init system
CMD ["/sbin/my_init"]

RUN apt-get update -q

# Install Dependencies
RUN apt-get install -qy apache2 libapache2-mod-php5 wget php5-sqlite php5-curl etherwake nmap 

# Enable PHP
RUN a2enmod php5

# Add php files and remove default page
RUN rm -f /var/www/html/index.html
ADD index.php /var/www/html/index.php
ADD wol.php /var/www/html/wol.php
ADD style.css /var/www/html/style.css
ADD font-awesome.min.css /var/www/html/font-awesome.min.css

# Update apache configuration with this one
ADD apache-config.conf /etc/apache2/sites-available/000-default.conf
ADD ports.conf /etc/apache2/ports.conf

# Install plexWatchWeb v1.5.4.2
RUN mkdir -p /var/www/html/plexWatch
RUN mkdir -p /var/www/html/font
RUN mkdir -p /var/www/html/images
RUN wget -P /var/www/html/font/ http://www.smokingcures.com/git/font/FontAwesome.otf
RUN wget -P /var/www/html/font/ http://www.smokingcures.com/git/font/fontawesome-webfont.eot
RUN wget -P /var/www/html/font/ http://www.smokingcures.com/git/font/fontawesome-webfont.svg
RUN wget -P /var/www/html/font/ http://www.smokingcures.com/git/font/fontawesome-webfont.ttf
RUN wget -P /var/www/html/font/ http://www.smokingcures.com/git/font/fontawesome-webfont.woff
RUN wget -P /var/www/html/images/ http://www.smokingcures.com/git/images/background.png
RUN wget -P /var/www/html/images/ http://www.smokingcures.com/git/images/glyphicons.png
RUN wget -P /var/www/html/images/ http://www.smokingcures.com/git/images/glyphicons-halflings.png
RUN wget -P /var/www/html/images/ http://www.smokingcures.com/git/images/glyphicons-halflings-white.png
RUN wget -P /var/www/html/images/ http://www.smokingcures.com/git/images/gravatar-default-80x80.png
RUN wget -P /var/www/html/images/ http://www.smokingcures.com/git/images/icon_ipad.png

# Manually set the apache environment variables in order to get apache to work immediately.
RUN echo www-data > /etc/container_environment/APACHE_RUN_USER
RUN echo www-data > /etc/container_environment/APACHE_RUN_GROUP
RUN echo /var/log/apache2 > /etc/container_environment/APACHE_LOG_DIR
RUN echo /var/lock/apache2 > /etc/container_environment/APACHE_LOCK_DIR
RUN echo /var/run/apache2.pid > /etc/container_environment/APACHE_PID_FILE

EXPOSE 21337

# Database directory for config
VOLUME /data

# Add apache to runit
RUN mkdir /etc/service/apache
ADD apache.sh /etc/service/apache/run
RUN chmod +x /etc/service/apache/run
