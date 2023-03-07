<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

require_once('database.php');

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$db = Database::connect();
$statement = $db->prepare('DELETE FROM phone_table WHERE id = :id');

$statement->bindParam(':id', $data->id);

if($statement->execute()){
    echo json_encode(array('message' => 'Phone deleted.'));
}

Database::disconnect();
