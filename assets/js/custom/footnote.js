/**
 * Created by leomarbucud on 22/09/2016.
 */
var footnote = (function ($, document) {

    var evt = [

        // show
        function ($) {

            $('[data-options]').click(function(e){
                var $this = $(this);
                var option = $this.data('options');
                console.log($this.data('options'));
                $('#'+option).removeClass('hide');
                if($this.data('callback')) {
                    var cb = $this.data('callback').split("|",2);
                    var action = cb[0],
                        elem = cb[1];
                    if(action == "hide") {
                        $('#'+elem).removeClass('show').addClass('hide');
                    } else if(action == "show") {
                        $('#'+elem).removeClass('hide').addClass('show');
                    }
                }
                e.preventDefault();
            });

        },

        function($) {
            $('form#share-box').submit(function(e){
                var data = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method:'POST',
                    data: data,
                   // dataType:'text/HTML',
                    success: function(result) {
                        console.log(result);
                        $('.post-list').prepend(result);
                    }
                });
                e.preventDefault();
            });
        },
    
        function($) {
            $('form#update-info').validator().on('submit', function(e){
                if (e.isDefaultPrevented()) {
                    //alert('form is not valid');
                } else {
                    e.preventDefault();
                    var data = $(this).serialize();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: data,
                        // dataType:'text/HTML',
                        success: function (result) {
                            console.log(result);
                            //$('.post-list').prepend(result);
                        }
                    });
                }
            });
        },
        function($) {
            $('form#update-security').validator().on('submit', function(e){
                if (e.isDefaultPrevented()) {
                    //alert('form is not valid');
                } else {
                    e.preventDefault();
                    var data = $(this).serialize();
                    $.ajax({
                        url: $(this).attr('action'),
                        method:'POST',
                        data: data,
                        // dataType:'text/HTML',
                        success: function(result) {
                            console.log(result);
                            //$('.post-list').prepend(result);
                        }
                    });
                }
            });
        },

        // populate post
        function($) {
            
        }

    ],
    initAll = function () {
        initEvt();
    },
    initEvt = function () {
        evt.forEach(function (e) {
            e($, document);
        });
    };

    return { init: initAll };

})(jQuery, document);

footnote.init();