<?php
if (!isset($conn)) {
    include '../connection.php';
}

if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 1) {
    header("createvendor_s1.php");
} else {
    $_SESSION['vendorcreatestep']++;
}


$_SESSION['vendorcreateid'] = 12;

$title = "Δημιουργία Vendor | Step 2";
include_once "header.php";
include 'admin_library.php';


$languages = getAllLanguages($conn);

$vendorid = 0;
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 loc_title">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : 2 </h5>
            </div>
            <form id="createvendor1" class="form border container">
                <div class="row">

                    <div class=" col-lg-12 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Number of About Activity headers</label>
                        <input type="number" class="form-control" id="numactivities">
                        <button class="btn btn-info my-3" id="genereteinputs">Generate</button>
                    </div>


                    <div class=" col-lg-12 col-md-12  my-3" id="geninpt"> </div>


                </div>
                <a class="btn btn-danger p-2 my-3" id="createbtn2" href="createvendor_s3.php">Next Step</a>
            </form>

        </div>
    </div>





    <script>
        var numberofActivities
        var languagesinfos = JSON.parse(`<?php echo json_encode($languages) ?>`);

        document.getElementById('genereteinputs').addEventListener(
            'click', (e) => {
                e.preventDefault();

                numberofActivities = $("#numactivities").val();

                if (numberofActivities == 0) {
                    alert("Πρέπει να δημιουργήσεις τουλάχστον ένα activity");
                }


                drawTable();


            }

        );


        function drawTable() {
            var headStringForm = '<form id="activitiesform" >';
            var rows = "";

            var bodyForm = "";
            for (var index = 1; index <= numberofActivities; index++) {

                rows += "<div class='my-3'> <h4>Αctivity " + index + " </h4>";
                languagesinfos.forEach(element => {


                    inputheadername = "header" + element[0] + "_" + index;
                    placeholdername = " Όνομα " + `${element[1]}` + "Activity ";
                    inputdescriptionname = "description" + element[0] + "_" + index;
                    placeholderdescription = " Περιγραφή " + `${element[1]}` + "Activity ";


                    rows += "<div class='my-3' > <h6> " + element[1] + " </h6>";
                    rows += "<input type='text' class='form-control my-2 headAcivity' id=" + inputheadername + "  name= " + inputheadername + " placeholder=" + placeholdername + ">"
                    rows += "<input type='text' class='form-control my-2 descriptionAcivity' id=" + inputdescriptionname + "  name= " + inputdescriptionname + " placeholder=" + placeholderdescription + ">"
                    rows += "</div>"

                });
                rows += "</div>"


            }

            bodyForm += rows + '</form>';
            $("#geninpt").empty();
            $("#geninpt").append(headStringForm + bodyForm);


        }
    </script>


    <script src="js/createvendor2.js"></script>
    <?php

    include_once "footer.php";

    ?>