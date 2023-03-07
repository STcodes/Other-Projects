<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header("HTTP/1.1 200 OK");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

require_once('database.php');

//get raw posted data
$data = array(
    'name' => $_POST['name'],
    'category' => $_POST['category'],
    'price' => $_POST['price'],
    'evaluation' => $_POST['evaluation'],
    'description' => $_POST['description'],
    'imageUrl' => $_POST['imageUrl'],
);

// $db = Database::connect();
// $statement = $db->prepare('INSERT INTO phone_table SET name = :name, category = :category, price = :price, evaluation = :evaluation, description = :description, imageUrl = :imageUrl');

// $statement->bindParam(':name', $data->name);
// $statement->bindParam(':category', $data->category);
// $statement->bindParam(':price', $data->price);
// $statement->bindParam(':evaluation', $data->evaluation);
// $statement->bindParam(':description', $data->description);
// $statement->bindParam(':imageUrl', $data->imageUrl);

if($statement->execute()){
    echo json_encode($data);
}

Database::disconnect();