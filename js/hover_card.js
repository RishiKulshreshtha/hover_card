(function($) {
    Drupal.behaviors.hover_card = {
        attach: function(context, settings) {
            var modulePath = Drupal.settings.hover_card.path;
            var hoverUserDetails = '<div class="hover-details"></div>';
            $("a.username").hovercard({
                detailsHTML: hoverUserDetails,
                width: 250,
                onHoverIn: function() {
                    var user_id = $(this).find("a").attr("href").split("/");
                    $.ajax({
                        url: Drupal.settings.basePath + "hover-card",
                        type: 'GET',
                        data: {
                            id: user_id[3],
                        },
                        beforeSend: function() {
                            $(".hover-details").empty();
                            $(".hover-details").prepend('<p style="text-align: center"><img src="' + modulePath + '/images/ajax-loader.gif"></p>');
                        },
                        success: function(data) {
                            var obj = $.parseJSON(data);
                            $(".hover-details").empty();
                            var result = "";
                            if (obj.picture != null) {
                                result += obj.picture;
                            }
                            result += '<strong>Username: </strong>' + obj.name + '<br/><strong>Email: </strong>' + obj.mail + '<br/><strong>Roles: </strong>' + obj.roles + '<br/>';
                            $(".hover-details").html(result);
                        },
                        complete: function() {
                            $('.loading-text').remove();
                        }
                    });
                }
            });
        }
    };
})(jQuery);
