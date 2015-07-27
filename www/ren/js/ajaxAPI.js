/*!
 * Bootstrap v3.3.4 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/* dropdown signin function */

$(document).ready(function(){
    $('input').click(function(){
        $.ajax({
            url: "http://heroeverything.com/heroeverythingAPI/public/index.php/get",
            data: {"barid":"1"},
            type:"POST",
            dataType:'json',
            success: function(msg){
                $('#content').html(msg.name);
                console.log(msg);
            }
        });
    });
});

