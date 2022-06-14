

document.getElementById('categoryaddbtn').addEventListener(
    'click', (e) => {
        e.preventDefault();
        const datacategories = $("#categoryform").serializeArray();

        const empty = datacategories.find(element => element['value'] == "");
        if (empty) {
            alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
        } else {

            const data1 = [];
            for (let i = 0; i < datacategories.length; i++) {
                const name = datacategories[i]['name'];
                const val = datacategories[i]['value'];
                data1.push([name, val]);
            }

            url = "admin_actions.php",
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        data: data1,
                        action: 'addRatedCategory',
                    },
                    success: function (data) {
                        alert("Επιτυχή Προσθήκη Rated  Κατηγορίας")
                        document.getElementById("categoryform").reset();

                    },

                });
        }





    }
);