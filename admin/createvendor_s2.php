<?php
if (!isset($conn)) {
    include '../connection.php';
}

// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 1) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }



$title = "Δημιουργία Vendor | Step 2";
include_once "header.php";
include 'admin_library.php';


$languages = getAllLanguages($conn,true);

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
                        <label for="exampleInputPassword1" class="form-label">Αριθμός Πληροφοριων Δραστηριότηας (About Activity bullets)</label>
                        <input type="number" class="form-control" id="numactivities" placeholder="Εισάγετε των αριθμό των δραστηριοτήτων">
                        <button class="btn btn-info my-3" id="genereteinputs">Δημιουργία</button>
                    </div>


                    <div class=" col-lg-12 col-md-12  my-3" id="geninpt"> </div>


                </div>
                <a class="btn btn-danger p-2 my-3" id="createbtn2" href="createvendor_s3.php">Επόμενο Βήμα</a>
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


    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/createvendor2.js"></script>
    <?php

    include_once "footer.php";

    ?>