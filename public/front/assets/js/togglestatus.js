$('#toggle-status-link').on('click', function(e) {
    e.preventDefault();

    const currentStatus = $('#status-label').text().trim().toLowerCase();
    const confirmMessage = currentStatus === 'online'
        ? 'Are you sure you want to switch Offline?'
        : 'Are you sure you want to switch Online?';

    if (!confirm(confirmMessage)) return;

    $.ajax({
        url: '/toggle-status',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Make sure this meta tag exists
        },
        success: function(response) {
            const statusLabel = $('#status-label');
            const newStatus = response.status.charAt(0).toUpperCase() + response.status.slice(1);
            const newClass = response.status === 'online' ? 'text-success' : 'text-danger';

            statusLabel
                .text(newStatus)
                .removeClass('text-success text-danger')
                .addClass(newClass);

            $('#toggle-status-link').text('Switch ' + (response.status === 'online' ? 'Offline' : 'Online'));
        },
        error: function() {
            alert('Something went wrong while updating status.');
        }
    });
});
