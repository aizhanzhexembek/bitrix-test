<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
?>
<section class="cameras">
    <div class="cameras_inner">
        <div class="filtres__inner">
            <h3 class="filtres__item"><?= htmlspecialcharsbx($arParams['SECTION_TITLE'] ?? 'КАТАЛОГ') ?></h3>
            <button type="button" class="filtres__link" onclick="OpenFilterPopup()">
                <img class="filtres__options" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/options.svg" alt="Опции фильтра">
            </button>
        </div>

        <div class="cards">
            <?php foreach ($arResult['ITEMS'] as $index => $item): ?>
                <?php
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item['IBLOCK_ID'], 'ELEMENT_EDIT'));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item['IBLOCK_ID'], 'ELEMENT_DELETE'), ['CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM')]);

                $image = $item['PREVIEW_PICTURE']['SRC'] ?: $item['DETAIL_PICTURE']['SRC'];
                $title = $item['NAME'];
                $preview = trim(strip_tags($item['PREVIEW_TEXT']));
                $price = '';
                $oldPrice = '';

                if (!empty($item['ITEM_PRICES'][0])) {
                    $price = $item['ITEM_PRICES'][0]['PRINT_RATIO_PRICE'];
                    if ((float)$item['ITEM_PRICES'][0]['RATIO_BASE_PRICE'] > (float)$item['ITEM_PRICES'][0]['RATIO_PRICE']) {
                        $oldPrice = $item['ITEM_PRICES'][0]['PRINT_RATIO_BASE_PRICE'];
                    }
                }
                ?>

                <?php if ($index === 0): ?>
                    <div class="cardBig" id="<?= $this->GetEditAreaId($item['ID']) ?>">
                        <?php if ($image): ?>
                            <img class="cardBig__img" src="<?= htmlspecialcharsbx($image) ?>" alt="<?= htmlspecialcharsbx($title) ?>">
                        <?php endif; ?>
                        <div class="cardBig__description">
                            <h3 class="cardBig__title"><?= htmlspecialcharsbx($title) ?></h3>
                            <?php if ($preview !== ''): ?>
                                <p class="cardBig__text"><?= htmlspecialcharsbx($preview) ?></p>
                            <?php endif; ?>
                            <div class="cardBig__priceBlock">
                                <?php if ($oldPrice): ?>
                                    <p class="cardBig__priceBlock-oldprice"><?= $oldPrice ?></p>
                                <?php endif; ?>
                                <a href="<?= htmlspecialcharsbx($item['DETAIL_PAGE_URL']) ?>"><p class="cardBig__priceBlock-newprice"><?= $price ?></p></a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="cardItem" id="<?= $this->GetEditAreaId($item['ID']) ?>">
                        <?php if ($image): ?>
                            <img class="cardItem__img" src="<?= htmlspecialcharsbx($image) ?>" alt="<?= htmlspecialcharsbx($title) ?>">
                        <?php endif; ?>
                        <div class="cardItem__description">
                            <h3 class="cardItem__title"><?= htmlspecialcharsbx($title) ?></h3>
                            <?php if ($preview !== ''): ?>
                                <p class="cardItem__text"><?= htmlspecialcharsbx($preview) ?></p>
                            <?php endif; ?>
                            <a href="<?= htmlspecialcharsbx($item['DETAIL_PAGE_URL']) ?>"><p class="cardItem__price"><?= $price ?></p></a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

