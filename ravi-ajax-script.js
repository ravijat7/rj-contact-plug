// ravi-ajax-script.js

document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            const entryId = this.getAttribute('data-id');

            // AJAX request to delete entry
            const xhr = new XMLHttpRequest();
            xhr.open('POST', ajax_object.ajax_url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Reload the page after successful deletion
                    location.reload();
                }
            };

            // Send the AJAX request
            xhr.send('action=ravi_delete_entry&entry_id=' + entryId);
        });
    });
});