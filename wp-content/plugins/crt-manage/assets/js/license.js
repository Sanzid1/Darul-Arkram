'use strict';
(function($) {
    $("body").on("click",".crt-btn-license",function(e){
        e.preventDefault();
        var _this = $(this);
        var _input = _this.prev().val();
        _this.text('Checking ...');
        var data = {
            'action': 'crt_manage_theme_purchase_code',
            'code': _input,
        };
        jQuery.post(ajaxurl, data, function(response) {
            _this.text('Active');
            if(response == 'NOT_EXIST') {
                alert('Does not exist');
            } else if(response == 'CODE_ACTIVED') {
                alert('License key activated');
            } else if(response == 'ACTIVE_SUCCESS') {
                alert('Active successfully, thank you for purchasing the premium version.');
                location.reload();
            }
        });
    });


})(jQuery);