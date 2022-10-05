const continuebtn = document.getElementById("continue");

continuebtn.addEventListener('click', () => {
    event.preventDefault();
    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const termscheckbox = document.getElementById('terms').checked;
    const emailmarketingbox = document.getElementById('emailmarketing').checked;

    var regexp = /[a-zA-Z]+\s+[a-zA-Z]+/g;
    if (regexp.test(fullname)) {
        if (fullname == "" || email == '') {
            alert('Full name and email must be filled in');
        } else {
            if (!termscheckbox) {
                alert('You have to agree to the terms and conditions in order to continue');
            } else {
                $('#clientForm').submit()
            }
        }
    } else {
        alert('You have to enter your Full Name');
    }


})
