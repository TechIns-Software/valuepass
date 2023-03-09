//TODO: check better fields, like phone, email, ect
const continuebtn = document.getElementById("continue");

continuebtn.addEventListener('click', () => {
    event.preventDefault();
    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    if (fullname.trim() == "") {
        alert('Full name must be filled in');
    } else if (email.trim() == "") {
        alert('Email must be filled in');
    } else if (phone.trim() == "") {
        alert('Phone Number must be filled in');
    } else {

        if (fullname.trim().includes(' ') && fullname.length > 3) {
            alert('All Good');
            $('#clientForm').submit();
        } else {
            alert('You have to enter your Full Name');
        }

    }


})
