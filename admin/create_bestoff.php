<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Create Best offs";
include_once "header.php";
include 'admin_library.php';


if (isset($_GET['id']) &&  $_GET['id']) {
    $location_id =  $_GET['id'];
} else {
    echo "Υπήρξε κάποιο πρόβλημα. Προσπαθήστε αργότερα";
}

$AvailableExperiences = getAvailableExperiences($conn, $location_id);
$bestof_idVendors = getBestofLocation($conn,$location_id) ;
$checkedVendors = [];
foreach ($bestof_idVendors as $bestof_idVendor) {
    array_push($checkedVendors, $bestof_idVendor[1]);
}

?>



<div class="content-wrapper">
    <div class="container-fluid">
        <div class="loc_title">
            <h4>Επιλόγη Experiences </h4>
        </div>
        <div class="row">

            <input type="hidden" value="<?php echo  $location_id ?>" id="locationId">
            <?php foreach ($AvailableExperiences as $AvailableExperience) { ?>

                <div class="col-sm-3 my-2">
                    <div class="card" style="height: 100%">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $AvailableExperience[1] ?></h5>

                            <div class="form-check">

                               <?php if (in_array($AvailableExperience[0] , $checkedVendors)) { ?>
                                    <input class="form-check-input idexper" type="checkbox" value="<?php echo $AvailableExperience[0] ?>" id="flexCheckChecked<?php echo $AvailableExperience[0] ?>" checked>
                                <?php } else { ?>
                                    <input class="form-check-input idexper" type="checkbox" value="<?php echo $AvailableExperience[0] ?>" id="flexCheckChecked<?php echo $AvailableExperience[0] ?>" >
                                <?php    } ?> 
                            </div>
                        </div>
                    </div>
                </div>

            <?php  } ?>
        </div>

        <div class="row ">
            <button class=" col-5 m-4 btn btn-warning" id="submitbestoffs"> Υποβολή</button>
              
            </div>


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


<script src="js/add_bestoffs.js"></script>
<?php

include_once "footer.php";

?>