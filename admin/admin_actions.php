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
        $_POST["action"] == "addVendor1" ||
        $_POST["action"] == "addActivities" ||
        $_POST["action"] == "addHighlights" ||
        $_POST["action"] == "addIncludesService" ||
        $_POST["action"] == "addImportantInfo" ||
        $_POST["action"] == "addVendorInfos" ||
        $_POST["action"] == "addRatedCategory" ||
        $_POST["action"] == "addRatedCategoryValues" ||
        $_POST["action"] == "uploadlocationimages" ||
        $_POST["action"] == "addSelectedlabels" ||
        $_POST["action"] == "addBestoffs"

    ) {
        if ($_POST["action"] == "addlocation") {
            $numberloc = $_POST["numberoflocations"];
            $data_langs = $_POST["data"];

            // print_r($data_langs);
            $table = 'Destination';
            $last_id = lastInstertedid($conn, $table);
            echo "THIS IS LAST ID --> " . var_dump($last_id);
            addrowDestination($conn, ($last_id + 1));
            $_SESSION['DestinationId'] = $last_id + 1;

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
            // print_r($data_st1);

            $destId =   $data_st1[0];
            $priceAdult =   $data_st1[1];
            $originalPrice =   $data_st1[2];
            $discount =   $data_st1[3];
            $priceKid =   $data_st1[4];
            $priceInfant =   $data_st1[5];
            $categoryId =   $data_st1[6];
            $paymentCategoryId =   $data_st1[7];

            AddVendor1($conn,  $destId,  $priceAdult,  $originalPrice,  $discount,  $priceKid, $priceInfant, $categoryId, $paymentCategoryId);
        } else if ($_POST["action"] == "addActivities") {

            $headers =   $_POST["headers"];
            $descriptions =   $_POST["description"];
            $numberofact =   $_POST["numberofact"];

            $allLanguages = getAllLanguages($conn);

            $headersfinal = array();
            foreach ($headers as $key => $value) {
                $temp = explode(",", $key);
                $idlang = $temp[0];
                $idrespondAct = $temp[1];
                echo   $idlang;
                echo "--";
                echo   $idrespondAct;
                echo "--";
                array_push($headersfinal, $value);
            }

            echo "----------------------------------";

            $desckfinal = array();
            foreach ($descriptions as $key => $value) {
                $temp = explode(",", $key);
                $idlang = $temp[0];
                $idrespondAct = $temp[1];
                echo   $idlang;
                echo "--";
                echo   $idrespondAct;
                echo "--";
                array_push($desckfinal, $value);
            }

            $number0flanguages = count($allLanguages);
            for ($i = 0; $i < count($headersfinal); $i++) {
                $whichLang = $i %  $number0flanguages;
                if ($whichLang  == 0) {
                    addrowAboutActivity($conn, $_SESSION['vendorcreateid']);
                    $lastid = $conn->insert_id;
                }
                $id_lang = $allLanguages[$whichLang][0];
                $activityHeader = $headersfinal[$i];
                $activityDescri = $desckfinal[$i];

                addAboutActivityTranslate($conn, $lastid, $id_lang, $activityHeader, $activityDescri);
            }
        } else if ($_POST["action"] == "addHighlights") {

            $headers = $_POST["headers"];
            $numhightlights = $_POST["numhightlights"];

            $allLanguages = getAllLanguages($conn);


            $headersfinal = array();
            foreach ($headers as $key => $value) {
                $temp = explode(",", $key);
                $idlang = $temp[0];
                $idrespondAct = $temp[1];
                echo   $idlang;
                echo "--";
                echo   $idrespondAct;
                echo "--";
                array_push($headersfinal, $value);
            }
            print_r($headersfinal);

            $number0flanguages = count($allLanguages);
            for ($i = 0; $i < count($headersfinal); $i++) {
                $whichLang = $i %  $number0flanguages;
                if ($whichLang  == 0) {
                    addrowHighlight($conn, $_SESSION['vendorcreateid']);
                    $lastid = $conn->insert_id;
                }
                $id_lang = $allLanguages[$whichLang][0];
                $activityHeader = $headersfinal[$i];

                addHighlightTranslate($conn, $lastid, $id_lang, $activityHeader);
            }
        } else if ($_POST["action"] == "addIncludesService") {
            $included_services =  $_POST["selectedincludes"];

            foreach ($included_services as $included_service) {
                addVendorIncludedService($conn, $_SESSION['vendorcreateid'], $included_service);
            }
        } else if ($_POST["action"] == "addImportantInfo") {

            $headers =   $_POST["headers"];
            $descriptions =   $_POST["descriptions"];
            $numberOfImportants =   $_POST["numberOfImportants"];

            $allLanguages = getAllLanguages($conn);

            $headersfinal = array();
            foreach ($headers as $key => $value) {
                $temp = explode(",", $key);
                $idlang = $temp[0];
                $idrespondAct = $temp[1];
                // echo   $idlang;
                // echo "--";
                // echo   $idrespondAct;
                // echo "--";
                array_push($headersfinal, $value);
            }


            echo "----------------------------------";

            $desckfinal = array();
            foreach ($descriptions as $key => $value) {
                $temp = explode(",", $key);
                $idlang = $temp[0];
                $idrespondAct = $temp[1];
                // echo   $idlang;
                // echo "--";
                // echo   $idrespondAct;
                // echo "--";
                array_push($desckfinal, $value);
            }



            $number0flanguages = count($allLanguages);
            for ($i = 0; $i < count($headersfinal); $i++) {
                $whichLang = $i %  $number0flanguages;
                if ($whichLang  == 0) {
                    $table = 'ImportantInformationHead';
                    $last_id = lastInstertedid($conn, $table);
                    $last_id++;
                    addrowImportantHead($conn, $last_id + 1, $_SESSION['vendorcreateid']);

                    $lastid = lastInstertedid($conn, $table);

                    echo "this is whichLang --> : " . $whichLang;
                    echo "this is lastid --> : " . $last_id;
                }


                $id_lang = $allLanguages[$whichLang][0];
                $activityHeader = $headersfinal[$i];
                $activityDescri = $desckfinal[$i];

                $Descri_arr = explode(",", $activityDescri);

                addImportantInformationHeadTranslate($conn, $lastid, $id_lang, $activityHeader);

                if ($whichLang  == 0) {

                    $table2 = 'ImportantInformationDescription';
                    $last = lastInstertedid($conn, $table2);
                    addrowImportantInformationDescription($conn, ($last + 1), $lastid);
                }

                for ($k = 0; $k < count($Descri_arr); $k++) {
                    $last_id2 = lastInstertedid($conn, $table2);
                    addImportantInformationDescriptionTranslate($conn, $last_id2, $id_lang, $Descri_arr[$k]);
                }
            }
        } else  if ($_POST["action"] == "addVendorInfos") {
            $vendorInfos = $_POST['data'];

            foreach ($vendorInfos as $vendorInfo) {
                $id_loc = substr($vendorInfo[0], -1);
                AddVendorTranslate($conn, $_SESSION['vendorcreateid'], $id_loc,  $vendorInfo[1], $vendorInfo[2], $vendorInfo[3], $vendorInfo[4]);
            }
        } else  if ($_POST["action"] == "addRatedCategory") {

            $data_labels = $_POST["data"];

            // print_r($data_labels);
            $table = 'RatedCategory';
            $last_id = lastInstertedid($conn, $table);
            addrowRatedCategory($conn, ($last_id + 1));

            foreach ($data_labels as $data_label) {
                $id_lang = $data_label[0];
                AddRatedCategoryTranslate($conn, ($last_id + 1), $id_lang, $data_label[1]);
            }
        } else  if ($_POST["action"] == "addRatedCategoryValues") {

            $data_r_categories = $_POST["ratedcategories"];


            foreach ($data_r_categories as $data_r_category) {
                $id_cat = $data_r_category[0];
                AddRated($conn, $id_cat, $_SESSION['vendorcreateid'], $data_r_category[1]);
            }
        } else  if ($_POST["action"] == "addSelectedlabels") {

            $datalabels = $_POST['selectedlabels'];

            foreach ($datalabels as $datalabel) {
                addSelectedLalels($conn, $_SESSION['vendorcreateid'], $datalabel);
            }
        } else if ($_POST["action"] == "addBestoffs") {
            $databesofs = $_POST['bestofdata'];
            $id_loc = $_POST['location_id'];
            /// *** NOT FINISHED *** //

        }
    }
} catch (Exception $exception) {
    var_dump($exception);
}
