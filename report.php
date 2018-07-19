<?php
require_once 'dbo.php';
$accounts = getAll('account');
$selectedMonth = !empty($_GET['month']) ? $_GET['month'] : (int)date('m');
$selectedYear =  !empty($_GET['year']) ? $_GET['year'] : (int)date('Y');
$selectedAccount =  !empty($_GET['account_id']) ? $_GET['account_id'] : null;

$expenses = getReportData($selectedMonth, $selectedYear, $selectedAccount);
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
<section style="padding-top: 5%;">
    <?php
    $months = array(

        1 => 'jan',  2 => 'feb',  3 => 'march',  4 => 'april',  5 => 'may',  6 => 'june',  7 => 'july',
          8 => 'aug',  9 => 'sep',  10 => 'oct',  11 => 'nov',  12 => 'dec'
    );



    ?>
    <div class="container">
        <div class="row">
            <form method="GET" action="report.php" style="width: 100%; display: flex;">


            <div class="form-group col-3">
                <label for="exampleInputPassword1"></label>
                <select class="form-control" name="month">

                    <?php foreach ($months as $key => $month):?>
                    <option value="<?php echo $key; ?>" <?php echo $key == $selectedMonth ? 'selected': ''; ?>><?php echo ucfirst($month); ?></option>
                    <?php endforeach;?>

                </select>
            </div>
            <div class="form-group col-3">
                <label for="exampleInputPassword1"></label>

                <?php
                $years = range(1920,2030);

                ?>
                <select class="form-control" name="year">

                    <?php foreach($years as $year): ?>
                        <option value="<?php echo $year ?>" <?php echo $year == $selectedYear ? 'selected': ''; ?>><?php echo $year ?> </option>
                    <?php endforeach; ?>

                </select>
            </div>
                <div class="form-group col-3">
                    <label for="exampleInputPassword1"></label>

                    <select class="form-control" name="account_id">
                        <option value="">Select One</option>
                        <?php foreach($accounts as $account): ?>
                            <option value="<?php echo $account['id']; ?>" <?php echo $account['id'] == $selectedAccount ? 'selected': ''; ?> >
                                <?php echo $account['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div  class="col-3">
                    <button type="submit" class="report-btn">Submit</button>
                </div>
            </form>


        </div>







          </div>


</section>
<section style="padding: 5% 2%;">
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">particulers</th>
                    <th scope="col">Account</th>
                    <th scope="col">Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($expenses)>0):?>
                    <?php
                        $total = 0;
                        $accountTotal = array();
                    ?>
                    <?php foreach($expenses as $expens) :?>
                      <?php
                     $total = $total + $expens['amount'];


                     $accountTotal[$expens['account_id']] = $accountTotal[$expens['account_id']] + $expens['amount'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo date('d M Y', strtotime($expens['transaction_date'])); ?></th>
                            <td><?php echo $expens['particulers']; ?></td>
                            <?php $account = getOne('account', $expens['account_id']); ?>
                            <td><?php echo $account['name']; ?></td>
                            <td><?php echo $expens['account_id']; ?></td>
                            <td><?php echo $expens['amount']; ?></td>

                        </tr>
                    <?php endforeach;?>
                <?php else: ?>
                    <tr><td colspan="5" align="center">No Expenses available</td></tr>
                <?php endif; ?>
                <?php //echo "<pre>"; print_r($accountTotal); ?>
                </tbody>
                <tfoot>
                  <tr>
                      <?php // seperate total amout print cheyyan?>
                     <?php foreach ($accountTotal as $key => $aTotal): ?>
                         <?php $account = getOne('account', $key); ?>
                         <th role="col">Total spent by <?php echo $account['name']; ?>  </th>
                         <td role="col"><?php echo $aTotal; ?>  </td>
                     <?php endforeach;?>
                  </tr>
                  <tr> <?php // all accounts total amout print cheyyan?>
                      <th scope="col" colspan="3" >Total Amount spent on <?php echo $months[$selectedMonth]; ?> <?php echo $selectedYear; ?></th>
                      <td colspan="1" align="left"><?php echo $total; ?></td>
                  </tr>

                </tfoot>
            </table>
        </div>
    </div>
</section>




</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
