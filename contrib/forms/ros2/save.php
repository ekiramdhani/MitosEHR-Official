<?php
// Copyright (C) 2009 Aron Racho <aron@mi-squared.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
include_once("../../registry.php");
include_once("$srcdir/acl.inc.php");

require ("C_FormROS2.class.php");
$c = new C_FormROS2();
echo $c->default_action_process($_POST);
@formJump();
?>
