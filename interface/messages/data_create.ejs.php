<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php
// v0.0.2
// Under GPLv3 License
//
// Integration Sencha ExtJS Framework
//
// Integrated by: GI Technologies Inc. in 2011
//
// OpenEMR is a free medical practice management, electronic medical records, prescription writing,
// and medical billing application. These programs are also referred to as electronic health records.
// OpenEMR is licensed under the General Gnu Public License (General GPL). It is a free open source replacement
// for medical applications such as Medical Manager, Health Pro, and Misys. It features support for EDI billing
// to clearing houses such as Availity, MD-Online, MedAvant and ZirMED using ANSI X12.
//
// Sencha ExtJS
// Ext JS is a cross-browser JavaScript library for building rich internet applications. Build rich,
// sustainable web applications faster than ever. It includes:
// * High performance, customizable UI widgets
// * Well designed and extensible Component model
// * An intuitive, easy to use API
// * Commercial and Open Source licenses available
//
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------

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
require_once("../registry.php");
require_once("$srcdir/pnotes.inc.php");
require_once("$srcdir/patient.inc.php");
require_once("$srcdir/acl.inc.php");
require_once("$srcdir/log.inc.php");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/classes/Document.class.php");
require_once("$srcdir/gprelations.inc.php");
require_once("$srcdir/formatting.inc.php");

// Count records variable
$count = 0;

// Current structure of the record ExtJS Mappings
// informational only
//
// {name: 'noteid', type: 'int', mapping: 'noteid'},
// {name: 'user', type: 'string', mapping: 'user'},
// {name: 'body', type: 'string', mapping: 'body'},
// {name: 'from', type: 'string', mapping: 'from'},
// {name: 'patient', type: 'string', mapping: 'patient'},
// {name: 'type', type: 'string', mapping: 'type'},
// {name: 'date', type: 'string', mapping: 'date'},
// {name: 'status', type: 'string', mapping: 'status'}
// {name: 'reply_to', type: 'int', mapping: 'reply_to'}
//
// Parce the data generated by EXTJS witch is JSON
$data = json_decode ( $_POST['row'] );

if ($noteid) {
	updatePnote($data[0]->noteid, // Internal OpenEMR Function
				$data[0]->body,
				$data[0]->type,
				$data[0]->user,
				$data[0]->status);
	$noteid = '';
} else {
	$noteid = addPnote($data[0]->reply_to, // Internal OpenEMR Function
						$data[0]->body,
						$userauthorized,
						'1',
						$data[0]->type,
						$data[0]->user,
						'',
						$data[0]->status);
}

?>