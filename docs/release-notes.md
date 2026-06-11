# Release Notes: fullready integration

Дата: 2026-06-11
Ветка: `feature/fullready-integration`

## Что включено

- Новый шаблон сайта: `local/templates/fullready_shop`.
- Главная страница в стиле `fullready` (`fullready_cards` + дополнительные секции).
- Каталог и карточка товара через шаблон `fullready_catalog` (`fullready_filter`, `fullready_cards`, `fullready_element`).
- Корзина/оформление/личный кабинет через `fullready_cart`, `fullready_order`, `fullready_personal`.
- SEO-доработки: `canonical`, `og:type`, `og:title`, микроразметка `Product/Offer`.

## Технические проверки перед релизом

- `docker compose config` — успешно.
- `node --check local/templates/fullready_shop/script.js` — успешно.
- Отчет: `docs/testing-report.md`.

## Рекомендуемая последовательность выката

```bash
git checkout feature/fullready-integration
git pull --ff-only
# далее стандартный процесс деплоя вашего окружения
```

После выката использовать `docs/release-checklist.md`.

