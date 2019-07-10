require(["jquery", "Magento_Customer/js/customer-data"], function ($, customerData) {
    'use strict';
    $(document).ready(function (e) {
        $('#form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $('#form').attr('action'),
                data: $(this).serialize(),
                type: 'post',
                success: function (res) {
                    var section = ['cart'];
                    customerData.invalidate(section);
                    customerData.reload(section, true);
                }
            });

        });
    });
});
