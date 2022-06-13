

document.getElementById('createbtn1').addEventListener(
    'click', (e) => {
        e.preventDefault();
        const datastep1 = $("#createvendor1").serializeArray();

        const empty = datastep1.find(element => element['value'] == "");
        if (empty) {
            alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
        } else {

            const data1 = [];
            for (let i = 0; i < datastep1.length; i++) {
                const val = datastep1[i]['value'];
                data1.push(val);
            }

            console.log(data1);

            url = "admin_actions.php",
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        data: data1,
                        action: 'addVendor1',
                    },
                    success: function (data) {

                        alert("Επιτυχή Προσθήκη  Προχωρήστε στο βήμα 2");
                        window.location.href = 'createvendor_s2.php';
                    },

                });

        }





    }
);