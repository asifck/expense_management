<?php
if(!empty($_POST)){
    require_once('dbo.php');

    if(!empty($_POST['name'])) {
        //if id is empty we need to create new record
        if(empty($_POST['id'])) {
            $created = createRecord('account', $_POST);
            //return $created;
        }
        else {
            // id $id enna variblil assign cheyyunu ennit id unset cheyyunnu coz namukk already id und ath change cheyyanda aavsyam illa
            $id = $_POST['id'];
            unset($_POST['id']);
            $updated = updateRecord("account", $id, $_POST);
        }

    }
    else {
        echo 'Name must be entered'; exit;
    }

}
header("Location: account_list.php");
exit();
//ivide $_POST id undenkil updatum illenkil new creatum cheyyanulla conditions aanu mukalil ullath