require(["jquery"], function ($) {
    'use strict';
    $(document).ready(function (e) {
        var lenght = 3;
        $('#sku').on('keyup', function () {
            if ($(this).val().length >= lenght) {
                var sku = $('#sku').val();
                $.ajax({
                    url: '/firsthello/hello/product',
                    data: { sku },
                    type: 'post',
                    dataType: 'text',
                    success: function (data) {
                      console.log(data);
                      $('.selectList').html(data);
                    }
                });
            }
        });
    });
});
