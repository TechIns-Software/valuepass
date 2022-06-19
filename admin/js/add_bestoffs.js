
const submitbestoffbtn = document.getElementById("submitbestoffs");


submitbestoffbtn.addEventListener('click', () =>{

    console.log("im in bro!");
    const location_id = $("#locationId").val();

    var experienceInputs= $("input.idexper:checkbox:checked")
    var selectedexperiences = [];

    selectedexperiences = Array.from(experienceInputs).map(x => x.value); 

    console.log(selectedexperiences);


    url = "admin_actions.php"
    $.ajax({
        type: "POST",
        url: url,
        data: {
            bestofdata :  selectedexperiences,
            location_id : location_id,
            action: 'addBestoffs'
        },
        success: function (data) {
            alert("Επιτυχή Προσθήκη  Best off ");
            window.location.href = 'bestoffs.php';
        },

    });



})
