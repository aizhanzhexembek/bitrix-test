<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

$image = $arResult['DETAIL_PICTURE']['SRC'] ?: $arResult['PREVIEW_PICTURE']['SRC'];
$price = '';
$priceValue = '';
$oldPrice = '';

if (!empty($arResult['ITEM_PRICES'][0])) {
    $price = $arResult['ITEM_PRICES'][0]['PRINT_RATIO_PRICE'];
    $priceValue = (string)$arResult['ITEM_PRICES'][0]['RATIO_PRICE'];
    if ((float)$arResult['ITEM_PRICES'][0]['RATIO_BASE_PRICE'] > (float)$arResult['ITEM_PRICES'][0]['RATIO_PRICE']) {
        $oldPrice = $arResult['ITEM_PRICES'][0]['PRINT_RATIO_BASE_PRICE'];
    }
}
?>
<section class="product-card" itemscope itemtype="https://schema.org/Product">
    <div class="cardBig">
        <?php if ($image): ?>
            <img class="cardBig__img" src="<?= htmlspecialcharsbx($image) ?>" alt="<?= htmlspecialcharsbx($arResult['NAME']) ?>" itemprop="image">
        <?php endif; ?>
        <div class="cardBig__description">
            <h1 class="cardBig__title" itemprop="name"><?= htmlspecialcharsbx($arResult['NAME']) ?></h1>
            <?php if ($arResult['DETAIL_TEXT']): ?>
                <p class="cardBig__text" itemprop="description"><?= nl2br(htmlspecialcharsbx(strip_tags($arResult['DETAIL_TEXT']))) ?></p>
            <?php endif; ?>
            <div class="cardBig__priceBlock" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <?php if ($priceValue !== ''): ?>
                    <meta itemprop="price" content="<?= htmlspecialcharsbx($priceValue) ?>">
                    <meta itemprop="priceCurrency" content="RUB">
                <?php endif; ?>
                <link itemprop="availability" href="https://schema.org/InStock">
                <?php if ($oldPrice): ?>
                    <p class="cardBig__priceBlock-oldprice"><?= $oldPrice ?></p>
                <?php endif; ?>
                <p class="cardBig__priceBlock-newprice"><?= $price ?></p>
            </div>
        </div>
    </div>
</section>

