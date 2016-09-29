!function(t,a){"use strict";a.behaviors.govstrap={attach:function(t,a){
    //Loop over all 3rd level uls
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


    // Need to make this work on orientation / window size change
    var titleHeight = jQuery('div.title-block').height();
    if(titleHeight > 1) {
        titleHeight = titleHeight + 70;
        jQuery('#block-menu-block-1').css('margin-top', '-' + titleHeight + 'px');

        jQuery('.region-sidebar-second').after('<div class="sidebar-corner"></div>');
    }

}}}(jQuery,Drupal);