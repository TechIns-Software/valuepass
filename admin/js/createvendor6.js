      /// IMPORTANT  THIS ARRAY MUST BE SAME IN PHP FILE !!!!!!!!
const weekdays = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
   /// IMPORTANT  THIS ARRAY MUST BE SAME IN PHP FILE !!!!!!!!
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
        message += input ;
    }

    $(`#${day[0]}_res`).empty();
    $(`#${day[0]}_res`).append(message );
}


function getData(){
var data ={};
    
const timeInputs = document.querySelectorAll('input[type="time"]');



timeInputs.forEach((element,index)  => {
    const nameOfEl = element.id;
    const valOf = element.value;
    const day = nameOfEl.split("_");
  
     data[`${day[0]}_${index}`] = valOf;
    
});

console.log(data)

}