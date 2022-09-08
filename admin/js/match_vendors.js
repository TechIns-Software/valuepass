

const submitvendorsbtn = document.getElementById("submitvendors");


submitvendorsbtn.addEventListener('click', () => {

    var supplier_id = $('#supplierid').val();

    var experienceInputs = $("input.idexper:checkbox:checked")
    var selectedvendors = [];
    selectedvendors = Array.from(experienceInputs).map(x => x.value);
    console.log(supplier_id);

    if (selectedvendors.length<1){
        selectedvendors = [''];
    }


    url = "admin_actions.php"
    $.ajax({
        type: "POST",
        url: url,
        data: {
            vendordata :  selectedvendors,
            supplier : supplier_id,
            action: 'supplierVendor'
        },
        success: function (data) {
            alert("Επιτυχή Αντιστοίχηση Supplier Vendor. ");
            window.location.href = `match_vendors.php?id=${supplier_id}`;
        },

    });

})