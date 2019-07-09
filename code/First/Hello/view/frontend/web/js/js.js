require(['jquery'], function ($) {
    'use strict';
    $(document).ready(function (e) {
        $('#form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: $('#form').attr('action'),
                data: $(this).serialize(),
                type: 'post'

            })

        });
    });
});