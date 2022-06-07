<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Προσθήκη Label";
include_once "header.php";
include 'admin_library.php';

$languages =  getAllLanguages($conn);

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



<script src="js/add_labels.js"></script>


<?php

include_once "footer.php";

?>