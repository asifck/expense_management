<?php
require_once 'dbo.php';
$accounts = getAll('account');
if(isset($_GET['id'])) {
    $expens = getOne('expenses',$_GET['id']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <title>Room Mate</title>
    <style>
        /* Stackoverflow preview fix, please ignore */
        .navbar-nav {
            flex-direction: row;
        }

        .nav-link {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
            color: #fff!important;
        }

        /* Fixes dropdown menus placed on the right side */
        .ml-auto .dropdown-menu {
            left: auto !important;
            right: 0px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark rounded" style="background: #b366ff;">
    <a class="navbar-brand" href="index.png"><img src="images/log.png" class="img-responsive" ></a>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="account_list.php" class="nav-link">Account</a>
        </li>
        <li class="nav-item">
            <a href="exp_list.php" class="nav-link">Expences</a>
        </li>

    </ul>
</nav>
<section>
    <div class="container">
        <div class="row">

            <form method="POST" action="exp_save.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="date" class="form-control" name="transaction_date" placeholder="Enter email" value="<?php echo isset($expens) ? $expens['transaction_date'] : ''?>">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Particulers</label>
                    <input type="text" class="form-control" name="particulers" placeholder="Partticulers" value="<?php echo isset($expens) ? $expens['particulers'] : ''?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Account</label>
                    <select class="form-control" name="account_id">
                        <option value="">Select One</option>
                        <?php foreach($accounts as $account): ?>
                            <option value="<?php echo $account['id']; ?>" <?php echo $account['id'] == $expens['account_id'] ? 'selected' : '' ?>>
                                <?php echo $account['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Amount</label>
                    <input type="text" class="form-control" name="amount" placeholder="amount" value="<?php echo isset($expens) ? $expens['amount'] : ''?>">
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>