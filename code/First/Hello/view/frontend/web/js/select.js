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
                        $('#employee').show('fast').html('');
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
                        $('#employee').on('click', function () {
                            var sku = $('#skuId').text();
                            $('#sku').val(sku);
                            $('#employee').hide('fast');
                        });
                    }

                });
            }
        });
    });
});

