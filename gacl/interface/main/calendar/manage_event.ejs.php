<?php

//*********************************************************************************
// Save the event created on the Extensible Calendar Pro
// This will be the AJAX thing.
//
// This will output a JSON data format.
//
// rev 0.0.1
//*********************************************************************************

// *************************************************************************************
//SANITIZE ALL ESCAPES
// *************************************************************************************
$sanitize_all_escapes=true;

// *************************************************************************************
//STOP FAKE REGISTER GLOBALS
// *************************************************************************************
$fake_register_globals=false;

// *************************************************************************************
// Load the OpenEMR Libraries
// *************************************************************************************
include_once("../../registry.php");
include_once("$srcdir/sql.inc.php");
include_once("$srcdir/options.inc.php");
include_once("$srcdir/patient.inc.php");

// *************************************************************************************
// Deside what to do with the $_GET['task']
// *************************************************************************************
switch ($_GET['task']) {

	// *************************************************************************************
	// Add the event to the database
	// *************************************************************************************
	case "create":
		
	break;

	// *************************************************************************************
	// Update the event in the database
	// *************************************************************************************
	case "update":
	break;

	// *************************************************************************************
	// Delete the event in the database
	// *************************************************************************************
	case "delete":
	break;
}
?>