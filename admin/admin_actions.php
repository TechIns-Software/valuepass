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
        $_POST["action"] == "addBestoffs" ||
        $_POST["action"] == "finalizeVendor" ||
        $_POST["action"] == "addIncluded" || 
        $_POST["action"] == "addVoucherRules" ||
        $_POST["action"] == "adminLogin"


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
            $priceAdult =   $data_st1[2];
            $originalPrice =   $data_st1[1];
            $discount =   $data_st1[3];
            $priceKid =   $data_st1[4];
            $priceInfant =   $data_st1[5];
            $categoryId =   $data_st1[6];
            $paymentCategoryId =   $data_st1[7];
            $howManyForVoucher = $data_st1[8];

            AddVendor1(
                $conn,  $destId,  $priceAdult,  $originalPrice,  $discount,
                $priceKid, $priceInfant, $categoryId, $paymentCategoryId, $howManyForVoucher
            );
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
                array_push($headersfinal, $value);
            }


            $desckfinal = array();
            foreach ($descriptions as $key => $value) {
                $temp = explode(",", $key);
                $idlang = $temp[0];
                $idrespondAct = $temp[1];
                array_push($desckfinal, $value);
            }



            $number0flanguages = count($allLanguages);
            for ($i = 0; $i < count($headersfinal); $i++) {
                $whichLang = $i %  $number0flanguages;
                if ($whichLang  == 0) {
                    $table = 'ImportantInformationHead';
                    $last_id = lastInstertedid($conn, $table);
                    $last_id++;
                    addrowImportantHead($conn, $last_id, $_SESSION['vendorcreateid']);
                    $lastid = lastInstertedid($conn, $table);
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
                AddVendorTranslate($conn, $_SESSION['vendorcreateid'], $id_loc,  $vendorInfo[1], $vendorInfo[2], $vendorInfo[3]);
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
            DeleteBestofByLocation($conn, $id_loc);

            if (count($databesofs) > 0){
                foreach ($databesofs as $databesof) {
                    addBestoff($conn,  $id_loc, $databesof);
                }
            }

        } else if ($_POST["action"] == "finalizeVendor") {
            finalizeVendor($conn, $_SESSION['vendorcreateid']);
            unset($_SESSION['vendorcreateid']);
        } else if ($_POST["action"] == "addIncluded") {
            $data_labels = $_POST["data"];
            $checked = $_POST["icon"];

            // print_r($data_labels);
            $table = 'IncludedService';
            $last_id = lastInstertedid($conn, $table);
            addrowIncludedService($conn, ($last_id + 1), $checked);
            foreach ($data_labels as $data_label) {
                $id_lang = $data_label[0];
                AddIncludedServiceTranslate($conn, ($last_id + 1), $id_lang, $data_label[1]);
            }
        } else if ($_POST["action"] == "addVoucherRules" && $_POST["type"] == "allWeek" ){
            $voucherules_data = $_POST["voucherules"];

            foreach ($voucherules_data as $key => $value) {
                $day="";
                $temp_string=explode("_",$key );

                $day = $temp_string[0] ;
                $time =  $value.":00";
                echo $time ;
              // TODO :  CHANGE THE NUMBERVOUCHER ex 999 | We must find the last inserted  NUMBERVOUCHER
            addVoucherRules($conn,$_SESSION['vendorcreateid'],1 ,$day,$time,999);
            }
            $vendor_username = random_password(4);
            $_SESSION['vendor_username']  =  $_SESSION['vendorcreateid']."".$vendor_username;
            $vendor_password = random_password(8);
            $_SESSION['vendor_password'] =  $vendor_password."_". $_SESSION['vendorcreateid'];
            addVendorPasswords($conn,$_SESSION['vendorcreateid'],$_SESSION['vendor_username'] , $_SESSION['vendor_password'] );

        }  else if ($_POST["action"] == "addVoucherRules" && $_POST["type"] == "oneDay" ){
            $voucherules_data = $_POST["voucherules"];

            foreach ($voucherules_data as $key => $value) {
                $day="";
                $temp_string=explode("_",$key );

                $day = $temp_string[0] ;
                $time =  $value;
              // TODO :  CHANGE THE NUMBERVOUCHER ex 999 | We must find the last inserted  NUMBERVOUCHER
            addVoucherRules($conn,$_SESSION['vendorcreateid'],0 ,$day,$time,999);

            }
            $vendor_username = random_password(4);
            $_SESSION['vendor_username']  =  $_SESSION['vendorcreateid']."".$vendor_username;
            $vendor_password = random_password(8);
            $_SESSION['vendor_password'] =  $vendor_password."_". $_SESSION['vendorcreateid'];
            addVendorPasswords($conn,$_SESSION['vendorcreateid'],$_SESSION['vendor_username'] , $_SESSION['vendor_password'] );

        }  else if ($_POST["action"] == "adminLogin"){
            $credentials =  $_POST["data"];
            $username = $credentials['username'];
            $password = $credentials['password'];

            checkLogin($conn,$username,$password);


        }
    }
} catch (Exception $exception) {
    var_dump($exception);
}
