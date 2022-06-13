<?php
if (!isset($conn)) {
    include '../connection.php';
}


// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 2) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }


$_SESSION['vendorcreateid'] = 12;


$_SESSION['step'] = 3;
$title = "Δημιουργία Vendor | Step " . $_SESSION['step'];
include_once "header.php";
include 'admin_library.php';

$languages = getAllLanguages($conn);

$includedServices = getAllIncludeServices($conn);

$vendorid = 0;
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 loc_title">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : <?php echo $_SESSION['step'];  ?> </h5>
            </div>
            <form id="createvendor1" class="form border container">
                <div class="row">


                    <div class=" col-lg-12 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Number of HightLights </label>
                        <input type="number" class="form-control" id="numhightlights">
                        <button class="btn btn-info my-3" id="genereteinputs">Generate</button>
                    </div>


                    <div class=" col-lg-8 col-md-12  my-3" id="geninpt"></div>


                    <div class=" col-lg-12 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Check what Includes in this Exprience</label>


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



                </div>
                <a class="btn btn-danger p-2 my-3" id="createbtn3" href="createvendor_s4.php">Next Step</a>
            </form>

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


    <script src="js/createvendors3.js"></script>

    <?php

    include_once "footer.php";

    ?>