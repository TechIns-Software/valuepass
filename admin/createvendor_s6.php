<?php
if (!isset($conn)) {
    include '../connection.php';
}

// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 1) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }


$title = "Δημιουργία Vendor | Step 6";
include_once "header.php";
include 'admin_library.php';


?>

    <div class="content-wrapper">
    <div class="container">
    <div class="row">

        <div class="col-12 ">
            <h4>Δημιουργία Vendor </h4>
            <h5> Step : 6</h5>

            <form id="createvendor1" class="form  container-fluid">
                <div class="row">
                        <?php showDay('day0');?>
                    <div class="col-lg-12 col-md-12  my-3">
                        <div id="geninpt"></div>
                    </div>

                </div>
            </form>
        </div>
        <button class="btn btn-danger p-2 my-3" id="createbtn6">Επόμενο Στάδιο</button>
    </div>

    <script src="js/createvendor6.js"></script>
<?php
function showDay($nameDay) {
    ?>
    <div class=" col-lg-12 col-md-12  my-3">
        <label for="exampleInputPassword1" class="form-label">
            ΔΕΥΤΕΡΑ
        </label>
        <select name="<?php echo $nameDay;?>" class="form-control">
        <option value="12:00">12:00</option>
        <option value="12:30">12:30</option>
        <option value="01:00">01:00</option>
        <option value="01:30">01:30</option>
        <option value="02:00">02:00</option>
        <option value="02:30">02:30</option>
        <option value="03:00">03:00</option>
        <option value="03:30">03:30</option>
        <option value="04:00">04:00</option>
        <option value="04:30">04:30</option>
        <option value="05:00">05:00</option>
        <option value="05:30">05:30</option>
        <option value="06:00">06:00</option>
        <option value="06:30">06:30</option>
        <option value="07:00">07:00</option>
        <option value="07:30">07:30</option>
        <option value="08:00">08:00</option>
        <option value="08:30">08:30</option>
        <option value="09:00">09:00</option>
        <option value="09:30">09:30</option>
        <option value="10:00">10:00</option>
        <option value="10:30">10:30</option>
        <option value="11:00">11:00</option>
        <option value="11:30">11:30</option>
    </select>
    </div>
    <?php
}
include_once "footer.php";

?>