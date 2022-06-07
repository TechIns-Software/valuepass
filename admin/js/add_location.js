

document.getElementById('addlocationbtn').addEventListener(
    'click', (e)=> {
        e.preventDefault();
        const datalocations = $("#locationform").serializeArray();
        const  numberofloc =  datalocations.length/ 2;

        // const data = {};
        // for (const aa in datalocations) {
        //     const {name, value} = datalocations[aa];
      
        //     data[`${name}`] = value;
        // }

       const empty = datalocations.find(element => element['value'] == "");
       if (!empty){
           alert("Πρέπει να συμπληρώσεις όλα τα πεδία");
       }else{

        const data1=[];
        for (let i = 0; i <datalocations.length; i+=2) {
            const name = datalocations[i]['name'];
            const nameval = datalocations[i]['value'];
            const description = datalocations[i+1]['name'];
            const descriptionval= datalocations[i+1]['value'];
            data1.push([name,nameval,description,descriptionval]);
        }

        url ="admin_actions.php",
        $.ajax({
            type: "POST",
            url: url,
            data: {
                data : data1,
                action : 'addlocation',
                numberoflocations : numberofloc
            }

        });
       }




  
    }
);