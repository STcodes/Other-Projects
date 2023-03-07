<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Methods,Authorization, X-Requested-With');

require_once('database.php');

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$db = Database::connect();
$statement = $db->prepare('UPDATE phone_table SET name = :name, category = :category, price = :price, evaluation = :evaluation, description = :description, imageUrl = :imageUrl WHERE id = :id');

$statement->bindParam(':id', $data->id);
$statement->bindParam(':name', $data->name);
$statement->bindParam(':category', $data->category);
$statement->bindParam(':price', $data->price);
$statement->bindParam(':evaluation', $data->evaluation);
$statement->bindParam(':description', $data->description);
$statement->bindParam(':imageUrl', $data->imageUrl);

if($statement->execute()){
    echo json_encode(array('message' => 'Phone updated.'));
}

Database::disconnect();