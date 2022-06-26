var numberofchanges = 0;
var waitUntilImageUpload = false;
document.getElementById('addlocationbtn').addEventListener(
    'click', (e) => {
        e.preventDefault();
        addLocationInfos();
    }
);

function addLocationInfos() {
    const datalocations = $("#locationform").serializeArray();
    const numberofloc = datalocations.length / 2;

    // const data = {};
    // for (const aa in datalocations) {
    //     const {name, value} = datalocations[aa];

    //     data[`${name}`] = value;
    // }

    const empty = datalocations.find(element => element['value'] == "");
    if (empty) {
        alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
    } else {

        const data1 = [];
        for (let i = 0; i < datalocations.length; i += 2) {
            const name = datalocations[i]['name'];
            const nameval = datalocations[i]['value'];
            const description = datalocations[i + 1]['name'];
            const descriptionval = datalocations[i + 1]['value'];
            data1.push([name, nameval, description, descriptionval]);
        }

        url = "admin_actions.php",
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    data: data1,
                    action: 'addlocation',
                    numberoflocations: numberofloc
                },
                success: function (data) {
                    alert("Επιτυχή Προσθήκη Τοποθεσίας")
                    document.getElementById("locationform").reset();
                },

            });
    }

}



function uploadImageAsynchronous(event) {
    event.preventDefault();
    if (waitUntilImageUpload) {
        alert("Παρακαλώ περιμένετε να αναίβει η πρώτη φωτογραφία πρώτα");
        return;
    }
    waitUntilImageUpload = true;
    var fd = new FormData();
    var files = $('#file')[0].files;

    // Check file selected or not
    if (files.length > 0 ) {
        fd.append('file',files[0]);
        $.ajax({
            url: 'uploadlocationimages.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                waitUntilImageUpload = false;
                $('#file').val('');
                if (response != 0) {
                    numberofchanges ++;
                    if (numberofchanges == 1 ) {
                        alert('Η φωτογραφία ανέβηκε επιτυχώς! , Παρακαλώ ανεβάστε την Δευτερη φωτογραφία');
                    } else if  (numberofchanges == 2 ) {
                        alert('Ολες οι  φωτογραφίες ανέβηκαν επιτυχώς! ');
                        window.location = "index.php";
                    }

                } else {
                    alert('Κάτι πήγε λάθος κατά το ανέβασμα, προσπαθήστε ξανά!');
                }
            },
        });
    } else {
        alert("Παρακαλώ Επιλέξτε αρχείο.");
    }
}