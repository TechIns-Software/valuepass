//TODO: check better fields, like phone, email, ect
const continuebtn = document.getElementById("continue");

continuebtn.addEventListener('click', () => {
    event.preventDefault();
    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    // const emailmarketingbox = document.getElementById('emailmarketing').checked;

    var regexp = /[a-zA-Z]+\s+[a-zA-Z]+/g;
    if (regexp.test(fullname)) {
        if (fullname == "" || email == '') {
            alert('Full name and email must be filled in');
        } else {
            $('#clientForm').submit();
        }
    } else {
        alert('You have to enter your Full Name');
    }


})
