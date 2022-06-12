<?php
if (!isset($conn)) {
    include '../connection.php';
}

$_SESSION['step'] = 3;
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
                        <label for="exampleInputPassword1" class="form-label">Number of Highlights</label>
                        <input type="number" class="form-control" id="exampleInputPassword1">
                        <button class="btn btn-info my-3">Generate</button>
                    </div>

                    <div class=" col-lg-8 col-md-12  my-3"></div>

                    <div class=" col-lg-6 col-md-12  my-3 ">
                        <label for="exampleInputPassword1" class="form-label">About Highlight 1 </label>
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header Gr">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header GB">
                    </div>


                    <div class=" col-lg-6 col-md-12  my-3 ">
                        <label for="exampleInputPassword1" class="form-label">About Highlight 2 </label>
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header Gr">
                        <input type="text" class="form-control my-2" id="exampleInputPassword1" placeholder="Header GB">
                    </div>


                    <div class=" col-lg-12 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Check what Includes in this Exprience</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Include 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                Include 2
                            </label>
                        </div>
                    </div>



                </div>
                <button> <a href="createvendor_s4.php?id=<?php echo $vendorid; ?>">Next Step</a> </button> 
            </form>

        </div>
    </div>



    <?php

    include_once "footer.php";

    ?>