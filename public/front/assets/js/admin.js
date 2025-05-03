var handleGlobalSubmit = function () {
    jQuery(document).on('submit', 'form', function () {
        // Disable all submit buttons within the submitted form
        jQuery(this).find('button[type="submit"], input[type="submit"]').each(function () {
            jQuery(this).prop('disabled', true);
        });
    });
};

jQuery(document).ready(function () {
    handleGlobalSubmit();
});