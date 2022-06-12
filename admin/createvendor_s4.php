<?php
if (!isset($conn)) {
    include '../connection.php';
}

$_SESSION['step'] = 4;
$title = "Δημιουργία Vendor | Step " . $_SESSION['step'];
include_once "header.php";
include 'admin_library.php';

$destinations = GetAllDestinations($conn);

$vendorid=0;
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

              
                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Number of Important Informations</label>
                        <input type="number" class="form-control" id="exampleInputPassword1">
                        <button class="btn btn-info my-3">Generate</button>
                    </div>

                    <div class=" col-lg-12 col-md-12  my-3 ">
                        <label for="exampleInputPassword1" class="form-label">Important Information 1 </label>
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header Gr">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Description Gr">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header GB">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Description GB">
                    </div>


                    <div class=" col-lg-12 col-md-12  my-3 ">
                        <label for="exampleInputPassword1" class="form-label">Important Information  2 </label>
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header Gr">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Description Gr">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header GB">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Description GB">
                    </div>

                </div>
                <button class="btn btn-primary my-3"> Submit </button> 
            </form>

        </div>
    </div>



    <?php

    include_once "footer.php";

    ?>