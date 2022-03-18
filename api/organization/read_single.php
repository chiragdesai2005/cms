<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/organization.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $category = new Organization($db);

  // Get ID
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $category->read_single();

  // Create array
  $category_arr = array(
    'id' => $category->id,
    'name' => $category->name,
    'address1' => $category->address1,
    'address2' => $category->address2,
    'contact' => $category->contact,
    'mobile' => $category->mobile,
    'email' => $category->email,
    'longitude' => $category->longitude,
    'latitude' => $category->latitude,
    'createdAt' => $category->created_at
  );

  // Make JSON
  print_r(json_encode($category_arr));