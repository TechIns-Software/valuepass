<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Προσθήκη Τοποθεσίας";
include_once "header.php";
include 'admin_library.php';

$languages =  getAllLanguages($conn);

// If destination id is set must be unset
if (isset($_SESSION['DestinationId'])) {

    unset($_SESSION['DestinationId']);
}

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



            foreach ($languages as $language) {  ?>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Τοποθεσία <span class="flag-icon flag-icon-<?php echo  $language[2] ?>"> </label>
                    <input type="text" name="loc<?php echo  $language[0] ?>" class="form-control" id="locname<?php echo  $language[0] ?>" placeholder="name">
                    <textarea name="des<?php echo  $language[0] ?>" id="locdescription<?php echo  $language[0] ?>" class="form-control my-2" cols="30" rows="2" placeholder="Description"></textarea>
                </div>
            <?php   }  ?>

            <button type="submit" class="btn btn-info my-3" id="addlocationbtn">Εισαγωγή Τοποθεσίας</button>
        </form>


        <div class="col-lg-6 col-md-12 border">
            <div class="loc_title">
                <h4>Εισαγωγή Φωτογραφιών</h4>
            </div>
            <form class="container" method="post" action="" enctype="multipart/form-data" id="myform">
                <div>
                    <input class="form-control" type="file" id="file" name="file" />
                    <input hidden id="file" type="button" class="button" value="Upload" id="but_upload">
                    <button class="btn  btn-warning my-3" id="uploadbtn"  onclick="uploadImageAsynchronous(event);">Ανέβασμα Φωτογραφίας</button>
                </div>
            </form>
        </div>

        <button class="btn btn-primary my-3">Υποβολή </button>
    </div>
</div>





<!-- <script src="js/conn.js"></script> -->
<script src="js/add_location.js"></script>

<?php

include_once "footer.php";

?>