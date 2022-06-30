/// IMPORTANT  THIS ARRAY MUST BE SAME IN PHP FILE !!!!!!!!
var weekdays = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

const selectInput = document.getElementById("type");


selectInput.addEventListener("click", () => {

    if (selectInput.value == 1) {
        $("#option1").removeClass('dissapear');
        $("#option2").addClass('dissapear');
    } else {
        $("#option2").removeClass('dissapear');
        $("#option1").addClass('dissapear');
    }
})

const numbervouchersInputs = document.querySelectorAll(".numbervoucher");
console.log(numbervouchersInputs)

numbervouchersInputs.forEach(element => {
    const id = element.id;
    element.addEventListener('focusout', createDateInputs.bind(id))
});

function createDateInputs(id) {
    const elementid = (id.target.id);
    const day = (id.target.id).split("_");

    const valueOfVouchers = $(`#${elementid}`).val();
    console.log(valueOfVouchers)
    var message = "";
    var input = "";
    for (let index = 0; index < valueOfVouchers; index++) {
        input = `  <input type='time' class='form-control my-2' id='${day[0]}_${index}'> `;
        message += input;
    }

    $(`#${day[0]}_res`).empty();
    $(`#${day[0]}_res`).append(message);
}


function sendData() {
    var data = {};
    var type = "";

    if (selectInput.value == 1) {
        const timeInputs = document.querySelectorAll('input[type="time"]');
        timeInputs.forEach((element, index) => {
            const nameOfEl = element.id;
            const valOf = element.value;
            const day = nameOfEl.split("_");

            data[`${day[0]}_${index}`] = valOf;

        });

        type = "allWeek";
    } else {
        const howVouchers = document.getElementById("fixedVoucher").value;


        weekdays.forEach(element => {

            for (let index = 1; index <= howVouchers; index++) {
                data[`${element}_${index}`] = "01:01:01";
            }
        });

        type = "oneDay";
    }

    url = "admin_actions.php"
    $.ajax({
        type: "POST",
        url: url,
        data: {
            voucherules: data,
            type: type,
            action: 'addVoucherRules'
        },
        success: function (data) {
            alert("Ολα καλά. Μεταφορά στην αρχή");
            window.location.href = 'index.php';

        },
        error: function (a, b, c) {
            alert('Something Went wrong');
        },

    });



}





