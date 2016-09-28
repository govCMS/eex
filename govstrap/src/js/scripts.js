/**
 * @file
 * A JavaScript file for the Site.
 */

(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.govstrap = {
        attach: function (context, settings) {
            // Site scripts.
            //Loop over all 3rd level uls
            jQuery('#superfish-1 > li > ul > li > ul').each(function() {
                $a=$(this).children('li');
                // Move
                $($a.parent().parent()).after($a);
                // Delete
                $(this).remove();
            });
        }
    };

})(jQuery, Drupal);
