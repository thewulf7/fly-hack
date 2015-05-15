# Container for HHVM
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
    && mkdir -p /var/www \
    && cp .bashrc /home/docker/.bash_profile \
    && chown -R docker:docker /home/docker \
    && chown -R docker:docker /var/www \
    && chsh -s /bin/bash docker

WORKDIR /etc/apt

RUN echo "deb http://ftp.br.debian.org/debian wheezy main" > sources.list \
    && echo "deb http://ftp.br.debian.org/debian wheezy-updates main" >> sources.list \
    && echo "deb http://security.debian.org wheezy/updates main" >> sources.list \
    && echo "deb http://dl.hhvm.com/debian wheezy main" > sources.list.d/hhvm.list \
    && apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449 \
    && apt-get update && apt-get install -y \
    hhvm \
    nano \
    mlocate \
    net-tools \
    wget \
    curl \
    procps

WORKDIR /etc/hhvm

RUN echo "hhvm.enable_xhp = true" >> php.ini \
    && echo " " >> php.ini \
    && echo "; custom options" >> php.ini \
    && echo "date.timezone = America/Sao_Paulo" >> php.ini \
    && echo "hhvm.enable_xhp = true" >> server.ini \
    && echo " " >> server.ini \
    && echo "; custom options" >> server.ini \
    && echo "date.timezone = America/Sao_Paulo" >> server.ini

WORKDIR /var/www

VOLUME /var/www

EXPOSE 9000

ENTRYPOINT ["hhvm", "--mode", "server", "-vServer.Type=fastcgi", "-vServer.Port=9000"]
