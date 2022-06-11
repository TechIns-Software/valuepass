<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Δημιουργία Vendor";
include_once "header.php";
include 'admin_library.php';

$destinations = GetAllDestinations($conn);
$_SESSION['step'] = 0;

?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12 loc_title">
            <h4>Δημιουργία Vendor <?php echo $_SESSION['step'] ;  ?>  </h4>
        </div>

        <div class="col-12 border my-2">
        <h3>1) Επιλογή Τοποθεσίας - Νησιού </h3>
        <select name="" id="" class="form-control">

        <option value="">Mykonos</option>
        <option value="">Mykonos</option>
        <option value="">Mykonos</option>
        <option value="">Mykonos</option>
        </select>
        </div>

        <div class="col-12 border my-2">
        <h3>1) Επιλογή Τοποθεσίας - Νησιού </h3>
        </div>


    </div>
</div>



<?php

include_once "footer.php";

?>