

document.getElementById('createbtn3').addEventListener(
    'click', (e) => {

        var flag = false;
        e.preventDefault();
        insertHighlights();
        insertIncludes();
        insertlabels() ;

        if (flag == true) {
            alert("Επιτυχή Προσθήκη  Προχωρήστε στο βήμα 4");
            window.location.href = 'createvendor_s4.php';
        }

    }
);


function insertHighlights() {

    const numhightlights = document.getElementById('numhightlights').value;
    const arrayHead = [...document.querySelectorAll('.highlightname')].map((el) => { return el.value });

    const objHead = {};
    const lengthLanguages = languagesinfos.length;
    for (var xxx = 0; xxx < arrayHead.length; xxx++) {
        const whichLanguage = xxx % lengthLanguages;
        const idLanguageResponses = languagesinfos[whichLanguage][0];
        const whichActivity = Math.floor(xxx / lengthLanguages) + 1;
        objHead[`${idLanguageResponses},${whichActivity}`] = arrayHead[xxx];
    }

    console.log(objHead);
    url = "admin_actions.php"
    $.ajax({
        type: "POST",
        url: url,
        data: {
            headers: objHead,
            numhightlights: numhightlights,//must be declared
            action: 'addHighlights'
        },
        success: function (data) {

        },

    });

}


function insertIncludes() {

    var includedInputs =   $("input.includeserv:checkbox:checked")
    var selected = [];

    selected = Array.from(includedInputs).map(x => x.value)

    if (selected.length == 0) {
        alert("Πρέπει να επιλέξεις τουλάχιστον ένα ");

    } else {

        url = "admin_actions.php"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                selectedincludes: selected,
                action: 'addIncludesService'
            },
            success: function (data) {
              
            },

        });

    }


}


function insertlabels() {

    var labelsinputs= $("input.labels:checkbox:checked")
    var selectedlabels = [];

    selectedlabels = Array.from(labelsinputs).map(x => x.value); 


    if (selectedlabels.length == 0) {
        alert("Πρέπει να επιλέξεις τουλάχιστον ένα Label ");

    } else {

        url = "admin_actions.php"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                selectedlabels: selectedlabels,
                action: 'addSelectedlabels'
            },
            success: function (data) {
                flag = true
            },

        });

    }


}