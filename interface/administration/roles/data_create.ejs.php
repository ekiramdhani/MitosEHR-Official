<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php / Roles
// v0.0.2
// Under GPLv3 License
// Integrated by: Ernesto Rodriguez ~ MitosEHR
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------
session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');

include_once("../../../library/dbHelper/dbHelper.inc.php");
include_once("../../../library/I18n/I18n.inc.php");
require_once("../../../repository/dataExchange/dataExchange.inc.php");

//------------------------------------------
// Database class instance
//------------------------------------------
$mitos_db = new dbHelper();

// *****************************************************************************************
// Parce the data generated by EXTJS witch is JSON
// *****************************************************************************************
$data = json_decode ( $_POST['row'], true );
switch ($_GET['task']) {
	// *************************************************************************************
	// Code used to create role
	// *************************************************************************************
	case "create_role":
		// *************************************************************************************
		// Validate and pass the POST variables to an array
		// This is the moment to validate the entered values from the user
		// although Sencha EXTJS make good validation, we could check again 
		// just in case 
		// *************************************************************************************
		$row['role_name'] = dataEncode($data['role_name']);
		// *************************************************************************************
		// Finally that validated POST variables is inserted to the database
		// This one make the JOB of two, if it has an ID key run the UPDATE statement
		// if not run the INSERT stament
		// *************************************************************************************
		$mitos_db->setSQL("INSERT INTO acl_roles SET role_name = '" . $row['role_name'] . "'");
		$mitos_db->execLog();
		$last_insert_id = $mitos_db->lastInsertedId();
		// *************************************************************************************
		// when a new role is added a relationship need to be added 
		// for every role at acl_role_perm table using the id from new role
		// *************************************************************************************
		$mitos_db->setSQL("SELECT id FROM acl_permissions");
		foreach ($mitos_db->execStatement() as $perms_row) {
			$mitos_db->setSQL("INSERT INTO acl_role_perms 
					  		  	  	   SET role_id = '" . $last_insert_id . "', " . "
					  	          	  	   perm_id = '" . $perms_row['id'] . "', " . "
					  			  	       value = '0'");
			$mitos_db->execLog();
		}
		echo "{ success: true }";
	break;
	// *************************************************************************************
	// Code used to create permisions
	// *************************************************************************************
	case "create_permission":
		// *************************************************************************************
		// Validate and pass the POST variables to an array
		// This is the moment to validate the entered values from the user
		// although Sencha EXTJS make good validation, we could check again 
		// just in case 
		// *************************************************************************************
		$row['perm_key'] = dataEncode($data['perm_key']);
		$row['perm_name'] = dataEncode($data['perm_name']);
		// *************************************************************************************
		// Finally that validated POST variables is inserted to the database
		// This one make the JOB of two, if it has an ID key run the UPDATE statement
		// if not run the INSERT stament
		// *************************************************************************************
		$mitos_db->setSQL("INSERT INTO acl_permissions 
							  	   SET perm_key = '" . $row['perm_key'] . "', " . "
								  	   perm_name = '" . $row['perm_name'] . "'");
		$mitos_db->execLog();
		$last_insert_id = $mitos_db->lastInsertedId();
		//**************************************************************************************
		// when a new permission is added a relationship need to be added 
		// for every role at acl_role_perm table 
		//**************************************************************************************
		$mitos_db->setSQL("SELECT id FROM acl_roles");
		foreach ($mitos_db->execStatement() as $roles_row) {
			$mitos_db->setSQL("INSERT INTO acl_role_perms 
					  		  	  SET role_id = '" . $roles_row['id'] . "', " . "
					  	          	  perm_id = '" . $last_insert_id . "', " . "
					  			  	  value = '0'");
			$mitos_db->execLog();
		}
		echo "{ success: true }";
	break;
}
?>