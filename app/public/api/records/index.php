<?php

// Step 1: Get a datase connection from our help class
$db = DbConnection::getConnection();
//:: is a static method
// Step 2: Create & run the query
if (isset($_Get['guid'])) {
  $stmt = $db->prepare(
    'SELECT * FROM Patient
    WHERE patientGuid = ?'
  );
  $stmt->execute([$_GET['guid']]);
} else{
  $stmt = $db->prepare('SELECT * FROM Patient'); //the SQL is just a string, prepare gets the SQL ready
  $stmt->execute();  //runs the query
}
$patients = $stmt->fetchAll(); //fetching the results of the query, patients is an array, fetchall returns an array of rows

// patientGuid VARCHAR(64) PRIMARY KEY,
// firstName VARCHAR(64),
// lastName VARCHAR(64),
// dob DATE DEFAULT NULL,
// sexAtBirth CHAR(1) DEFAULT ''
//just a reminder of schema, non factor

// Step 3: Convert to JSON
$json = json_encode($patients, JSON_PRETTY_PRINT); // converts array of rows and converts it into json, json_encode is built it, Prettyprint is an
//option that formats json so easier to read (as humans), all caps means constant

// Step 4: Output
header('Content-Type: application/json');//php is designed for connections over http, header sends our http header, browser now knows it is json
//all json files should have that header
echo $json;
//end on one blank line, dont close php get_meta_tags
