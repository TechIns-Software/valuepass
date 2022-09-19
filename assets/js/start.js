const continuebtn = document.getElementById("continue");

continuebtn.addEventListener('click', () => {

    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const termscheckbox = document.getElementById('terms').checked;
    const emailmarketingbox = document.getElementById('emailmarketing').checked;


    if (fullname == "" && email == '' && termscheckbox == false) {
        alert('Ολα τα πεδία είναι υποχρεωτικά');
    }else {
        if (!termscheckbox ){
            alert('Πρέπει να αποδεχτείς του όρους χρήσης για να συνεχίσεις');
        }else {

        }
    }


})
