<?php
//Step 0: Validate Data
use Ramsey\Uuid\Uuid;
// Step 1: Get a datase connection from our help class
$db = DbConnection::getConnection();
//:: is a static method
// Step 2: Create & run the query
$stmt = $db->prepare(
  INSERT INTO Patient(patientGuid, firstName, lastName, DOB, sexAtBirth)
  VALUES (?,?,?,?,?)
);


$guid = Uuid::uuid4()->toString();
//super globals is an associative array of data
 //the SQL is just a string, prepare gets the SQL ready
$stmt->execute([
  $guid,
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['DOB'],
  $_POST['sexAtBirth'],
]);  //runs the query
//$patients = $stmt->fetchAll(); //fetching the results of the query, patients is an array, fetchall returns an array of rows

// patientGuid VARCHAR(64) PRIMARY KEY,
// firstName VARCHAR(64),
// lastName VARCHAR(64),
// dob DATE DEFAULT NULL,
// sexAtBirth CHAR(1) DEFAULT ''
//just a reminder of schema, non factor

// Step 3: Convert to JSON
//$json = json_encode($patients, JSON_PRETTY_PRINT); // converts array of rows and converts it into json, json_encode is built it, Prettyprint is an
//option that formats json so easier to read (as humans), all caps means constant

// Step 4: Output
header('HTTP/1.1 303 See Other'); //303 says redirect with a get
header('Location: ../records/');//where you need to go





//header('Content-Type: application/json');//php is designed for connections over http, header sends our http header, browser now knows it is json
//all json files should have that header
//echo $json;
//end on one blank line, dont close php get_meta_tags
