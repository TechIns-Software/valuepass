
var flag = true;
document.getElementById('createbtn5').addEventListener(
    'click', (e) => {
        e.preventDefault();

        const ajax1 = getRatedCategories();
        const ajax2 = getNames();
        $.when(ajax1, ajax2).done(function () {
            if (flag) {
                alert("Προχωρήστε στην εισαγωγή φωτογραφιών");
                window.location.href = 'addImagesVendor.php';
            }
        });

    }
);

function getNames(){

    const datavendor = $("#createvendor5").serializeArray();

    const empty = datavendor.find(element => element['value'] == "");
    if (empty) {
        alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
        flag = false;
    } else {

        const data1 = [];
        for (let i = 0; i < datavendor.length; i += 3) {
            const nameof = datavendor[i]['name'];
            const nameval = datavendor[i]['value'];
            const bigdesc = datavendor[i + 1]['value'];
            const fulldesc = datavendor[i + 2]['value'];
            data1.push([nameof,nameval, bigdesc,fulldesc]);
        }

        console.log(data1)

        return url = "admin_actions.php",
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    data: data1,
                    action: 'addVendorInfos'
                },
                success: function (data) {
                   
                },
                error: function (a,b,c) {
                    flag = false;
                }

            });

    }


}

function  getRatedCategories() {


    const datacategories = [...document.querySelectorAll('.ratedcat')].map((el) => { return [el.name,el.value] });
    // const datacategories = $("#rated").serializeArray();

    console.log(datacategories);
    const empty = datacategories.find(element => element[1] == "");
    if (empty) {
        alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
        flag = false;
    } else {


        url = "admin_actions.php"
        return $.ajax({
            type: "POST",
            url: url,
            data: {
                ratedcategories: datacategories,
                action: 'addRatedCategoryValues'
            },
            success: function (data) {
            },
            error: function (a,b,c) {
                flag = false;
            },

        });


    }




}