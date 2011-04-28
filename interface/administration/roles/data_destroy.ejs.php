<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_destroy.ejs.php / Roles
// v0.0.1
// Under GPLv3 License
// Integrated by: Gi Ernesto Rodriguez. in 2011
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
// Flag the list item to delete
// *****************************************************************************************
$data = json_decode ( $_REQUEST['row'], true );
switch ($_GET['task']) {
		// *********************************************************************************
		// Code to delete roles and related data from acl_role_perms
		// *********************************************************************************
	case "delete_role";
		$delete_id = $data['id'];
		$mitos_db->setSQL("DELETE FROM acl_roles 
							WHERE id=".$delete_id);
		$mitos_db->execLog();
		$mitos_db->setSQL("DELETE FROM acl_role_perms  
							WHERE role_id=".$delete_id);
		$mitos_db->execLog();
		echo "{ success: true }";
	break;
		// *********************************************************************************
		// Code to delete permissions and related data from acl_role_perms
		// *********************************************************************************
	case "delete_permission";
		$delete_id = $data['id'];
		$mitos_db->setSQL("DELETE FROM acl_permissions
							WHERE id=".$delete_id);
		$mitos_db->execLog();
		$mitos_db->setSQL("DELETE FROM acl_role_perms  
							WHERE acl_role_perms.role_id=".$delete_id);
		$mitos_db->execLog();
		echo "{ success: true }";
	break;
}
?>