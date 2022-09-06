var usernameAvailable = false;
var flagUsername =false
var flagPassword = false

// Check the username if exist
$("#supplierusername").keyup(function () {
    const usernameGiven = $("#supplierusername").val();
    flagUsername = false;
    if (usernameGiven.length > 3) {
        for (var cccounter = 0; cccounter < _notAvailableUsers.length; cccounter++) {
            if (_notAvailableUsers[cccounter] === usernameGiven) {
                flagUsername = true;
                break;
            }
        }
    } else {
        flagUsername = true;
    }
    if (flagUsername) {
        usernameAvailable = false;
        document.getElementById('messageError').classList.remove('displayNone');
        document.getElementById('messageSuccess').classList.add('displayNone');
    } else {
        usernameAvailable = true;
        document.getElementById('messageError').classList.add('displayNone');
        document.getElementById('messageSuccess').classList.remove('displayNone');
    }


})

// Check the password length above 8 char
$("#supplierpassword").keyup(function () {
    const passwordGiven = $("#supplierpassword").val();
    var passwordLength = passwordGiven.length
     flagPassword = false;

    if (passwordLength < 8) {
        flagPassword = true;
    } else {
        flagPassword = false;
    }
    if (flagPassword) {
        document.getElementById('messageError1').classList.remove('displayNone');
        document.getElementById('messageSuccess1').classList.add('displayNone');
    } else {
        document.getElementById('messageError1').classList.add('displayNone');
        document.getElementById('messageSuccess1').classList.remove('displayNone');
    }
    console.log(flagPassword)

})


$("#submitbtn").click(function(event){
    event.preventDefault();
    const formvalues = $("#supplierform").serializeArray();
    console.log(formvalues);

    const empty = formvalues.find(element => element['value'] == "");

    if (flagUsername ==false && flagUsername ==false  && !empty ){

        const data1 = [];
        for (let i = 0; i < formvalues.length; i++) {
            const name = formvalues[i]['name'];
            const val = formvalues[i]['value'];
            data1.push([name, val]);
        }

        url = "admin_actions.php",
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    data: data1,
                    action: 'createSupplier',
                },
                success: function (data) {
                    alert("Επιτυχή Προσθήκη Supplier");
                    alert(`Username: ${data1[2][1]}  Passwwword: ${data1[3][1]}`);
                    // document.getElementById("supplierform").reset();
                    window.location.reload();
                },

            });
    }else {
        alert("Ολα τα πεδία είναι υποχρεωτικά");
    }



});