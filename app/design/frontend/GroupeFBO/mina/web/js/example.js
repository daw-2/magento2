define(['jquery'], function ($) {
    return function (config, element) {
        $(element).html(config.name);
    };
});
