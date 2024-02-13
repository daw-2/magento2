define([
    'uiComponent',
    'jquery',
    'ko',
], function (Component, $, ko) {
    return Component.extend({
        initialize() {
            this.customer = ko.observable({ fullname: 'Non connecté' });
            this.reversed = ko.observable(false);
            this.items = ko.observableArray([1, 2, 3]);

            $.getJSON('/customer/section/load').done((response) => {
                if (response.customer.fullname) {
                    this.customer(response.customer);
                }
            });
        },

        reverseName() {
            this.reversed(!this.reversed());
        },

        addItem() {
            this.items.push(this.items().length + 1);
        },

        removeItem(item) {
            this.items.remove(item);
        },
    });
});
