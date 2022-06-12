
// First we generate inputs for each language and then we take - get the values 


document.getElementById('genereteinputs').addEventListener(
    'click', (e)=> {
        e.preventDefault();

        const numberofActivities = $("#numactivities").val();
        const languagesinfos =   JSON.parse(`<?php echo json_encode($drasthriothtaValues) ?>`) ;
        
        if (numberofActivities == 0){
            alert ("Πρέπει να δημιουργήσεις τουλάχστον ένα activity");
        }
        console.log(languagesinfos);
        
 

       }


);