<?php
//TODO: authentication
if (!isset($_POST['action'])) {
    $_POST['action'] = 'signUp';
    $_POST['name'] = "Christos";
    $_POST['email'] = "christosbaztekas@gmail.com";
    $_POST['promotionsAvailable'] = 1;
    $_POST['password'] = 'dfrgthfgdf';
//    exit('Error: missing arguments');
}

if (!isset($conn)) {
    //TODO: our db connection
    include '../../connection.php';
}

if ($_POST['action'] == 'signUp') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $promotionsAvailable = $_POST['promotionsAvailable'];
    //TODO: already sha1
    $password = $_POST['password'];
    $query1 = "INSERT INTO User(name, email, promotionsAvailable, password, isConfirmed)
                VALUES(?, ?, ?, ?, 0);";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('ssis', $name, $email, $promotionsAvailable, $password);
    $stmt1->execute();
    $idNewUser = $conn->insert_id;
//    $conn->lastInsertId();
    $confirmationNumber = rand();
    echo $confirmationNumber;
    $query2 = "INSERT INTO UserConfirmation(idUser, confirmationNumber, dateSend)
                VALUES($idNewUser, $confirmationNumber, NOW());";
    $stmt2 = $conn->prepare($query2);
    $stmt2->execute();
    //TODO: send email the confirmation number through get ps=confirmationNumber



} elseif ($_POST['action'] == 'signIn') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT id, name, isConfirmed FROM User WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $idGet = $nameGet = $isConfirmed = '';
    if ($stmt->execute()) {
        $stmt->bind_result($id, $nameGet, $isConfirmed);
        while ($stmt->fetch()) {}

    }
    return json_encode([$idGet, $nameGet, $isConfirmed]);

}