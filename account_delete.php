<?php
if(isset($_GET['id'])) {
    require_once "dbo.php";
    deleteRecord('account', $_GET['id']);
}
else {
   echo 'PLEASE PROVIDE RECORD ID';
}

header("Location: account_list.php");
exit();