<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer__contacts">
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
            <div class="footer__copyright">
                <?php
                $APPLICATION->IncludeComponent(
                    'bitrix:main.include',
                    '',
                    [
                        'AREA_FILE_SHOW' => 'file',
                        'PATH' => SITE_DIR . 'include/copyright.php',
                    ],
                    false
                );
                ?>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
