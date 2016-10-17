/**
 * @file
 * A JavaScript file for the Site.
 */

(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.govstrap = {
        attach: function (context, settings) {
            moveSidebarMenu();
            jQuery(window).resize(function() {moveSidebarMenu();});
        }
    };

})(jQuery, Drupal);

function moveSidebarMenu() {
    console.log("Move Sidebar");
    var titleHeight = jQuery('div.title-block').height();
    //768px wide and it moves to 'mobile' version bootstrap
    if (titleHeight > 1) {
        titleHeight = titleHeight + 70;
        if(jQuery(window).width() >= 768) {
            jQuery('div.region-sidebar-second').css('margin-top', '-' + titleHeight + 'px');
            if(jQuery('div.sidebar-corner').length == 0) {
                jQuery('div.region-sidebar-second').after('<div class="sidebar-corner"></div>');
            }
        } else {
            jQuery('div.region-sidebar-second').css('margin-top',  '0px');
            if(jQuery('div.sidebar-corner').length == 0) {
                jQuery('div.region-sidebar-second').after('<div class="sidebar-corner"></div>');
            }
        }
    }
}
