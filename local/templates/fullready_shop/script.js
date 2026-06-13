(function () {
    function initSelectric(context) {
        if (!window.jQuery || !jQuery.fn || !jQuery.fn.selectric) {
            return;
        }

        var $ctx = context ? jQuery(context) : jQuery(document);
        $ctx.find('select, .select').each(function () {
            var $select = jQuery(this);
            if ($select.data('selectric')) {
                $select.selectric('refresh');
            } else {
                $select.selectric({
                    disableOnMobile: false,
                    nativeOnMobile: false
                });
            }
        });
    }

    function bindAjaxHooks() {
        if (!window.BX || !BX.addCustomEvent) {
            return;
        }

        BX.addCustomEvent('onAjaxSuccess', function () {
            initSelectric(document);
        });
    }

    if (window.BX && BX.ready) {
        BX.ready(function () {
            initSelectric(document);
            bindAjaxHooks();
        });
        return;
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initSelectric(document);
        });
    } else {
        initSelectric(document);
    }
})();
