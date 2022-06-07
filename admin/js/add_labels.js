

document.getElementById('addlabelbtn').addEventListener(
    'click', (e)=> {
        e.preventDefault();
        const datalabels= $("#labelform").serializeArray();

       const empty = datalabels.find(element => element['value'] == "");
       if (empty){
           alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
       }else{

        const data1=[];
        for (let i = 0; i < datalabels.length; i++) {
            const name = datalabels[i]['name'];
            const val = datalabels[i]['value'];
            data1.push([name,val]);
        }

        url ="admin_actions.php",
        $.ajax({
            type: "POST",
            url: url,
            data: {
                data : data1,
                action : 'addlabels',
            },
            success: function(data) {
                alert("Επιτυχή Προσθήκη Label")
                document.getElementById("labelform").reset();

            },

        });
       }




  
    }
);