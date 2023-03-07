<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

require_once('database.php');

$phoneData = array();

$db = Database::connect();
$statement = $db->query('SELECT * FROM phone_table');
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

    array_push($phoneData, $phoneItem);
}
echo json_encode($phoneData);

Database::disconnect();
