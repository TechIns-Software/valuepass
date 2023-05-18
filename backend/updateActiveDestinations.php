<?php
exit('Deprecated Service');
if (!isset($ports)) {
    $ports = [];
//    exit('No arguments provided');
}
if (!isset($conn)) {
    include '../connection.php';
}
//set all destinations inactive
$query1 = "UPDATE Destination SET showIt = 0 WHERE id > 0";
$stmt1 = $conn->prepare($query1);
$stmt1->execute();
$stmt1->close();

$destinations = [];
$query2 = "SELECT id, mappingString FROM Destination;";
$stmt2 = $conn->prepare($query2);
$stmt2->execute();
$stmt2->bind_result($idDestination, $mappingString);
while ($stmt2->fetch()) {
    $destinations[$idDestination] = explode(',', $mappingString);
}
$stmt2->close();

$query3 = "UPDATE Destination SET showIt = ? WHERE id = ?";
$stmt3 = $conn->prepare($query3);
$stmt3->bind_param('ii', $idDestination, $showIt);
foreach ($destinations as $idDestination => $portsOfDestinations) {
    $showIt = intval(count(array_intersect($portsOfDestinations, $ports)) > 0);
    $stmt3->execute();
}
$stmt3->close();

$conn->close();
