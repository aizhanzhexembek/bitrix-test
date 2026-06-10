# Аудит верстки `fullready`

Источник: `docs/fullready-src`

## Структура

- Главный файл: `docs/fullready-src/index.html`
- Компонентные заготовки:
  - `docs/fullready-src/components/header.html`
  - `docs/fullready-src/components/section.html`
  - `docs/fullready-src/components/footer.html`
- Доп. страница: `docs/fullready-src/pages/index.html`

## Статика

- Стили:
  - `docs/fullready-src/css/style.min.css`
  - `docs/fullready-src/libs/selectric/selectric.css`
- Скрипты:
  - `docs/fullready-src/js/jquery.min.js`
  - `docs/fullready-src/js/jquery.selectric.min.js`
  - `docs/fullready-src/js/main.min.js`
- Медиа:
  - `docs/fullready-src/images/*`
  - `docs/fullready-src/fonts/*`

## UI-блоки

- Глобальная шапка: логотип, телефон, поиск, ссылка "Доставка и оплата"
- Главное меню категорий
- Блок корзины в хедере
- Каталоговый листинг в стиле "фототехника"
- Фильтр (desktop + popup на mobile)
- Большая карточка + сетка малых карточек товара

## Зависимости и ограничения

- jQuery + Selectric (кастомные select)
- JS в `main.min.js` ожидает конкретные классы/ID из HTML
- Верстка статическая: без реальной фильтрации и без динамики корзины/каталога
- Контент в демо захардкожен, требуется подмена на данные компонентов Битрикс

## Вывод для интеграции

1. Каркас `header/footer` можно перенести в шаблон сайта.
2. Список карточек натягивается через шаблон `bitrix:catalog.section`.
3. Фильтр переносится в шаблон `bitrix:catalog.smart.filter`.
4. Поиск и корзину нужно связать со стандартными компонентами Битрикс.

