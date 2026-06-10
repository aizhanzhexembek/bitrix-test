# Карта соответствий: `fullready` -> Битрикс

## Глобальный шаблон сайта

- `fullready` header -> `local/templates/fullready_shop/header.php`
- `fullready` footer -> `local/templates/fullready_shop/footer.php`
- CSS/JS/assets -> `local/templates/fullready_shop/assets/*`

## Области и компоненты

- Логотип -> include-область `include/company_logo.php` / `include/company_logo_mobile.php`
- Телефон -> include-область `include/telephone.php`
- Верхнее меню категорий -> `bitrix:menu` (тип `left`)
- Поиск -> `bitrix:search.title`
- Мини-корзина -> `bitrix:sale.basket.basket.line`

## Каталог

- Сетка товаров -> `bitrix:catalog.section` (кастомный шаблон `fullready_grid`)
- Фильтр -> `bitrix:catalog.smart.filter` (кастомный шаблон `fullready_filter`)
- Карточка товара -> `bitrix:catalog.element` (кастомный шаблон, следующая итерация)

## Корзина и заказ

- Корзина -> `bitrix:sale.basket.basket`
- Оформление заказа -> `bitrix:sale.order.ajax`
- ЛК/авторизация -> стандартные компоненты (`system.auth.*`, `main.profile`)

## Примечания

- Базовый шаблон `bitrix/templates/eshop_bootstrap_v4` не изменяется.
- Интеграция ведется в новом шаблоне `local/templates/fullready_shop`.
- Сначала закрывается каркас + главная + каталог, затем корзина/checkout.

