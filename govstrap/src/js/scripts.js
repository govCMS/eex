/**
 * @file
 * A JavaScript file for the Site.
 */

(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.govstrap = {
        attach: function (context, settings) {
            jQuery('#superfish-1 > li > ul > li > ul > li').each(function() {
                jQuery(this).addClass('level-3-menu');
                jQuery(this).unwrap();
            });

            jQuery('#superfish-1 > li > ul > li > li').each(function() {
                jQuery(this).unwrap();
            });

            jQuery('#superfish-1 > li > ul > a').each(function() {
                jQuery(this).wrap('<li></li>');
            });

            jQuery('#superfish-1 > li > ul > a > span.sf-sub-indicator').each(function() {
                jQuery(this).remove();
            });

            var titleHeight = jQuery('div.title-block').height();
            if(titleHeight > 1) {
                titleHeight = titleHeight + 70;
                jQuery('#block-menu-block-1').css('margin-top', '-' + titleHeight + 'px');
            }
        }
    };

})(jQuery, Drupal);
