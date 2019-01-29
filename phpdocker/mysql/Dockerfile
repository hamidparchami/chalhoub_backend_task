FROM mysql:5.7
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

ENV MYSQL_ROOT_PASSWORD=123456
ENV MYSQL_DATABASE=chalhoub
ENV MYSQL_USER=chalhoub_user
ENV MYSQL_PASSWORD=123456

COPY phpdocker/mysql/entrypoint.sh /
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]