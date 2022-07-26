var canUploadImage = true;
function addImage(event) {
    event.preventDefault();
    if (!canUploadImage) {
        alert("Παρακαλώ περιμένετε να ανέβει η προηγούμενη φωτογραφία");
    } else {
        var fd = new FormData();
        var files = $('#file')[0].files;

        // Check file selected or not
        if (files.length > 0 ) {
            canUploadImage = false;
            fd.append('file',files[0]);
            $.ajax({
                url: 'uploadImage.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    canUploadImage = true;
                    $('#file').val('');
                    if (response == 0) {
                        alert('Επιτυχής ενέργεια! Μπορείτε να συνεχίσετε');
                    } else {
                        alert(
                            'Κάτι πήγε λάθος κατά το ανέβασμα, προσπαθήστε ξανά!'
                            + `Λάθος που επιστράφηκε: ${response}`
                        );
                    }
                },
            });
        } else {
            alert("Παρακαλώ επιλέξτε ένα αρχείο");
        }

    }
}

function vendorCreationEnd(event) {
    event.preventDefault();
    const url = "admin_actions.php";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            action: 'finalizeVendor',
        },
        success: function () {
            alert("Επιτυχή Προσθήκη");
            window.location.href = '../backend/api/updatejson.php';
        },

    });
}