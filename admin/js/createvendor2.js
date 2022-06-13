

document.getElementById('createbtn2').addEventListener(
    'click', (e) => {
        e.preventDefault();
        const numberOfActivities = document.getElementById('numactivities').value;
        const arrayHead = [...document.querySelectorAll('.headAcivity')].map((el) => { return el.value });
        const arrayDescription = [...document.querySelectorAll('.descriptionAcivity')].map((el) => { return el.value });
        const objHead = {};
        const lengthLanguages = languagesinfos.length;
        for (var xxx = 0; xxx < arrayHead.length; xxx++) {
            const whichLanguage = xxx % lengthLanguages;
            const idLanguageResponses = languagesinfos[whichLanguage][0];
            const whichActivity = Math.floor(xxx / lengthLanguages) + 1;
            objHead[`${idLanguageResponses},${whichActivity}`] = arrayHead[xxx];
        }

        const objDescription = {};
        for (var xxx = 0; xxx < arrayDescription.length; xxx++) {
            const whichLanguage = xxx % lengthLanguages;
            const idLanguageResponses = languagesinfos[whichLanguage][0];
            const whichActivity = Math.floor(xxx / lengthLanguages) + 1;
            objDescription[`${idLanguageResponses},${whichActivity}`] = arrayDescription[xxx];
        }

        console.log(objDescription);
        console.log(objHead);
        url = "admin_actions.php"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                headers: objHead,
                description: objDescription,
                numberofact: numberOfActivities,//must be declared
                action: 'addActivities'
            },
            success: function (data) {

                alert("Επιτυχή Προσθήκη  Προχωρήστε στο βήμα 3");
                window.location.href = 'createvendor_s3.php';
            },

        });



    }
);