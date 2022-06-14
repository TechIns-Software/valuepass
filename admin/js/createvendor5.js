

document.getElementById('createbtn5').addEventListener(
    'click', (e) => {
        e.preventDefault();

        var flag = false;
        getRatedCategories();
        getNames();
        
        if (flag == true ){
            alert("Η Εισαγωγή Vendor Ολοκληρώθηκε ");
        }


    }
);

function getNames(){

    const datavendor = $("#createvendor5").serializeArray();

    const empty = datavendor.find(element => element['value'] == "");
    if (empty) {
        alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
    } else {

        const data1 = [];
        for (let i = 0; i < datavendor.length; i += 4) {
            const nameof = datavendor[i]['name'];
            const nameval = datavendor[i]['value'];
            const smalldesc = datavendor[i + 1]['value'];
            const bigdesc = datavendor[i + 2]['value'];
            const fulldesc = datavendor[i + 3]['value'];
            data1.push([nameof,nameval, smalldesc, bigdesc,fulldesc]);
        }

        console.log(data1)

        url = "admin_actions.php",
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    data: data1,
                    action: 'addVendorInfos'
                },
                success: function (data) {
                    alert("Επιτυχή Προσθήκη Vendor")
                   
                },

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
    } else {


        url = "admin_actions.php"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                ratedcategories: datacategories,
                action: 'addRatedCategoryValues'
            },
            success: function (data) {
                flag = true
            },

        });


    }




}