(function ($) {
  Drupal.behaviors.hover_card = {
    attach: function (context, settings) {
      var module_path = Drupal.settings.hover_card.module_path;
      var hoverUserDetails = '<div class="hover-details"></div>';
      $("a.username").hovercard({
        detailsHTML: hoverUserDetails,
        width: 250,
        onHoverIn: function () {
          var user_id = $(this).find("a").attr("href").split("/");
          var hover_details = $(".hover-details");
          $.ajax({
            url: Drupal.settings.basePath + "hover-card",
            type: 'GET',
            data: {
              id: user_id[3]
            },
            beforeSend: function () {
              hover_details.empty();
              hover_details.prepend('<p style="text-align: center"><img src="' + module_path + '/images/ajax-loader.gif"></p>');
            },
            success: function (data) {
              hover_details.html(data);
            },
            complete: function () {
              $('.loading-text').remove();
            }
          });
        }
      });
    }
  };
})(jQuery);
