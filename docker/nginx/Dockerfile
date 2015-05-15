# Container for Nginx
#
# Version   0.0.1

FROM        debian:wheezy
MAINTAINER  Mario Rezende <mariorez@gmail.com>

# Needed for edit files inside container and
# to suppress messages like "debconf: unable to initialize frontend: Dialog"
ENV TERM linux

# Let the conatiner know that there is no tty
ENV DEBIAN_FRONTEND noninteractive

WORKDIR /root

# Create user "docker" with same host user UID to avoid permissions issues for "data volume"
RUN echo "alias ll='ls -lha --color=auto --group-directories-first'" >> .bashrc \
    && echo "alias l='ls -lh --color=auto --group-directories-first'" >> .bashrc \
    && useradd -u 1000 docker \
    && mkdir -p /home/docker \
    && cp .bashrc /home/docker/.bash_profile \
    && chown -R docker:docker /home/docker \
    && chsh -s /bin/bash docker

WORKDIR /etc/apt

RUN echo "deb http://ftp.br.debian.org/debian wheezy main" > sources.list \
    && echo "deb http://ftp.br.debian.org/debian wheezy-updates main" >> sources.list \
    && echo "deb http://security.debian.org wheezy/updates main" >> sources.list \
    && apt-get update && apt-get install -y \
    nginx \
    nano \
    mlocate \
    net-tools \
    wget \
    curl \
    procps

WORKDIR /etc/nginx

# Change Nginx default user (www-data) to docker
RUN sed -i "s/www-data/docker/" nginx.conf \
    && echo "daemon off;" >> nginx.conf \
    && rm sites-enabled/default

COPY ./sinc.conf /etc/nginx/sites-available/

RUN ln -nfs /etc/nginx/sites-available/sinc.conf /etc/nginx/sites-enabled/sinc.conf

EXPOSE 80

ENTRYPOINT ["nginx"]
