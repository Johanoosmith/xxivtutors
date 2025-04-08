/*
Requirememnt : Use jQuery file before this.
*/

/*
Event-Tag :  data-km-event  / Default click
UpdateClass : km-modify-ajax 
Action-link : data-km-link html5 tag
ModifyContainer : data-km-result-box html5 tag
DeleteElement : data-km-delete-box html5 tag
For Click Event | Selectbox: Change
*/

(function($) { 
    
    "use strict";

    var ModifyContainer;
	var AjaxModify;
	var loading_image = "";
	let DisplayLoadingContainer;

 	AjaxModify = function(){
	
		jQuery('.km-modify-ajax').unbind().on("change click", function(e){
			e.preventDefault();
			
			if(jQuery(this).is('select') && e.type == 'click' )
			{ 
				return false;
			}		
			
			if (jQuery(this).is('[data-km-link]')) {
				/* Check Select box */
				if(e.type == 'change' )
				{
					var actionURL = jQuery(this).attr('data-km-link')+'/'+jQuery(this).val();	
				}
				else
				{
					var actionURL = jQuery(this).attr('data-km-link');	
				}
				
				var AjaxStatus = true;
			}
			else
			{
				var AjaxStatus = false;	
			}
			
			// For delete any element on delete/remove action
			if(jQuery(this).is('[data-km-delete-box]')) {
				DeleteContainer = jQuery(this).attr('data-km-delete-box');
			}
			else
			{
				ModifyContainer = null;
			}
			// For delete any element on delete/remove action
			
			
			if(jQuery(this).is('[data-km-result-box]')) {
				ModifyContainer = jQuery(this).attr('data-km-result-box');
				
				DisplayLoadingContainer = jQuery(this).attr('data-km-no-loading');
				
				if(DisplayLoadingContainer != true)
					jQuery('#'+ModifyContainer).html(loading_image);
			}
			else
			{
				ModifyContainer = null;
			}
			
			var DeleteContainer = typeof DeleteContainer == 'undefined' ? '' : DeleteContainer;
			
			if(AjaxStatus == true)
			{
				jQuery.ajax({
					type: 'GET',
					url: actionURL,
					success : function(data)
					{
						if(ModifyContainer != null)
						{
							jQuery('#'+ModifyContainer).html(data);
							AjaxModify();
						}
						
						if(DeleteContainer !=  '')
						{
							jQuery('#'+DeleteContainer).fadeOut('slow',function(){
								jQuery('#'+DeleteContainer).remove();	
							});
						}
						
					},
					error : function(data)
					{
	                    alert(JSON.stringify(data));
						alert('Sorry! There is some problem. please check function calling.')
					}
				});	
			}
			else
			{
				if(DeleteContainer !=  '')
				{
					jQuery('#'+DeleteContainer).fadeOut('slow',function(){
						jQuery('#'+DeleteContainer).remove();	
					});
				}	
			}
			
		
			return false;
		})
	}

	jQuery(document).ready(function(){ 
		AjaxModify();
	});

})(jQuery);