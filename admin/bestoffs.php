<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Best offs";
include_once "header.php";
include 'admin_library.php';


$destinations = GetAllDestinations($conn);
?>



<div class="content-wrapper">
    <div class="container-fluid">
        <div class="loc_title">
            <h4>Δημιουργία Best off <small>(Κάθε location)</small> </h4>
            <hr>
            <h5>Επιλέξτε την Τοποθεσία <br> που θέλετε να δημιουργήσετε τα best off </h5> 
        </div>

        <ul class="list-group d-flex justify-content-between">


            <?php foreach ($destinations as $destination) {  ?>
                <li class="list-group-item"><a href="create_bestoff.php?id=<?php echo $destination[1] ?>"><?php echo $destination[0] ?></a> </li>
            <?php }     ?>
        </ul>

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



<?php

include_once "footer.php";

?>