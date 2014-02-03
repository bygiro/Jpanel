/*
 * @package		mod_jpanel
 * @copyright	Copyright (C) 2012 Girolamo Tomaselli All rights reserved.
 * @email		girotomaselli@gmail.com
 * @website		http://bygiro.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

function openJpanel(jpanel_id){
	var side = jpanel_id.split('_');
	
	switch(side[2]){
		case 'right':
			jQuery(jpanel_id).stop(true, false).animate({
			   right: '0px'
			}, 900);	
		break;
		
		case 'left':
			jQuery(jpanel_id).stop(true, false).animate({
			   left: '0px'
			}, 900);	
		break;
		
		case 'top':
			jQuery(jpanel_id).stop(true, false).animate({
			   top: '0px'
			}, 900);	
		break;
		
		case 'bottom':
			jQuery(jpanel_id).stop(true, false).animate({
			   bottom: '0px'
			}, 900);	
		break;
	}
	
	jQuery(jpanel_id + ' .jpanelHandle').addClass('jpanel_open');
}

function closeJpanel(jpanel_id){
	var side = jpanel_id.split('_');
	switch(side[2]){
		case 'right':
			jQuery(jpanel_id).animate({
				right:  ((jQuery(jpanel_id + ' .jpanelContent').width() + 11) * -1)+'px'
			}, 800);	
		break;
		
		case 'left':
			jQuery(jpanel_id).animate({
				left:  ((jQuery(jpanel_id + ' .jpanelContent').width() + 11) * -1)+'px'
			}, 800);	
		break;
		
		case 'top':
		   jQuery(jpanel_id).animate({
				top: ((jQuery(jpanel_id + ' .jpanelContent').height() + 1) * -1)+'px'
			}, 800);	
		break;
		
		case 'bottom':
		   jQuery(jpanel_id).animate({
				bottom: ((jQuery(jpanel_id + ' .jpanelContent').height() + 1) * -1)+'px'
			}, 800);	
		break;
	}

	jQuery(jpanel_id + ' .jpanelHandle').removeClass('jpanel_open');	
}

function clickJpanel(jpanel_id){

    jQuery(jpanel_id + ' .jpanelHandle').click(function() {
		if(!jQuery(jpanel_id + ' .jpanelHandle').hasClass('jpanel_open')){
			
			/* open the panel */
			openJpanel(jpanel_id);
			
		} else {
				
			/* close the panel */
			closeJpanel(jpanel_id);
		}
    });		
}

function hoverJpanel(jpanel_id){
    jQuery(jpanel_id + ' .jpanelHandle').hover(function() {
		/* open the panel */
        openJpanel(jpanel_id);
    }, function() {
        /* Do nothing */
    });

    jQuery(jpanel_id).hover(function() {
        /* Do nothing */
    }, function() {

        /* close the panel */
		closeJpanel(jpanel_id);
    });	
}

function initjPanelHandle(jpanel_id){
		var properties = {},
			side = jpanel_id.split("_"),
			handle = jQuery(jpanel_id).find(".jpanelHandle"),
			handleW = handle.outerWidth(),
			handleH = handle.outerHeight();
			
		properties.position = "absolute";
		switch(side[2]){
			case "right":
				properties.top = "0";
				properties.left = - (handleW +11) +"px";
			break;
			
			case "left":
				properties.top = "0";
				properties.right = - (handleW +11) +"px";	
			break;
			
			case "top":
				properties.left = "0";
				properties.bottom = - handleH +"px";	
			break;
			
			case "bottom":
				properties.left = "0";
				properties.top = - handleH +"px";	
			break;
		}		

		handle.css(properties);
		
		console.log(properties);
}

jQuery.fn.textWidth = function(){
  var html_org = jQuery(this).html();
  var html_calc = "<span>" + html_org + "</span>";
  jQuery(this).html(html_calc);
  var width = jQuery(this).find("span:first").width();
  jQuery(this).html(html_org);
  return width;
};