/**
 * @file
 * A JavaScript file for the Site.
 */

(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.govstrap = {
        attach: function (context, settings) {
            moveSidebarMenu();
            jQuery(window).resize(function () {
                moveSidebarMenu();
            });
            footnote();
        }
    };

})(jQuery, Drupal);

function moveSidebarMenu() {
    var titleHeight = jQuery('div.title-block').height();
    //768px wide and it moves to 'mobile' version bootstrap
    if (titleHeight > 1) {
        titleHeight = titleHeight + 70;
        if (jQuery(window).width() >= 768) {
            jQuery('div.region-sidebar-second').css('margin-top', '-' + titleHeight + 'px');
            if (jQuery('div.sidebar-corner').length == 0) {
                jQuery('div.region-sidebar-second').after('<div class="sidebar-corner"></div>');
            }
        } else {
            jQuery('div.region-sidebar-second').css('margin-top', '0px');
            if (jQuery('div.sidebar-corner').length == 0) {
                jQuery('div.region-sidebar-second').after('<div class="sidebar-corner"></div>');
            }
        }
    }
}

/**
 * Footnote.
 */
function footnote() {
    try {
        var target = window.location.hash;
        if (target.substr(0, 4) == '#fn-') {
            var pieces = target.split('-');
            if (pieces.length == 3) {
                var pid = pieces[1];
                footnote_show(pid);
            }
        }
    } catch (ex) {
        // Error handler.
    }
}

function footnote_show(pid) {
    jQuery('#footnotes-' + pid + ' ol').show();
    footnote_updatelabel(pid);
}

function footnote_togglevisible(pid) {
    jQuery('#footnotes-' + pid + ' ol').toggle();
    footnote_updatelabel(pid);
    return false;
}

function footnote_updatelabel(pid) {
    if (jQuery('#footnotes-' + pid + ' ol').is(':visible')) {
        jQuery('#footnotes-' + pid + ' .footnoteshow').hide();
    } else {
        jQuery('#footnotes-' + pid + ' .footnoteshow').show();
    }
}
