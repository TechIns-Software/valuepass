<?php 

if (!isset($conn)) {
    include '../connection.php';
}
include 'admin_library.php';
session_start();


if(isset($_FILES['file']['name'])) {

    /* Getting file name */
    $initialFilename = $_FILES['file']['name'];
    $type = substr($initialFilename, strpos($initialFilename, '.'));
    /* Location */
    $name = date('sdmy');
    $filename = $name.$type;
    $location = "../images/location_images/".$filename;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg","jpeg","png","webp");
    $response = 0;
    /* Check file extension */
    if(in_array(strtolower($imageFileType), $valid_extensions)) {
        /* Upload file */
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)) {
            if (isset( $_SESSION['DestinationId']) &&  $_SESSION['DestinationId'] ) {
                //photo is for updating store
                $iddestination = $_SESSION['DestinationId'];

                $image1_text = CheckImage1($conn, $iddestination );

                if ($image1_text =='path1'){
                    $query = "UPDATE Destination SET image1 = '$filename' WHERE id = $iddestination";
                }else if($image1_text !=='path1'){
                    $query = "UPDATE Destination SET image2 = '$filename' WHERE id = $iddestination";
                     unset($_SESSION['DestinationId']);
                }

                $stmt = $conn->prepare($query);
                if ($stmt->execute()) {
                    $response = $filename;
                } else {
                    $response = 0;
                }
            } else {
                $response = 0 ;
            }
        }
    }
    echo $response;
    exit;
}
