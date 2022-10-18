
const update_btn = document.getElementById('updatebtn');

update_btn.addEventListener('click',()=>{

    url = "../admin/custom_update.php"
    $.ajax({
        type: "POST",
        url: url,
        data: {
            text: 'update',
        },
        success: function (data) {
            if (data[2]) {
                alert("Επιτυχή Ενημέρωση.");
            } else {
                alert("Κάτι πήγε λάθος στην Ενημέρωση");
            }

        },

    });

})
