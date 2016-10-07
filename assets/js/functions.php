<?php 
// header('content-type: application/x-javascript');
header('content-type: text/javascript');

$base_url = '/my_framework2';

function replace($sub)
{
    $date = preg_replace("/^[0-9]{2}[ ][a-zA-Z]{3}[ ][0-9]{4}/", '',$sub);
    $date = preg_replace("/:[0-9]{2}$/", '', $date);
    echo $date;
}

$functions = <<<EOF

    function _loading()
    {
       return $('<div class="loading"><img src="$base_url/assets/css/img/loader_fb.gif"  /></div>');

    }

    function load_comment(post_id)
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/load_comments/'+post_id,
            cache       : true,
            beforeSend  : function()
            {
                $('#comments-'+post_id).append(_loading());
            },
            success     : function(comments)
            {
                $('.loading').hide();
                $('#comments-'+post_id).append(comments);
            }
        });
    }
    function load_all_comments(post_id)
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/load_all_comments/'+post_id,
            beforeSend  : function()
            {
                $('#comments-'+post_id).append(_loading());
            },
            success     : function(comments)
            {
                $('.loading').hide();
                $('#comments-'+post_id).html(comments).fadeIn(300);
            }
        });
    }
  
    function write_comment(id)
    {
        $('#txt-comment-'+id).focus();
    }

    function comment(id)
    {      
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/comment',
            data        : $('#frm-comment-'+id).serialize(),
            cache       : true,
            beforeSend  : function()
            {
                //$('#frm-comment-'+id+' .post-comments').hide();
                $('#frm-comment-'+id).prepend(_loading());
            },
            success     : function(comment)
            {
               $('.loading').hide();
               //$('#frm-comment-'+id+' .post-comments').show();
               var c = $(comment);
               $('#comments-'+id).append(c);
               c.hide().fadeIn(500);
               clear_txt('.txt-comment','Comment...');
               $('.txt-comment').css('color','#acacac');
            }
        });
    }

    function write_post()
    {
        $('#frm-write').ajaxForm({
            beforeSend: function() { //brfore sending form
                $('#loading-post').append(_loading());
                $('#progress').width('0%').show()
            },
            uploadProgress: function(event, position, total, percentComplete) { //on progress
                $('#progress').width(percentComplete + '%') //update progressbar percent complete
                $('#f').html(percentComplete + '%'); //update status text
                if(percentComplete>50)
                {
                    //statustxt.css('color','#38FFBC'); //change status text to white after 50%
                }
            },
            complete: function(post) { // on complete
                $('#f').html('100%').hide(); //update status text
                clear_txt('#write','Write...');
                $('#progress').width('100%').fadeOut(300); //update progressbar percent complete
                var p = $(post.responseText);
                $('#write').css('color','#acacac');
                $('#loading-post').html('');
                $('#post-content').prepend(p);
                p.hide().fadeIn(500);
                $('.post-text').truncate(); 
                    
            }
        }).submit();
        // $.ajax({
        //     type        : 'POST',
        //     url         : '$base_url/post/write',
        //     data        : $('#frm-write').serialize(),
        //     cache       : true,
        //     beforeSend  : function()
        //     {
        //         $('#loading-post').append(_loading());
        //     },
        //     success     : function(post)
        //     {
        //         clear_txt('#write','Write...');
        //         var p = $(post);
        //         $('#write').css('color','#acacac');
        //         $('#loading-post').html('');
        //         $('#post-content').prepend(p);
        //         p.hide().fadeIn(500);
        //         $('.post-text').truncate();
        //     }
        // });
    }

    function like_post(post_id)
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/like_post/'+post_id,
            cache       : true,
            beforeSend  : function()
            {
                
            },
            success     : function(post)
            {
                $('#like-'+post_id).html('<i class="icon-thumbs-down"></i> Unlike').attr('href','javascript: unlike_post('+post_id+');');
                count_like_post(post_id);
            }
        });   
    }

    function unlike_post(post_id)
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/unlike_post/'+post_id,
            cache       : true,
            beforeSend  : function()
            {
                
            },
            success     : function(post)
            {
                $('#like-'+post_id).html('<i class="icon-thumbs-up"></i> Like').attr('href','javascript: like_post('+post_id+');');
                count_like_post(post_id);
            }
        });   
    }

    function check_like_post(post_id)
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/check_like_post/'+post_id,
            success     : function(confirm)
            {
                if (confirm == 'true')
                    $('#like-'+post_id).html('<i class="icon-thumbs-down"></i> Unlike').attr('href','javascript: unlike_post('+post_id+');');
            }
        });
    }



    function count_like_post(post_id)
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/count_like_post/'+post_id,
            success     : function(text)
            {
                if (text != false)
                {
                    $('#num-likes-post-'+post_id).html(text);
                }
                else
                {
                    $('#num-likes-post-'+post_id).html('');   
                }
            }
        });  
    }

    function clear_txt(txt, value)
    {
        $(txt).val(value);
    }

    ElapsedTimeLogger = function(dateElementId, elapsedElementId, interval)
                        {
                            var container = $(elapsedElementId);
                            var time = parseDate(dateElementId);
                            var interval = interval;
                            var timer;

                            function parseDate(dateString)
                            {
                                var date = new Date(dateString);
                                return date.getTime();
                            }

                            function get_Day(dateString)
                            {                                
                                var day = new Date(dateString).getDay();

                                var days = new Array();

                                days[0] = 'Sunday';
                                days[1] = 'Monday';
                                days[2] = 'Tuesday';                        
                                days[3] = 'Wednesday';                        
                                days[4] = 'Thursday';                        
                                days[5] = 'Friday';                        
                                days[6] = 'Saturday';

                                return days[day];               
                            }

                            function update()
                            {
                                var systemTime = new Date().getTime();
                                elapsedTime = systemTime - time;                            
                                container.html(prettyPrintTime(Math.floor(elapsedTime / 1000)));
                            }

                            function prettyPrintTime(numSeconds)
                            {                               
                                var seconds = numSeconds;
                                var minutes = Math.floor(numSeconds / 60);
                                var hours = Math.floor(numSeconds / 3600); 
                                var elapsedDays = Math.floor(hours / 24);
                                var elapsedYears = new Date().getYear() - new Date(dateElementId).getYear();        
                                
                                var time;
                                if (minutes <= 0)
                                    time = ((seconds <= 2) ? 'a few seconds' : seconds + ' seconds') +' ago';
                                else if (hours <= 0)
                                    time = 'about '+ minutes + ((minutes < 2) ? ' minute' : ' minutes') + ' ago';                                                              
                                else if (hours <= 23)
                                    time = 'about '+ hours + ((hours < 2) ? ' hour' : ' hours') + ' ago';
                                else if (hours >= 24 && elapsedDays <= 1)
                                {
                                    var str = dateElementId;
                                    var newdate = str.replace(/^[0-9]{2}[ ][a-zA-Z]{3}[ ][0-9]{4}/,"");
                                    time = 'Yesterday at '+ newdate.replace(/:[0-9]{2}$/, "");
                                }
                                else if ( elapsedDays >= 2 && elapsedDays <= 6)
                                {
                                    var str = dateElementId;
                                    var newdate = str.replace(/^[0-9]{2}[ ][a-zA-Z]{3}[ ][0-9]{4}/,"");
                                    time = get_Day(dateElementId) + ' at '+ newdate.replace(/:[0-9]{2}$/,"");                                    
                                }
                                else
                                {
                                    var str = dateElementId;
                                    var newdate = (elapsedYears == 0) ? str.replace(/[0-9]{4}/,"") : str;
                                    time = newdate.replace(/:[0-9]{2}$/,"");                                                                  
                                }

                                // time = hours + ':' + minutes + ':' + seconds; 

                                return time;
                            }

                            update();

                            this.start = function()
                            {
                                timer = setInterval(function(){
                                    update()
                                }, interval * 1000);
                            }

                            this.stop = function()
                            {
                                clearTimeout(timer);
                            }
                        }
    var offset = 0;
    var count  = 5;

    $(window).on('scroll', function(){
        $('#c-content').css({'height':'auto'});
        var sT    = $(window).scrollTop();
        var dH    = $(document).height();
        var wH    = $(window).height();
        var sA    = Math.floor((sT / (dH - wH)) * 100);
        //console.log(sA + 20 +' ' + ((dH - wH) + 20));
        //console.log(sA + '= ' + dH + ' - '  + wH);
        // console.log(sA);
        var nmp = $('#loading-container').find('#no-more-post').length;
        if((sA >= 80 && sA <= 85) && nmp == 0)
        {
            load_posts();
        }
    });

    function load_posts()
    {
        $.ajax({
            type        : 'POST',
            url         : '$base_url/post/load_posts/'+offset+'/'+count,
            cache       : true,
            beforeSend  : function()
            {
                $('#loading-container .loading').show();
                $('#loading-container a').hide();
            },
            success     : function(oldpost)
            {
                $('#loading-container .loading').hide();
                $('#loading-container a').show();
                if ( oldpost != '0')
                {
                    var op = $(oldpost);
                    $('#post-content').append(op);
                    op.find('.post-text').truncate();
                }
                else
                {
                    $('#loading-container').append('<input type="hidden" id="no-more-post" />');
                }                  
            },
            error       : function()
            {
                alert('error');
            }
        });
        offset += 5;
        
    }


    $(window).on('resize', function(){
        width = $(window).width();
        if(width > 979)
        {
            $('ul.nav').show();
        }
        else
        {
            $('ul.nav').hide();
        }
        $('#content').css({'height':$(window).height() - 110});

    });

EOF;

echo $functions;