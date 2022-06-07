<?php
if (!isset($_POST["action"])) {
    exit("Sorry no action provided");
}
if (!isset($conn)) {
    include '../connection.php';
}
include 'admin_library.php';
session_start();


if (
    $_POST["action"] == "addlocation" ||
    $_POST["action"] == "addlabel" ||
    $_POST["action"] == "addcategory" ||
    $_POST["action"] == "createbestoff"
) { 
    if ( $_POST["action"] == "addlocation"){
        $numberloc =$_POST["numberoflocations"];
        $data_langs =$_POST["data"];
         
        // print_r($data_langs);
        $last_id=lastInstertedid($conn);
        addrowDestination($conn,($last_id + 1 ));

        foreach ($data_langs as $data_lang ) {
            $id_loc = substr($data_lang[0], -1); 
            AddLocationTranslate($conn,$id_loc,($last_id+1),$data_lang[1],$data_lang[3]);
        }



    }


}
