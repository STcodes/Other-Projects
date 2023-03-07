<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');


require_once('database.php');

$id = $_GET['id'];
$phoneItem = array();

$db = Database::connect();
$statement = $db->prepare('SELECT * FROM phone_table WHERE id = :id');
$statement->bindParam(':id', $id);
$statement->execute();
while($phone = $statement->fetch(PDO::FETCH_ASSOC)){
    $phoneItem = array(
        'id' => $phone['id'],
        'name' => $phone['name'],
        'category' => $phone['category'],
        'evaluation' => $phone['evaluation'],
        'description' => base64_encode($phone['description']),
        'imageUrl' => base64_encode($phone['imageUrl']),
        'price' => $phone['price'],
    );
}
echo json_encode($phoneItem);


Database::disconnect();
