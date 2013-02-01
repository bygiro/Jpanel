/*
 * @package		mod_jpanel
 * @copyright	Copyright (C) 2012 Girolamo Tomaselli All rights reserved.
 * @email		girotomaselli@gmail.com
 * @website		http://bygiro.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

var $jp = jQuery.noConflict();
function openJpanel(jpanel_id){
	side = jpanel_id.split('_');
	
	switch(side[2]){
		case 'right':
			$jp(jpanel_id).stop(true, false).animate({
			   right: '0px'
			}, 900);	
		break;
		
		case 'left':
			$jp(jpanel_id).stop(true, false).animate({
			   left: '0px'
			}, 900);	
		break;
		
		case 'top':
			$jp(jpanel_id).stop(true, false).animate({
			   top: '0px'
			}, 900);	
		break;
		
		case 'bottom':
			$jp(jpanel_id).stop(true, false).animate({
			   bottom: '0px'
			}, 900);	
		break;
	}
	
	$jp(jpanel_id + ' .jpanelHandle').addClass('jpanel_open');
}

function closeJpanel(jpanel_id){
	side = jpanel_id.split('_');
	switch(side[2]){
		case 'right':
			$jp(jpanel_id).animate({
				right:  (($jp(jpanel_id + ' .jpanelContent').width() + 11) * -1)+'px'
			}, 800);	
		break;
		
		case 'left':
			$jp(jpanel_id).animate({
				left:  (($jp(jpanel_id + ' .jpanelContent').width() + 11) * -1)+'px'
			}, 800);	
		break;
		
		case 'top':
		   $jp(jpanel_id).animate({
				top: (($jp(jpanel_id + ' .jpanelContent').height() + 1) * -1)+'px'
			}, 800);	
		break;
		
		case 'bottom':
		   $jp(jpanel_id).animate({
				bottom: (($jp(jpanel_id + ' .jpanelContent').height() + 1) * -1)+'px'
			}, 800);	
		break;
	}

	$jp(jpanel_id + ' .jpanelHandle').removeClass('jpanel_open');	
}

function clickJpanel(jpanel_id){

    $jp(jpanel_id + ' .jpanelHandle').click(function() {
		if(!$jp(jpanel_id + ' .jpanelHandle').hasClass('jpanel_open')){
			
			/* open the panel */
			openJpanel(jpanel_id);
			
		} else {
				
			/* close the panel */
			closeJpanel(jpanel_id);
		}
    });		
}

function hoverJpanel(jpanel_id){
    $jp(jpanel_id + ' .jpanelHandle').hover(function() {
		/* open the panel */
        openJpanel(jpanel_id);
    }, function() {
        /* Do nothing */
    });

    $jp(jpanel_id).hover(function() {
        /* Do nothing */
    }, function() {

        /* close the panel */
		closeJpanel(jpanel_id);
    });	
}