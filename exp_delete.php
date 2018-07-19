<?php
if(isset($_GET['id'])) {
    require_once "dbo.php";
    deleteRecord('expenses', $_GET['id']);
}
else {
    echo 'PLEASE PROVIDE RECORD ID';
}
header("Location: exp_list.php");
exit();