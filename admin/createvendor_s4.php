<?php
if (!isset($conn)) {
    include '../connection.php';
}


// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 3) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }
session_start();



$title = "Δημιουργία Vendor | Step  4";
include_once "header.php";
include 'admin_library.php';

$languages = getAllLanguages($conn);

?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 loc_title">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : 4</h5>
            </div>
            <form id="createvendor1" class="form  container-fluid">
                <div class="row">


                    <div class=" col-lg-12 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label"> Αριθμός Σημαντικών Πληροφοριών ( Important Informations )</label>
                        <input type="number" class="form-control" id="numhightlights">
                        <button class="btn btn-info my-3" id="genereteinputs">Δημιουργία </button>
                    </div>

                    <div class="col-lg-12 col-md-12  my-3">
                        <div id="geninpt"></div>
                    </div>

                </div>
    
                <a class="btn btn-danger p-2 my-3" id="createbtn4" href="createvendor_s5.php">Επόμενο Βήμα</a>
            </form>

        </div>
    </div>


    <script>
        var numberofActivities
        var languagesinfos = JSON.parse(`<?php echo json_encode($languages) ?>`);

        document.getElementById('genereteinputs').addEventListener(
            'click', (e) => {
                e.preventDefault();

                numberofInfos = $("#numhightlights").val();
                console.log("im in")

                if (numberofInfos == 0) {
                    alert("Πρέπει να δημιουργήσεις τουλάχστον ένα Important Information");
                }
                drawTable();
            }
        );


        function drawTable() {
            var headStringForm = '<form id="highlightsform container-fluid" >';
            headStringForm += ' <div class="row">';
            var rows = "";

            var bodyForm = "";
            for (var index = 1; index <= numberofInfos; index++) {

                rows += "<div class='col-lg-6 col-md-12 my-3'> <h4> Important Information  : " + index + " </h4>";
                languagesinfos.forEach(element => {

                    inputheadername = `ImportantHead ${element[0]} - ${index}`;
                    placeholderheader = `ImportantHead`;

                    inputdescription = `Description${element[0]} - ${index}`;
                    placeholderdescription = 'Bullet1,Bullet2,Bullet3,Bullet4';


                    rows += `<div class='my-3' > <h6> ${element[1]} </h6>`;
                    rows += `<input type='text' class='form-control my-2 ImportantHead' id=${inputheadername}  name=${inputheadername} placeholder=${placeholderheader}>`;
                    rows += `<input type='text' class='form-control my-2 ImportantDesc' id=${inputdescription}  name=${inputdescription} placeholder=${placeholderdescription}>`;
                    rows += "</div>";

                });
                rows += "</div>"
            }
            bodyForm += rows + '</div></form>';
            $("#geninpt").empty();
            $("#geninpt").append(headStringForm + bodyForm);


        }
    </script>

    <script src="js/createvendor4.js"></script>



    <?php

    include_once "footer.php";

    ?>