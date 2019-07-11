require(["jquery", "mage/template"], function ($, template) {
    'use strict';
    $(document).ready(function () {
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
                        console.log(val);
                        $('.selectList').show('fast').html('');
                        $.each(val, function () {
                            var src = '/pub/media/catalog/product';
                            var employeeTemplate = template('#employee-template');
                            var employee = employeeTemplate({
                                data: {
                                    name: this['name'],
                                    sku: this['sku'],
                                    img: this['image']
                                }
                            });
                            $('#employee').append(employee);
                        });
                        /*var src = '/pub/media/catalog/product/' + value.image;
                        $('.selectList').append('<li><p>' + value.name + '</p></li>' + '<li><p>' + value.sku + '</p></li>' + '<li><p><img src=' + src + '></p></li>');*/
                    }
                    /* $('.selectList li').on('click', function () {
                         $('#sku').val();
                         $('.selectList').hide('fast');
                     });*/
                });
            }
        });
    });
});

