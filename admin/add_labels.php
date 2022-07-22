<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Προσθήκη Label";
include_once "header.php";
include 'admin_library.php';

$languages =  getAllLanguages($conn,true);

?>



<div class="content-wrapper">
    <div class="container-fluid">
        <div class="loc_title">
            <h4>Εισαγωγή Label</h4>
        </div>

        <form id="labelform">

            <?php
            // for each language the admin has to enter a location
            // TODO : WHILE LOOP WHITH ALL THE LANGUAGES WITH INPUTS

            foreach ($languages as $language) {  ?>

                <div class="mb-3">
                    <label for="label<?php echo  $language[0] ?>" class="form-label">Label  <span class="flag-icon flag-icon-<?php echo  $language[2] ?>">  </label>
                    <input type="text" name="<?php echo  $language[0] ?>" class="form-control" id="label<?php echo  $language[0] ?>" placeholder="name">
                </div>
            <?php   }  ?>


            <button type="submit" class="btn btn-primary" id="addlabelbtn">Εισαγωγή label</button>
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



<script src="js/add_labels.js"></script>


<?php

include_once "footer.php";

?>