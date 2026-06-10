<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
?>
<form class="cameras__filtres" name="<?= htmlspecialcharsbx($arResult['FILTER_NAME']) . '_form' ?>" action="<?= htmlspecialcharsbx($arResult['FORM_ACTION']) ?>" method="get">
    <?php foreach ($arResult['HIDDEN'] as $item): ?>
        <input type="hidden" name="<?= htmlspecialcharsbx($item['CONTROL_NAME']) ?>" id="<?= htmlspecialcharsbx($item['CONTROL_ID']) ?>" value="<?= htmlspecialcharsbx($item['HTML_VALUE']) ?>">
    <?php endforeach; ?>

    <?php foreach ($arResult['ITEMS'] as $item): ?>
        <?php if ($item['PRICE']): ?>
            <?php continue; ?>
        <?php endif; ?>
        <?php if (empty($item['VALUES'])): ?>
            <?php continue; ?>
        <?php endif; ?>

        <label>
            <select class="cameras__brand" name="<?= htmlspecialcharsbx(reset($item['VALUES'])['CONTROL_NAME']) ?>">
                <option value=""><?= htmlspecialcharsbx($item['NAME']) ?></option>
                <?php foreach ($item['VALUES'] as $value): ?>
                    <option value="<?= htmlspecialcharsbx($value['HTML_VALUE']) ?>" <?= $value['CHECKED'] ? 'selected' : '' ?>>
                        <?= htmlspecialcharsbx($value['VALUE']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    <?php endforeach; ?>

    <button type="submit" class="filterPopup__inner-button">ПРИМЕНИТЬ</button>
</form>

