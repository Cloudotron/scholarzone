<?php
include_once("script.php");
$script = new script;

$uid = $_GET['uid'];
$form = $_GET['app'];

$script->update_application($_GET['uid'],"R",$form);

header("location:view-application.php?uid=".$_GET['uid']);
?>