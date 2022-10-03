<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Homepage | ValuePass";
$home = 1;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
?>
<!--TODO: future maybe client needs to fill up banks field f.e. region -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Valuepass Payment Info</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Lato:900">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .center-screen {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>
<body class="main-bg">

<div class="center-screen container form-bg center-screen">
    <div class="row">
        <div class="col-12">
            <img src="assets/img/valuepassLogo.png" height="200" width="200" class="img-fluid">
        </div>

        <div class="col-12">
            <form id="clientForm" class="row" method="post" action="procedure.php">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4>Information</h4>
                    <p>Relate your voucher with you, and receive your vouchers qr codes to your email</p>

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="fullname" placeholder="Enter your Full Name" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email"  placeholder="Enter your email" required>

                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="terms">
                        <label class="form-check-label" for="terms">
                            I have read and agree to the terms and conditions of
                            <a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf':'terms_gb.pdf' ?>" target="_blank">
                                <?php echo $menu[10] ?>
                            </a>
                        </label>
                    </div>

                    <div class="form-check ">
                        <input name="promotions" class="form-check-input" type="checkbox" value="" id="emailmarketing">
                        <label class="form-check-label " for="emailmarketing">
                            I accept to send me occasional emails about promotions, new products and important updates.
                        </label>
                    </div>
                    <div class="form-group my-4 text-center">
                        <input type="submit" id="continue" class="btn btn-primary form-control" value="Continue">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

</body>


<script src="assets/js/start.js"></script>
</html>