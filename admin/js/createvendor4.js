

document.getElementById('createbtn4').addEventListener(
    'click', (e) => {

        var flag = false;
        e.preventDefault();
        getImportantInfo();

        if (flag == true) {
            alert("Επιτυχή Προσθήκη  Προχωρήστε στο βήμα 5");
            window.location.href = 'createvendor_s5.php';
        }

    }
);



function getImportantInfo() {
    const numberOfImportants = document.getElementById('numhightlights').value;
    const arrayHead = [...document.querySelectorAll('.ImportantHead')].map((el) => { return el.value });
    const arrayDesc = [...document.querySelectorAll('.ImportantDesc')].map((el) => { return el.value });

    const objHead = {};
    const lengthLanguages = languagesinfos.length;
    for (var xxx = 0; xxx < arrayHead.length; xxx++) {
        const whichLanguage = xxx % lengthLanguages;
        const idLanguageResponses = languagesinfos[whichLanguage][0];
        const whichActivity = Math.floor(xxx / lengthLanguages) + 1;
        objHead[`${idLanguageResponses},${whichActivity}`] = arrayHead[xxx];
    }


    const objDescription = {};
    for (var xxx = 0; xxx < arrayDesc.length; xxx++) {
        const whichLanguage = xxx % lengthLanguages;
        const idLanguageResponses = languagesinfos[whichLanguage][0];
        const whichActivity = Math.floor(xxx / lengthLanguages) + 1;
        objDescription[`${idLanguageResponses},${whichActivity}`] = arrayDesc[xxx];
    }

    console.log(objHead);
    console.log(objDescription);



    url = "admin_actions.php"
    $.ajax({
        type: "POST",
        url: url,
        data: {
            headers: objHead,
            descriptions : objDescription,
            numberOfImportants: numberOfImportants,//must be declared
            action: 'addImportantInfo'
        },
        success: function (data) {
            alert("Θα μεταφερθείτε στο επόμενο βήμα!");
            window.location.href = 'createvendor_s5.php';

        },
        error: function (a,b,c) {
            alert('Something Went wrong');
        },

    });



}
