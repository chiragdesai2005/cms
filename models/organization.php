<?php
  class Organization {
    // DB Stuff
    private $conn;
    private $table = 'organization';

    // Properties
    public $id;
    public $name;
    public $address1;
    public $address2;
    public $contact;
    public $mobile;
    public $email;
    public $longitude;
    public $latitude;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        *
      FROM
        ' . $this->table . '
      ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT
          id,
          name,
          address1,
          address2,
          contact,
          mobile,
          email,
          longitude,
          latitude,
          created_at
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->address1 = $row['address1'];
      $this->address2 = $row['address2'];
      $this->contact = $row['contact'];
      $this->mobile = $row['mobile'];
      $this->email = $row['email'];
      $this->longitude = $row['longitude'];
      $this->latitude = $row['latitude'];
      $this->created_at = $row['created_at'];
  }

  // Create Organisation
  public function create() {

  // Prepare Statement
  $stmt = $this->conn->prepare("INSERT INTO organization (name, address1, address2, contact, mobile, email, longitude, latitude) 
  VALUES (:name, :address1, :address2, :contact, :mobile, :email, :longitude, :latitude)");

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->address1 = htmlspecialchars(strip_tags($this->address1));
  $this->address2 = htmlspecialchars(strip_tags($this->address2));
  $this->contact = htmlspecialchars(strip_tags($this->contact));
  $this->mobile = htmlspecialchars(strip_tags($this->mobile));
  $this->email = htmlspecialchars(strip_tags($this->email));
  $this->longitude = htmlspecialchars(strip_tags($this->longitude));
  $this->latitude = htmlspecialchars(strip_tags($this->latitude));

  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':address1', $this->address1);
  $stmt-> bindParam(':address2', $this->address2);
  $stmt-> bindParam(':contact', $this->contact);
  $stmt-> bindParam(':mobile', $this->mobile);
  $stmt-> bindParam(':email', $this->email);
  $stmt-> bindParam(':longitude', $this->longitude);
  $stmt-> bindParam(':latitude', $this->latitude);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {

    // Create Query
    $stmt = $this->conn->prepare("update organization SET name = :name, address1 = :address1, address2 = :address2, contact = :contact, mobile = :mobile, email = :email, longitude = :longitude, latitude = :latitude WHERE id = :id");

 // Clean data
 $this->id = htmlspecialchars(strip_tags($this->id));
 $this->name = htmlspecialchars(strip_tags($this->name));
 $this->address1 = htmlspecialchars(strip_tags($this->address1));
 $this->address2 = htmlspecialchars(strip_tags($this->address2));
 $this->contact = htmlspecialchars(strip_tags($this->contact));
 $this->mobile = htmlspecialchars(strip_tags($this->mobile));
 $this->email = htmlspecialchars(strip_tags($this->email));
 $this->longitude = htmlspecialchars(strip_tags($this->longitude));
 $this->latitude = htmlspecialchars(strip_tags($this->latitude));


 // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':address1', $this->address1);
  $stmt-> bindParam(':address2', $this->address2);
  $stmt-> bindParam(':contact', $this->contact);
  $stmt-> bindParam(':mobile', $this->mobile);
  $stmt-> bindParam(':email', $this->email);
  $stmt-> bindParam(':longitude', $this->longitude);
  $stmt-> bindParam(':latitude', $this->latitude);


  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    //printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }