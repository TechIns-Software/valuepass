<?php
if (!isset($conn)) {
    include '../connection.php';
}

// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 1) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }


$title = "Δημιουργία Vendor | Step 5";
include_once "header.php";
include 'admin_library.php';


$languages = getAllLanguages($conn,true);
$ratedCategories = getRatedCategories($conn);

?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 ">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : 5</h5>

                <form id="createvendor5" class="form  container">
                    <div class="row">


                        <?php
                        foreach ($languages as $language) {  ?>

                            <div class="col-lg-6 col-md-12 py-3">

                                <div class="mb-3">
                                    <label for="nameexpe<?php echo  $language[0] ?>" class="form-label">Ονομα Experience <span class="flag-icon flag-icon-<?php echo  $language[2] ?>"> </label>
                                    <input type="text" name="nameexpe<?php echo  $language[0] ?>" class="form-control" id="nameexpe<?php echo  $language[0] ?>">
                                </div>


                                <div class=" mb-3 form-floating">
                                    <label for="descbig<?php echo  $language[0] ?>" class="form-label">Μεγάλη περιγραφή <span class="flag-icon flag-icon-<?php echo  $language[2] ?>"> </label>
                                    <textarea class="form-control" name="descbig<?php echo  $language[0] ?>" id="descbig<?php echo  $language[0] ?>" cols="5" rows="5"></textarea>
                                </div>


                                <div class=" mb-3 form-floating">
                                    <label for="descfull<?php echo  $language[0] ?>" class="form-label">Full περιγραφή <span class="flag-icon flag-icon-<?php echo  $language[2] ?>"> </label>
                                    <textarea class="form-control" name="descfull<?php echo  $language[0] ?>" id="descfull<?php echo  $language[0] ?>" cols="5" rows="8"></textarea>
                                </div>


                            </div>

                        <?php  }  ?>


                    </div>

                </form>
            </div>




            <div class="col-lg-12 ">
                <h4 for="exampleInputPassword1" class="form-label">Εισάγετε Βαθμολογια για κάθε Rated Category (1 ~ 5 *) </h4>
                <form id="rated ">
                    <div class="row">
                        <div class=" col-lg-12 col-md-12  my-3">
                            <?php

                            foreach ($ratedCategories as $ratedCategory) {  ?>

                                <div class="row">
                                    <label for="colFormLabelLg" class="col-lg-6 col-md-12 col-form-label col-form-label-lg"><?php echo $ratedCategory[1] ?></label>
                                    <div class="col-lg-6 col-md-12">
                                        <input type="number" class="form-control form-control-lg ratedcat" min="1" max="5" name="<?php echo $ratedCategory[0] ?>" id="catid<?php echo $ratedCategory[0] ?>">
                                    </div>
                                </div>

                            <?php  } ?>
                        </div>
                    </div>
                </form>

                
            </div>


            <button class="btn btn-danger p-2 my-3" id="createbtn5">Επόμενο Στάδιο</button>
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

        <script src="js/createvendor5.js"></script>
        <?php

        include_once "footer.php";

        ?>