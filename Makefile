.PHONY: help up down build logs restart clean bitrix-setup bitrix-setup-logs php-bash db-bash

# Переменные
DOCKER_COMPOSE := docker compose
PHP_CONTAINER := php
DB_CONTAINER := mariadbdb

# Помощь
help:
	@echo "Available commands:"
	@echo "  make up              - Start Docker containers"
	@echo "  make down            - Stop Docker containers"
	@echo "  make build           - Build Docker images"
	@echo "  make restart         - Restart Docker containers"
	@echo "  make logs            - Show container logs"
	@echo "  make clean           - Stop containers and remove volumes"
	@echo "  make bitrix-setup    - Run bitrixsetup.php in PHP container"
	@echo "  make bitrix-logs     - Show bitrix-setup logs"
	@echo "  make php-bash        - Open bash in PHP container"
	@echo "  make db-bash         - Open bash in MariaDB container"
	@echo "  make status          - Show status of containers"

# Поднять окружение
up:
	$(DOCKER_COMPOSE) up -d

# Остановить окружение
down:
	$(DOCKER_COMPOSE) down

# Пересобрать образы
build:
	$(DOCKER_COMPOSE) build

# Перестартовать контейнеры
restart: down up

# Показать логи
logs:
	$(DOCKER_COMPOSE) logs -f

# Очистить (остановить и удалить volumes)
clean:
	$(DOCKER_COMPOSE) down -v

# Запустить bitrixsetup.php
bitrix-setup: up
	@echo "Waiting for containers to be ready..."
	@sleep 5
	@echo "Running bitrixsetup.php..."
	$(DOCKER_COMPOSE) exec -T $(PHP_CONTAINER) php /var/www/html/bitrixsetup.php

# Показать логи bitrix-setup
bitrix-logs:
	$(DOCKER_COMPOSE) logs $(PHP_CONTAINER)

# Открыть bash в PHP контейнере
php-bash:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bash

# Открыть bash в БД контейнере
db-bash:
	$(DOCKER_COMPOSE) exec $(DB_CONTAINER) bash

# Статус контейнеров
status:
	$(DOCKER_COMPOSE) ps

# Показать IP контейнеров сети
network-info:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) ip addr show | grep -i eth

# Быстрый запуск: build -> up -> bitrix-setup
all: build up bitrix-setup

.DEFAULT_GOAL := help

