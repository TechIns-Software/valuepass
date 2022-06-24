
var flag = true;
document.getElementById('createbtn3').addEventListener(
    'click', (e) => {

        flag = true;
        e.preventDefault();
        const ajax1 = insertHighlights();
        const ajax2 = insertIncludes();
        const ajax3 =insertlabels();
        $.when(ajax1, ajax2, ajax3).done(function () {
            if (flag) {
                alert("Επιτυχή Προσθήκη  Προχωρήστε στο βήμα 4");
                window.location.href = 'createvendor_s4.php';
            }
        });


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
    return $.ajax({
        type: "POST",
        url: url,
        data: {
            headers: objHead,
            numhightlights: numhightlights,//must be declared
            action: 'addHighlights'
        },
        success: function (data) {

        },
        error: function (a,b,c) {
            flag = false;
        },

    });

}


function insertIncludes() {

    var includedInputs =   $("input.includeserv:checkbox:checked")
    var selected = [];

    selected = Array.from(includedInputs).map(x => x.value)
    console.log(selected, "ghjkl");
    if (selected.length == 0) {
        alert("Δεν επιλέξατε Included Services! ");
        flag = false;

    } else {

        url = "admin_actions.php"
        return $.ajax({
            type: "POST",
            url: url,
            data: {
                selectedincludes: selected,
                action: 'addIncludesService'
            },
            success: function (data) {

            },
            error: function (a,b,c) {
                flag = false;
            },

        });

    }


}


function insertlabels() {

    var labelsinputs= $("input.labels:checkbox:checked")
    var selectedlabels = [];

    selectedlabels = Array.from(labelsinputs).map(x => x.value); 


    if (selectedlabels.length == 0) {
        alert("Δεν επιλέξατε Labels -  ");
        flag = false;
    } else {

        url = "admin_actions.php"
        return $.ajax({
            type: "POST",
            url: url,
            data: {
                selectedlabels: selectedlabels,
                action: 'addSelectedlabels'
            },
            success: function (data) {

            },
            error: function (a,b,c) {
                flag = false;
            },

        });

    }


}