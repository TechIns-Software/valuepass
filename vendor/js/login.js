document.getElementById('btnLogin').addEventListener(
    'click', (e)=> {
        e.preventDefault();
        const dataLogin = $("#loginForm").serializeArray();
        const data = {};

        const empty = dataLogin.find(element => element['value'] == "");
        if (empty) {
            alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
        }else {
            for (const aa in dataLogin) {
                const {name, value} = dataLogin[aa];
                data[`${name}`] = value;
            }

            url = "../admin/admin_actions.php",
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        data: data,
                        action: 'vendorLogin',
                    },
                    success: function (response) {

                        var jsonData = JSON.parse(response);

                        // user is logged in successfully in the back-end
                        // let's redirect
                        if (jsonData.success == "1")
                        {
                            alert("All good");
                            location.href = 'index.php';
                        }
                        else
                        {
                            alert("Wrong Credentials")
                        }


                    },

                });


        }




    }
);