jQuery(document).ready(function ($) {
    var $container        = $('.acf-cpt-register'),
        subpage_translate = $container.data('subpage'),
        checkboxes        = $('input[type="checkbox"]', $container),
        plusHTML          = '<span class="dashicons dashicons-plus-alt"></span>',
        trashHTML         = '<span class="dashicons dashicons-trash"></span>';

    checkboxes.change(function(){
       var _t = $(this);
       if( _t.prop('checked') ) {
           _t.parents('h4').append(plusHTML);
       } else {
           _t.parents('h4').find('.dashicons').remove();
       }
    });

    $(this).on('click', '.dashicons-plus-alt', function () {
        var _n = $(this).prev().find('input').val();
        $(this).parents('.cpt-row').append(
            '<p class="sub-line"><span>'+ subpage_translate +'</span>' +
                '<input type="text" name="cpts['+ _n +'][]">' +
                trashHTML +
            '</p>'
        );
    });

    $(this).on('click', '.dashicons-trash', function () {
        $(this).parent().remove();
    });

    $('.sub-line input[type="text"]').on('change',function(){
        var arr = [],
            $siblings = $(this).siblings();
        $.each($siblings, function (i, key) {
            arr.push($(key).val());
        });
        if ($.inArray($(this).val(), arr) !== -1)
        {
            alert("duplicate has been found");
        }
    });

    var timeOutSelect;
    $("input[type=text][readonly]").focus(function() {
        var save_this = $(this);
        clearTimeout(timeOutSelect);
        timeOutSelect = window.setTimeout (function(){
            save_this.select();
        }, 100);
    });

});