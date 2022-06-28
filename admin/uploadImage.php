<?php
//security to added
if (!isset($conn)) {
    include '../connection.php';
}
$valid_extensions = array("jpg","jpeg","png","webp");
$message = 'Μη σύνηθες Λάθος';
if(isset($_FILES['file']['name'])) {
    session_start();
    $idVendor = $_SESSION['vendorcreateid'];
    /* Getting file name */
    $initialFilename = $_FILES['file']['name'];
    $type = substr($initialFilename, strpos($initialFilename, '.'));

    // Setting new name and to location wanted
    $name = date('sdmy');
    $filename = $name.$type;
    $directory = "../vendorImages/".$idVendor .'/';
    $location = $directory.$filename;

    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);


    /* Check file extension */
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    if(in_array($imageFileType, $valid_extensions)) {
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)) {
            $query = "INSERT INTO VendorImages(idVendor, image) VALUES($idVendor, '$filename')";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $message = 0;
            } else {
                $message = "Η φωτογραφία ανέβηκε, αλλά δεν έγινε η σύνδεση με τον Vendor";
            }
        } else {
            $message = "Δεν μπόρεσε να ανέβει το αρχείο";
        }
    } else {
        $message = "Δεν βρέθηκε κατάληξη του αρχείου που να αντιστοιχεί σε εικόνα";
    }

} else {
    $message = "Δεν δόθηκε αρχείο";
}
echo $message;
