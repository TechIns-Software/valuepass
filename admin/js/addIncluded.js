

document.getElementById('addIncludedBtn').addEventListener(
    'click', (e) => {
        e.preventDefault();
        const datalabels = $("#labelform").serializeArray();

        const empty = datalabels.find(element => element['value'] == "");
        if (empty) {
            alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
        } else {

            const data1 = [];
            for (let i = 0; i < datalabels.length; i++) {
                const name = datalabels[i]['name'];
                const val = datalabels[i]['value'];
                data1.push([name, val]);
            }

            const checkedIcon = document.getElementById('iconOption').checked ? 1: 0;
            url = "admin_actions.php",
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        data: data1,
                        icon: checkedIcon,
                        action: 'addIncluded',
                    },
                    success: function (data) {
                        alert("Επιτυχή Προσθήκη Included")
                        document.getElementById("labelform").reset();

                    },

                });
        }





    }
);