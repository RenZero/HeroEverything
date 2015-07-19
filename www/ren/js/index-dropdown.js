/*!
 * Bootstrap v3.3.4 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/* dropdown signin function */
$(document).ready(function () {
    $('.active-links').click(function () {
        if ($('#signin-dropdown').is(":visible")) {
            $('#signin-dropdown').hide()
            $('#session').removeClass('active');
        } else {
            $('#signin-dropdown').show()
            $('#session').addClass('active');
        }
        return false;
    });
    $('#signin-dropdown').click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('#signin-dropdown').hide();
        $('#session').removeClass('active');
    });
});


/* page iframe */
$(document).ready(function(){
    $.get("about.html",function(data){ //初始將a.html include div#iframe
        $("#iframe").html(data);
    });

    $(function(){
        $('.list-side li').click(function() {
            // 找出 li 中的超連結 href(#id)
            var $this = $(this),
                _clickTab = $this.find('a').attr('href'); // 找到連結a中的targer標籤值
            if("-1"==_clickTab.search("http://")){
                $.get(_clickTab,function(data){
                    $("#iframe").html(data);
                });
                return false
            }
        })
    })

});