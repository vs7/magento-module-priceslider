var vs7 = vs7 || {};

(function ($, window, document, undefined) {
    vs7.hideEnds = function ($) {
        if (typeof vs7_price_slider_minmax === 'undefined') {
            return;
        }

        for (var key in vs7_price_slider_minmax) {
            var slider = $('#amshopby-' + key + '-ui');

            if (slider.length) {
                if (vs7_price_slider_minmax[key] == 1) {
                    $('#amshopby-' + key + '-ui > span:first').hide();
                    $('#amshopby-' + key + '-ui').on('slidecreate', function (event, ui) {
                        $(this).find('span:first').hide();
                    });
                }
                if (vs7_price_slider_minmax[key] == 2) {
                    $('#amshopby-' + key + '-ui > span:last').hide();
                    $('#amshopby-' + key + '-ui').on('slidecreate', function (event, ui) {
                        $(this).find('span:last').hide();
                    });
                }
            }

        }
    };

    $(document).ready(function () {
        vs7.hideEnds($amQuery);
    });

    Ajax.Responders.register({
        onComplete: function () {
            vs7.hideEnds($amQuery);
        }
    });
})(jQuery.noConflict(), window, document);