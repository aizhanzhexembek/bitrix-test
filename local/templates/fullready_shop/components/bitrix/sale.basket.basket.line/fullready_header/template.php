<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<a href="<?= htmlspecialcharsbx($arParams['PATH_TO_BASKET']) ?>" class="basket__link">Корзина</a>
<a href="<?= htmlspecialcharsbx($arParams['PATH_TO_BASKET']) ?>" class="basket__link-img">
    <?php if ((int)$arResult['NUM_PRODUCTS'] > 0): ?>
        <span class="basket__count"><?= (int)$arResult['NUM_PRODUCTS'] ?></span>
    <?php endif; ?>
</a>

