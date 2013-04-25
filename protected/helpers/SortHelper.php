<?php
/**
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class SortHelper{

	static function ui($id,$url){
 	 	 core_script('jquery.ui');  
 	 	 write_script(
			'hepler_ui_sort'.$id, 
		 	 	" 
				var   node_form_sort;
				var fixHelper = function(e, ui) {
			        ui.children().each(function() {
			            $(this).width($(this).width());                  
			        });
			        return ui;
			    };
		 	 	$( '".$id." tbody' ).sortable({
				helper: fixHelper,
				start:function(e, ui){  
					node_form_sort=$('".$id."').serialize(); 
		            ui.helper.addClass('highlight');
		            ui.helper.find('td').css({'width':ui.helper.find('td').attr('width')});  
		            return ui;  
		        },  
		        stop:function(e, ui){   
		           ui.item.removeClass('highlight');  
		           if($('".$id."').serialize() == node_form_sort ) return false; 
		           $.post('".$url."',  $('".$id."').serialize(),function(data) {
					 	
					});
		           return ui;  
		        }  	
			}).sortable('serialize'); ");
 	 }
}