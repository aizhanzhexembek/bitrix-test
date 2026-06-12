#!/bin/bash
set -e

# Нормализуем права логов: веб и CLI в дев-окружении могут стартовать под разными пользователями.
install -d -m 0775 -o www-data -g www-data /var/www/logs /var/www/logs/logstash /var/log/php
find /var/www/logs/logstash -maxdepth 1 -type f -name '*.log' -exec chown www-data:www-data {} \;
find /var/www/logs/logstash -maxdepth 1 -type f -name '*.log' -exec chmod 0666 {} \;
find /var/log/php -maxdepth 1 -type f -name '*.log' -exec chown www-data:www-data {} \;
find /var/log/php -maxdepth 1 -type f -name '*.log' -exec chmod 0666 {} \;

if [[ "${XDEBUG_PROFILE:-}" != "true" ]]; then
    env -u XDEBUG_PROFILE cron
    exec env -u XDEBUG_PROFILE apache2-foreground
fi

cron

exec apache2-foreground
