(function ($) {
    "use strict";


	let ProTutor = (function () {
        
		var customCeil = function(num) {
			return num === Math.floor(num) ? num : Math.floor(num) + 1;
		}
		var getStudentRate = function(hourly_rate){
			let increment = (hourly_rate * STUDENT_RATE_PERCENT)/100;
			let student_price = parseFloat(hourly_rate) + parseFloat(increment);
			return customCeil(student_price);
		}
		
		var handleStudentRate = function () {
            jQuery(document).on('blur', '.dsc-hourly-rate', function(){
				var updateContainer	= jQuery(this).data('update-container');
				var hourly_rate	= jQuery(this).val();
				var student_rate= getStudentRate(hourly_rate); 

				jQuery('#HourlyRateBox').html(hourly_rate);
			
				if(jQuery(updateContainer).is('input')){
					jQuery(updateContainer).val(student_rate);
				}else{
					jQuery(updateContainer).html(student_rate);
				}
					
			});
        };
		
		var handleDatePicker = function(){
			jQuery('.date-picker').datepicker({
			  minDate: new Date(),
			  dateFormat:'dd/mm/yy',
			  altFormat: 'yy-mm-dd'
			});
			
			jQuery('.card-date').datepicker({
			  minDate: new Date(),
			  dateFormat:'mm/yy',
			  altFormat: 'mm/yy',
			  
			  changeMonth: true,
			  changeYear: true,
			  changeDay:false, 
			  beforeShow: function(input, inst) {
				$(inst.dpDiv).addClass("hide-days");
			 },
			 onClose: function(dateText, inst) {
				var month = $("#ui-datepicker-div .ui-datepicker-month option:selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year option:selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1)); // Set to first of the selected month
			 }
			  
			});
		}

        /* Functions Calling */
        return {
            load: function () {
                handleStudentRate();
				handleDatePicker();
            },
        };
    })();

    /* jQuery Window Load */
    jQuery(window).on("load", function () {
        ProTutor.load();
    });
})(jQuery);
