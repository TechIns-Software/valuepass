

document.getElementById('createbtn2').addEventListener(
    'click', (e)=> {
        e.preventDefault();
        
        const datastep2 = $("#activitiesform").serializeArray();

      

       const empty = datastep2.find(element => element['value'] == "");
       if (empty){
           alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
       }else{

    
        const data1=[];
        const rightdata =[];
        for (let i = 0; i < datastep2.length; i+=2) {

            const name = datastep2[i]['name'];
            const nameval = datastep2[i]['value'];
            const description = datastep2[i+1]['name'];
            const descriptionval= datastep2[i+1]['value'];

            data1.push([name,nameval,description,descriptionval]);
        }

      console.log(data1);


        url ="admin_actions.php"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                data : data1,
                numberofact : numberofActivities,
                action : 'addActivities',
            },
            success: function(data) {
                
                alert("Επιτυχή Προσθήκη  Προχωρήστε στο βήμα 3");
                // window.location.href = 'createvendor_s3.php';
            },

        });

       }




  
    }
);