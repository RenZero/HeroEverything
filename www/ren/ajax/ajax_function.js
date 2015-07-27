
+function ($) {

    $(document).ready(function(){
        $('input').click(function(){
            $.ajax({
                url: "http://heroeverything.com/heroeverythingAPI/public/index.php/get",
                data: {"barid":"1"},
                type:"POST",
                dataType:'json',
                success: function(msg){
                    $('#userid').html(msg.userid);
                    $('#unit').html(msg.unit);
                    $('#type').html(msg.type);
                    $('#name').html(msg.name);
                    $('#title').html(msg.title);
                    $('#vol_max').html(msg.vol_max);
                    $('#vol_current').html(msg.vol_current);
                    $('#cron').html(msg.cron);
                    $('#api_key').html(msg.api_key);
                    $('#privacy').html(msg.privacy);
                    $('#alertdefine').html(msg.alertdefine);
                    $('#eventqueue').html(msg.eventqueue);
                    $('#lastupdate').html(msg.lastupdate);
                    $('#created_at').html(msg.created_at);
                    $('#updated_at').html(msg.updated_at);

                    console.log(msg);
                }
            });
        });
    });

}(jQuery);