<?php
if (!isset($conn)) {
    include '../connection.php';
}


// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 2) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }






$title = "Δημιουργία Vendor | Step 3 ";
include_once "header.php";
include 'admin_library.php';

$languages = getAllLanguages($conn,true);

$includedServices = getAllIncludeServices($conn);
$labels = getAllLabels($conn);

?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 loc_title">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : 3 </h5>
            </div>
            <form id="createvendor1" class="form border container">
                <div class="row">


                    <div class=" col-lg-12 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Αριθμός HightLights Δραστηριότητας </label>
                        <input type="number" class="form-control" id="numhightlights">
                        <button class="btn btn-info my-3" id="genereteinputs">Δημιουργία</button>
                    </div>


                    <div class=" col-lg-8 col-md-12  my-3" id="geninpt"></div>


                    <div class=" col-lg-6 col-md-12  my-3">
                        <h5 for="exampleInputPassword1" class="form-label">Επιλέξτε τα Includes για το Experience <br> <small> (Μπορείτε περισσότερα απο ένα) </small> </h5>


                        <?php

                        foreach ($includedServices as $includedService) {  ?>

                            <div class="form-check">
                                <input class="form-check-input includeserv" type="checkbox" value="<?php echo  $includedService[0] ?>" id="<?php echo  $includedService[0] ?>">
                                <label class="form-check-label" for="includeserv<?php echo  $includedService[0] ?>">
                                    <?php echo  $includedService[1] ?>
                                </label>
                            </div>
                        <?php  } ?>


                    </div>




                    <div class=" col-lg-6 col-md-12  my-3">
                        <h5 for="exampleInputPassword1" class="form-label">Επιλέξτε τα labels που θέλετε για το Experience <br> <small> (Μπορείτε περισσότερα απο ένα) </small> </h5>


                        <?php

                        foreach ($labels as $label) {  ?>

                            <div class="form-check">
                                <input class="form-check-input labels" type="checkbox" value="<?php echo  $label[0] ?>" id="<?php echo  $label[0] ?>">
                                <label class="form-check-label" for="includeserv<?php echo  $label[0] ?>">
                                    <?php echo  $label[1] ?>
                                </label>
                            </div>
                        <?php  } ?>

                    </div>
                </div>
                <a class="btn btn-danger p-2 my-3" id="createbtn3" href="createvendor_s4.php">Επόμενο Βήμα</a>
            </form>

        </div>
    </div>

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



    <script>
        var numberofActivities
        var languagesinfos = JSON.parse(`<?php echo json_encode($languages) ?>`);

        document.getElementById('genereteinputs').addEventListener(
            'click', (e) => {
                e.preventDefault();

                numberofActivities = $("#numhightlights").val();

                if (numberofActivities == 0) {
                    alert("Πρέπει να δημιουργήσεις τουλάχστον ένα Highlight");
                }
                drawTable();

            }

        );


        function drawTable() {
            var headStringForm = '<form id="highlightsform container-fluid" >';
            headStringForm += ' <div class="row">';
            var rows = "";

            var bodyForm = "";
            for (var index = 1; index <= numberofActivities; index++) {

                rows += "<div class='col-lg-6 col-md-12 my-3'> <h4> Highlight  : " + index + " </h4>";
                languagesinfos.forEach(element => {

                    inputheadername = `hightlight  ${element[0]} - ${index}`;
                    placeholdername = `HightLight ${element[1]}`;

                    rows += `<div class='my-3' > <h6> ${element[1]} </h6>`;
                    rows += `<input type='text' class='form-control my-2 highlightname' id=${inputheadername}  name=${inputheadername} placeholder=${placeholdername}>`;
                    rows += "</div>";

                });
                rows += "</div>"


            }

            bodyForm += rows + '</div></form>';
            $("#geninpt").empty();
            $("#geninpt").append(headStringForm + bodyForm);


        }
    </script>




    <script src="js/createvendor3.js"></script>

    <?php

    include_once "footer.php";

    ?>