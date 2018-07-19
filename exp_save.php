<?php
if (!empty($_POST)){
      require_once "dbo.php";
        //if id is empty we need to create new record
        if(empty($_POST['id'])) {
            $created = createRecord('expenses', $_POST);
            //return $created;
        }
        else {
            $id = $_POST['id'];
            unset($_POST['id']);
            $updated = updateRecord("expenses", $id, $_POST);
        }



}else{
    echo "Deatils mustbe enter";
}
header("Location: exp_list.php");
exit();
