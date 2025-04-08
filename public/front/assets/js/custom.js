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
				altFormat: 'dd/mm/yy',
				onSelect: function (date, datepicker) { 
					if (date != "") { 
						//alert("Selected Date: " + date); 
					} 
					console.log('on-select');
				} 
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
		
		var handleValidation = function(){
			
			
			jQuery(document).on('input', '.numeric', function (e) {
				var value = $(this).val().replace(/\D/g, ""); // Remove non-numeric characters
				$(this).val(value);
			});
			
			jQuery('#expiry_date').on('input', function (e) {
				var value = $(this).val().replace(/\D/g, ""); // Remove non-numeric characters

				// Ensure MM is between 01 and 12
				if (value.length >= 2) {
					let month = parseInt(value.substring(0, 2), 10);
					if (month < 1 || month > 12) {
						value = "0"; // Reset if invalid month
					}
				}

				if (value.length > 2) {
					value = value.substring(0, 2) + "/" + value.substring(2, 4); // Auto add "/"
				}

				$(this).val(value);
			});

			jQuery('#expiry_date').on('blur', function () {
				var value = $(this).val();
				var regex = /^(0[1-9]|1[0-2])\/\d{2}$/; // MM/YY format check

				if (!regex.test(value)) {
					alert("Invalid expiry date. Please enter in MM/YY format.");
					$(this).val("");
					return;
				}

				// Get current month and year
				var currentDate = new Date();
				var currentMonth = currentDate.getMonth() + 1; // JavaScript months are 0-indexed
				var currentYear = currentDate.getFullYear() % 100; // Get last 2 digits of year

				// Extract entered MM and YY
				var parts = value.split("/");
				var enteredMonth = parseInt(parts[0], 10);
				var enteredYear = parseInt(parts[1], 10);

				// Expiry validation: Should not be in the past
				if (enteredYear < currentYear || (enteredYear === currentYear && enteredMonth < currentMonth)) {
					alert("Card expiry date cannot be in the past.");
					$(this).val("");
				}
			});
		}

        /* Functions Calling */
        return {
            load: function () {
                handleStudentRate();
				handleDatePicker();
				handleValidation();
            },
        };
    })();

    /* jQuery Window Load */
    jQuery(window).on("load", function () {
        ProTutor.load();
    });
})(jQuery);
