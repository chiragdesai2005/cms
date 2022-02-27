<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/organization.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $organization = new Organization($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $organization->id = $data->id;
  $organization->name = $data->name;
  $organization->address1 = $data->address1;
  $organization->address2 = $data->address2;
  $organization->contact = $data->contact;
  $organization->mobile = $data->mobile;

  // Update post
  if($organization->update()) {
    echo json_encode(
      array('message' => 'Organization Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Organization not updated')
    );
  }