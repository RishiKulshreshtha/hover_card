/**
 * @file
 * Javascript and jQuery functions which are useful for the hover_card module.
 */

(function($) {
  Drupal.behaviors.hover_card = {
    attach: function(context, settings) {
      var hoverUserDetails = '<div class="hover-details"></div>'; // Declaring the variable 'hoverUserDetails', it holds the initiating HTML tag useful for the Hovercard JS plugin.
      $("a.username").hovercard({ // Targetting 'hovercard' function for all anchor tags with 'username' as their class. This function will initiate the 'hovercard' function from the Hovercard JS file.
        detailsHTML: hoverUserDetails,
        width: 250,
        onHoverIn: function() {
          var base_path = Drupal.settings.basePath; // Declaring base_path as variable for further use in image path.
          var module_path = Drupal.settings.hover_card.module_path; // Declaring module_path as variable for Hover Card module path which is required for fetching the loader image path from the Hover Card module directory.
          var hover_details = $(".hover-details"); // Declaring this as a variable for efficiency as its used multiple times.
          var user_id = $(this).find("a").attr("href").split("/"); // We'll store the User ID in this variable
          $.ajax({
            url: Drupal.settings.basePath + "hover-card/" + user_id[3],
            beforeSend: function() {
              hover_details.empty();
              hover_details.prepend('<p style="text-align: center"><img src="' + basePath + module_path + '/images/ajax-loader.gif"></p>');
            },
            success: function(data) {
              hover_details.html(data);
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
