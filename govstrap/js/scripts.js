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

}}}(jQuery,Drupal);