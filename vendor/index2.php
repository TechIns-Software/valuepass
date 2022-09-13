<?php
session_start();
$tempurl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ( !isset($_SESSION['tempurl'])){
    $_SESSION['tempurl'] = $tempurl ;
}


if ( !isset($_SESSION['idVendor'])){
    header('location:login.php');
}
$title="Dashboard";
include_once "header.php";
?>
    <div class="">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Vouchers</li>
            </ol>
            <div class="box_general">
                <div class="header_box">
                    <h2 class="d-inline-block">Vouchers</h2>
                    <div class="filter">
                        <div class="styled-select short">
                            <select name="orderby">
                                <option value="Any time">Any time</option>
                                <option value="Latest">Latest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="list_general">
                    <ul>
                        <li>
                            <figure><img src="img/item_1.jpg" alt=""></figure>
                            <small>Hotel</small>
                            <h4>Hotel Mariott</h4>
                            <p>Lorem ipsum dolor sit amet, est ei idque voluptua copiosae, pro detracto disputando reformidans at, ex vel suas eripuit. Vel alii zril maiorum ex, mea id sale eirmod epicurei. Sit te possit senserit, eam alia veritus maluisset ei, id cibo vocent ocurreret per....</p>
                            <p><a href="#0" class="btn_1 gray"><i class="fa fa-fw fa-eye"></i> View item</a></p>
                            <ul class="buttons">
                                <li><a href="#0" class="btn_1 gray delete wishlist_close"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /box_general-->
            <nav aria-label="...">
                <ul class="pagination pagination-sm add_bottom_30">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <!-- /pagination-->
        </div>
        <!-- /container-fluid-->
    </div>
    <!-- /container-wrapper-->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
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
                    <a class="btn btn-primary" href="#0">Logout</a>
                </div>
            </div>
        </div>
    </div>


<?php
include_once "footer.php";
?>