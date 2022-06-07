<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Προσθήκη Τοποθεσίας";
include_once "header.php";
include 'admin_library.php';

$languages =  getAllLanguages($conn) ;

?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="loc_title">
            <h4>Εισαγωγή Τοποθεσίας</h4>
        </div>
 
        <form id="locationform">

            <?php
            // for each language the admin has to enter a location
            // TODO : WHILE LOOP WHITH ALL THE LANGUAGES WITH INPUTS

            foreach ($languages as $language ) {  ?>
        
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Location <?php echo  $language[1] ?> Language</label>
                <input type="text" name="loc<?php echo  $language[0] ?>" class="form-control" id="locname<?php echo  $language[0] ?>" placeholder="name">
                <textarea  name="des<?php echo  $language[0] ?>"   id="locdescription<?php echo  $language[0] ?>" class="form-control my-2" cols="30" rows="2"  placeholder="Description"></textarea>
            </div>       
            <?php   }  ?>

            <button type="submit" class="btn btn-primary" id="addlocationbtn">Εισαγωγή Τοποθεσίας</button>
        </form>
    </div>
</div>


<script src="js/conn.js"></script>
<script src="js/add_location.js"></script>

<?php

include_once "footer.php";

?>