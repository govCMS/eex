!function(t,a){"use strict";a.behaviors.govstrap={attach:function(t,a){
    // Need to make this work on orientation / window size change
    var titleHeight = jQuery('div.title-block').height();
    if(titleHeight > 1) {
        titleHeight = titleHeight + 70;
        jQuery('div.region-sidebar-second').css('margin-top', '-' + titleHeight + 'px');

        jQuery('div.region-sidebar-second').after('<div class="sidebar-corner"></div>');
    }

}}}(jQuery,Drupal);