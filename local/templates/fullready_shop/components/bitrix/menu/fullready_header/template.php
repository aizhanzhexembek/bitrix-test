<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (empty($arResult)) {
    return;
}
?>
<nav class="goodsmenu">
    <ul class="menu">
        <?php foreach ($arResult as $menuItem): ?>
            <?php if ((int)$menuItem['DEPTH_LEVEL'] !== 1): ?>
                <?php continue; ?>
            <?php endif; ?>
            <li class="menu__list">
                <a href="<?= htmlspecialcharsbx($menuItem['LINK']) ?>" class="menu__link"><?= htmlspecialcharsbx($menuItem['TEXT']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

