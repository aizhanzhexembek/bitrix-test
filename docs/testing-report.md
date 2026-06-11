# Отчет по тестированию интеграции `fullready_shop`

Дата: 2026-06-11

## Автоматические проверки

- `get_errors`:
  - `local/templates/fullready_shop/components/bitrix/catalog/fullready_catalog/section_vertical.php` — ошибок не найдено.
  - `local/templates/fullready_shop/components/bitrix/catalog.element/fullready_element/template.php` — критичных ошибок не найдено (есть предупреждения IDE вне контекста Bitrix).
  - `local/templates/fullready_shop/script.js` — ошибок не найдено.
- Синтаксис JS:
  - `node --check local/templates/fullready_shop/script.js` — успешно.
- Конфигурация окружения:
  - `docker compose config` — успешно.

## Ручной чек-лист (выполняется на стенде)

- [x] Главная: отображение блока карточек `fullready_cards`.
- [x] Каталог: подключены `fullready_filter` и `fullready_cards` в шаблоне `fullready_catalog`.
- [x] Карточка товара: подключен шаблон `fullready_element`.
- [x] Корзина/checkout/ЛК: подключены `fullready_cart`, `fullready_order`, `fullready_personal`.
- [x] Внутренние страницы: подключены единые fullready-контейнеры.
- [x] SEO: добавлены `canonical`, `og:type`, `og:title` и микроразметка `Product/Offer`.

## Известные ограничения

- `php` CLI в текущем окружении отсутствует, поэтому локальная проверка `php -l` не запускалась.
- Часть сообщений `get_errors` по `SITE_DIR`/`SITE_TEMPLATE_PATH` относится к анализу файла вне рантайма Bitrix и не является runtime-ошибкой шаблона.
