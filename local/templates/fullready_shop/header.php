<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

$asset = Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . '/assets/css/style.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/assets/libs/selectric/selectric.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/styles.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/template_styles.css');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/jquery.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/jquery.selectric.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/main.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/script.js');

$curPage = $APPLICATION->GetCurPage(true);
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$isHttps = $request->isHttps() || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
$scheme = $isHttps ? 'https' : 'http';
$canonical = $scheme . '://' . $request->getHttpHost() . $APPLICATION->GetCurPage(false);
$searchQuery = trim((string)$request->getQuery('q'));
?>
<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <meta charset="<?= LANG_CHARSET ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php $APPLICATION->ShowTitle(false); ?>">
    <link rel="canonical" href="<?= htmlspecialcharsbx($canonical) ?>">
    <?php $APPLICATION->ShowHead(); ?>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>
<div class="fullready-layout">
    <div class="filterPopup" id="filterPopup">
        <div class="filterPopup__inner">
            <button class="filterPopup__button" onclick="CloseFilterPopup()" id="filterPopup__button" type="button"></button>
            <form class="cameras__filtres" action="#" id="filterPopup__form">
                <label for="Popup__cameras-logo">
                    <select class="cameras__logo" name="cameras_logo" id="Popup__cameras-logo">
                        <option value="logo_item1">Любого логотипа</option>
                        <option value="logo_item2">Компакт-камера</option>
                        <option value="logo_item3">Беззеркальная</option>
                        <option value="logo_item4">Зеркальная</option>
                        <option value="logo_item5">Среднеформатная</option>
                    </select>
                </label>
                <label for="Popup__cameras-brand">
                    <select class="cameras__brand" name="cameras_brand" id="Popup__cameras-brand">
                        <option value="brand_item1">Любого бренда</option>
                        <option value="brand_item2">Canon</option>
                        <option value="brand_item3">Nikon</option>
                        <option value="brand_item4">Sony</option>
                        <option value="brand_item5">Fujifilm</option>
                        <option value="brand_item6">Samsung</option>
                        <option value="brand_item7">Olympus</option>
                    </select>
                </label>
                <div class="cameras__price">
                    <div class="cameras__price-container">
                        <label class="cameras__price-limit-start" for="Popup__start-price">от</label>
                        <input class="cameras__price-start" type="text" id="Popup__start-price" name="start_price">
                    </div>
                    <div class="cameras__price-container">
                        <label class="cameras__price-limit-end" for="Popup__end-price">до</label>
                        <input class="cameras__price-end" type="text" id="Popup__end-price" name="end_price">
                    </div>
                    <button class="filterPopup__inner-button" type="submit" disabled>ПРИМЕНИТЬ</button>
                </div>
            </form>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__contacts">
                    <div class="logo">
                        <a href="<?= SITE_DIR ?>" class="logo_link">
                            <?php
                            $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '',
                                [
                                    'AREA_FILE_SHOW' => 'file',
                                    'PATH' => SITE_DIR . 'include/company_logo.php',
                                ],
                                false
                            );
                            ?>
                        </a>
                    </div>
                    <div class="tel">
                        <?php
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.include',
                            '',
                            [
                                'AREA_FILE_SHOW' => 'file',
                                'PATH' => SITE_DIR . 'include/telephone.php',
                            ],
                            false
                        );
                        ?>
                    </div>
                    <div class="search__inner">
                        <form class="search__form" id="search__form" method="get" action="<?= SITE_DIR ?>search/">
                            <button class="search__form-button" type="submit" onclick="return SearchButtonClick()"></button>
                            <label for="search">
                                <input class="search__form-input" type="text" placeholder="Поиск товаров" id="search" name="q" value="<?= htmlspecialcharsbx($searchQuery) ?>">
                            </label>
                        </form>
                    </div>
                </div>
                <div class="payment">
                    <a href="<?= SITE_DIR ?>about/delivery/" class="payment__link">Доставка и оплата</a>
                </div>
            </div>
            <div class="header__menu">
                <div id="shopmenu">
                    <input id="goods-menu-toggle" type="checkbox">
                    <label class="menu-button-container" for="goods-menu-toggle"></label>
                    <div id="goodsmenu">
                        <?php
                        $APPLICATION->IncludeComponent(
                            'bitrix:menu',
                            'fullready_header',
                            [
                                'ROOT_MENU_TYPE' => 'left',
                                'MAX_LEVEL' => '1',
                                'CHILD_MENU_TYPE' => 'left',
                                'USE_EXT' => 'Y',
                                'MENU_CACHE_TYPE' => 'A',
                                'MENU_CACHE_TIME' => '36000000',
                                'MENU_CACHE_USE_GROUPS' => 'Y',
                                'MENU_CACHE_GET_VARS' => [],
                                'ALLOW_MULTI_SELECT' => 'N',
                            ],
                            false
                        );
                        ?>
                    </div>
                </div>
                <div class="header__menu-logo logo">
                    <a href="<?= SITE_DIR ?>" class="logo_link">
                        <?php
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.include',
                            '',
                            [
                                'AREA_FILE_SHOW' => 'file',
                                'PATH' => SITE_DIR . 'include/company_logo_mobile.php',
                            ],
                            false
                        );
                        ?>
                    </a>
                </div>
                <div class="search__inner menu-search">
                    <form class="menu-search__form" id="menu-search__form" method="get" action="<?= SITE_DIR ?>search/">
                        <button class="menu-search__button" onclick="return SearchButtonClick()" type="submit" id="menu-search__button"></button>
                        <label for="menu-search__input">
                            <input class="menu-search__input" type="text" placeholder="Поиск товаров" name="q" id="menu-search__input" value="<?= htmlspecialcharsbx($searchQuery) ?>">
                        </label>
                    </form>
                </div>
                <div class="basket">
                    <?php
                    $APPLICATION->IncludeComponent(
                        'bitrix:sale.basket.basket.line',
                        'fullready_header',
                        [
                            'PATH_TO_BASKET' => SITE_DIR . 'personal/cart/',
                            'PATH_TO_PERSONAL' => SITE_DIR . 'personal/',
                            'SHOW_PERSONAL_LINK' => 'N',
                            'SHOW_NUM_PRODUCTS' => 'Y',
                            'SHOW_TOTAL_PRICE' => 'Y',
                            'SHOW_PRODUCTS' => 'N',
                            'POSITION_FIXED' => 'N',
                            'SHOW_AUTHOR' => 'Y',
                        ],
                        false
                    );
                    ?>
                </div>
            </div>
        </div>
    </header>
    <main class="main-content">
        <div class="container">
            <?php if ($curPage !== SITE_DIR . 'index.php'): ?>
                <?php
                $APPLICATION->IncludeComponent(
                    'bitrix:breadcrumb',
                    'universal',
                    [
                        'START_FROM' => '0',
                        'PATH' => '',
                        'SITE_ID' => '-',
                    ],
                    false,
                    ['HIDE_ICONS' => 'Y']
                );
                ?>
                <h1 id="pagetitle"><?php $APPLICATION->ShowTitle(false); ?></h1>
                <?php include __DIR__ . '/includes/content-links.php'; ?>
            <?php endif; ?>
