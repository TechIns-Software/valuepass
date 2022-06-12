<?php
if (!isset($_POST["action"])) {
    exit("Sorry no action provided");
}
if (!isset($conn)) {
    include '../connection.php';
}
include 'admin_library.php';
session_start();
try {
    if (
        $_POST["action"] == "addlocation" ||
        $_POST["action"] == "addlabels" ||
        $_POST["action"] == "addcategory" ||
        $_POST["action"] == "createbestoff" ||
        $_POST["action"] == "addVendor1"
    ) {
        if ($_POST["action"] == "addlocation") {
            $numberloc = $_POST["numberoflocations"];
            $data_langs = $_POST["data"];

            // print_r($data_langs);
            $table = 'Destination';
            $last_id = lastInstertedid($conn, $table);
            addrowDestination($conn, ($last_id + 1));

            foreach ($data_langs as $data_lang) {
                $id_loc = substr($data_lang[0], -1);
                AddLocationTranslate($conn, $id_loc, ($last_id + 1), $data_lang[1], $data_lang[3]);
            }
        } else   if ($_POST["action"] == "addlabels") {
            $data_labels = $_POST["data"];

            // print_r($data_labels);
            $table = 'LabelsBox';
            $last_id = lastInstertedid($conn, $table);
            addrowLabelBox($conn, ($last_id + 1));
            foreach ($data_labels as $data_label) {
                $id_lang = $data_label[0];
                AddLabelBoxTranslate($conn, ($last_id + 1), $id_lang, $data_label[1]);
            }
        } else  if ($_POST["action"] == "addcategory") {

            $data_labels = $_POST["data"];

            // print_r($data_labels);
            $table = 'CategoryVendor';
            $last_id = lastInstertedid($conn, $table);
            addrowCategoryVendor($conn, ($last_id + 1));

            foreach ($data_labels as $data_label) {
                $id_lang = $data_label[0];
                AddCategoryVendorTranslate($conn, ($last_id + 1), $id_lang, $data_label[1]);
            }
        } else if ($_POST["action"] == "addVendor1") {
            $data_st1 = $_POST["data"];
            print_r($data_st1);

            $destId =   $data_st1[0];
            $priceAdult =   $data_st1[1];
            $originalPrice =   $data_st1[2];
            $discount =   $data_st1[3];
            $priceKid =   $data_st1[4];
            $priceInfant =   $data_st1[5];
            $categoryId =   $data_st1[6];
            $paymentCategoryId =   $data_st1[7];

            AddVendor1($conn,  $destId,  $priceAdult,  $originalPrice,  $discount,  $priceKid, $priceInfant, $categoryId, $paymentCategoryId);

        }
    }
} catch (Exception $exception) {
    var_dump($exception);
}
