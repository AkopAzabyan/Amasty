require(["jquery"], function ($) {
    'use strict';
    $(document).ready(function (e) {
        var lenght = 3;
        $('#sku').on('keyup', function () {
            if ($(this).val().length >= lenght) {
                var sku = $('#sku').val();
                $.ajax({
                    url: '/firsthello/hello/product',
                    data: {sku},
                    type: 'post',
                    dataType: 'text',
                    success: function (data) {
                        var val = JSON.parse(data);
                        /*console.log(data);*/
                        $('.selectList').show('fast').html(data);
                        $.each(val, function (index, value) {
                            var src = '/pub/media/catalog/product' + value.image;
                            $('.selectList').append('<li><p>' + value.name + '</p></li>' + '<li><p>' + value.sku + '</p></li>' + '<li><p><img src=' + src + '></p></li>');
                        });
                       /* $('.selectList li').on('click',function () {
                            $('#sku').val($(this).children('.skuProduct').text());
                            $('.selectList').hide('fast');
                        })*/
                    }
                });
            }
        });
    });
});
