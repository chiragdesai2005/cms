<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/organization.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Organization object
  $organization = new Organization($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $organization->name = $data->name;
  $organization->address1 = $data->address1;
  $organization->address2 = $data->address2;
  $organization->contact = $data->contact;
  $organization->mobile = $data->mobile;


  // Create organization
  if($organization->create()) {
    echo json_encode(
      array('message' => 'Organization Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Organization Not Created')
    );
  }