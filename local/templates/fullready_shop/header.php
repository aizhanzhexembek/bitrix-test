<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

$asset = Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . '/styles.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/template_styles.css');
$asset->addJs(SITE_TEMPLATE_PATH . '/script.js');
?>
<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <meta charset="<?= LANG_CHARSET ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <?php $APPLICATION->ShowHead(); ?>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>
<div class="fullready-layout">
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
                    <div class="search__inner" id="search">
                        <?php
                        $APPLICATION->IncludeComponent(
                            'bitrix:search.title',
                            'bootstrap_v4',
                            [
                                'NUM_CATEGORIES' => '1',
                                'TOP_COUNT' => '5',
                                'CHECK_DATES' => 'N',
                                'SHOW_OTHERS' => 'N',
                                'PAGE' => SITE_DIR . 'catalog/',
                                'CATEGORY_0_TITLE' => 'Товары',
                                'CATEGORY_0' => ['iblock_catalog'],
                                'CATEGORY_0_iblock_catalog' => ['all'],
                                'SHOW_INPUT' => 'Y',
                                'INPUT_ID' => 'title-search-input',
                                'CONTAINER_ID' => 'search',
                                'SHOW_PREVIEW' => 'Y',
                                'PREVIEW_WIDTH' => '75',
                                'PREVIEW_HEIGHT' => '75',
                            ],
                            false
                        );
                        ?>
                    </div>
                </div>
                <div class="payment">
                    <a href="<?= SITE_DIR ?>about/delivery/" class="payment__link">Доставка и оплата</a>
                </div>
            </div>
            <div class="header__menu">
                <div id="goodsmenu">
                    <?php
                    $APPLICATION->IncludeComponent(
                        'bitrix:menu',
                        'bootstrap_v4',
                        [
                            'ROOT_MENU_TYPE' => 'left',
                            'MAX_LEVEL' => '2',
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
                <div class="basket">
                    <?php
                    $APPLICATION->IncludeComponent(
                        'bitrix:sale.basket.basket.line',
                        'bootstrap_v4',
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

