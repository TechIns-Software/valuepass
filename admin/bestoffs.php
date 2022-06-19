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



<?php

include_once "footer.php";

?>