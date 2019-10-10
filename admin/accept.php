<?php
    include_once("script.php");

    $script = new script;

    $uid = $_GET['uid'];

    $app = $_GET['app'];

    $script->update_application($_GET['uid'],"A",$app);

    header("location:view-application.php?uid=".$_GET['uid']);
?>