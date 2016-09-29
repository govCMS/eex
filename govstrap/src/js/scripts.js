/**
 * @file
 * A JavaScript file for the Site.
 */

(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.govstrap = {
        attach: function (context, settings) {
            // Need to make this work on orientation / window size change
            var titleHeight = jQuery('div.title-block').height();
            if(titleHeight > 1) {
                titleHeight = titleHeight + 70;
                jQuery('div.region-sidebar-second').css('margin-top', '-' + titleHeight + 'px');

                jQuery('div.region-sidebar-second').after('<div class="sidebar-corner"></div>');
            }
        }
    };

})(jQuery, Drupal);
