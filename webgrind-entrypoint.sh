#!/bin/sh

# Меняем формат ссылок на PhpStorm
sed -i "s|static \$fileUrlFormat = .*|static \$fileUrlFormat = 'jetbrains://php-storm/navigate/reference?project=orteka\&path=%1\\\$s:%2\\\$d';|" /var/www/html/config.php

# Патчим шаблон: декодируем URL и убираем /var/www/ чтобы путь стал относительным от корня проекта
sed -i "s|sprintf(fileUrlFormat,data.file,data.line)|sprintf(fileUrlFormat,decodeURIComponent(data.file).replace('/var/www/',''),data.line)|g" /var/www/html/templates/index.phtml
sed -i "s|sprintf(fileUrlFormat, data.file, data.line)|sprintf(fileUrlFormat, decodeURIComponent(data.file).replace('/var/www/',''), data.line)|g" /var/www/html/templates/index.phtml
sed -i "s|sprintf(fileUrlFormat, data.file, -1)|sprintf(fileUrlFormat, decodeURIComponent(data.file).replace('/var/www/',''), -1)|g" /var/www/html/templates/index.phtml

exec apache2-foreground
