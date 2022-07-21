<?php
if (!isset($conn)) {
    include '../connection.php';
}



$title = "Προσθήκη Φωτογραφιών | Step  6" ;

include_once "header.php";
include 'admin_library.php';
?>
<div class="content-wrapper">
    <div class="container">
        <h2 class="text-center">Προσθήκη Φωτογραφιών</h2>
        <div style="min-height: 25px;"></div>
        <div class="row">
            <div class="col-sm-6">
                <div class="custom-file">
                    <form>
                        <input type="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file">Choose file</label>
                    </form>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4">
            <button onclick="addImage(event);" class="btn-primary btn">Ανέβασμα</button>

            </div>
        </div>
        <div style="min-height: 25px;"></div>
    </div>
    <div class="container fixed-bottom">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="text-center">Ολοκλήρωση</h2>
            </div>
            <div class="col-sm-6">
                <div class="text-center">
                    <button onclick="vendorCreationEnd(event);" class="btn btn-secondary btn-lg">Επιβεβαίωση</button>
                </div>
                <div style="min-height: 150px;"></div>
            </div>
        </div>

        <div class="">

        </div>
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
<script src="js/addImage.js"></script>
<?php
include_once "footer.php";

?>
