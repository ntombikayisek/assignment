<?php
    require 'future_value.php';

    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', 
            FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', 
            FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', 
            FILTER_VALIDATE_INT);
    $compounded_monthly = filter_input(INPUT_POST, 'compound_monthly',
            FILTER_VALIDATE_BOOLEAN);

    // create FutureValue object
    $fv = new FutureValue();

    // set data in FutureValue object
    $fv->setInvestment($investment);
    $fv->setYearlyInterestRate($interest_rate);
    $fv->setYears($years);
    $fv->setCompoundMonthly($compounded_monthly);

    // Validate the data
    $error_message = $fv->validate();

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $fv->getInvestmentFormatted(); ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $fv->getYearlyInterestRateFormatted(); ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $fv->getYears(); ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $fv->getFutureValueFormatted(); ?></span><br>
        
        <label>Compound Monthly:</label>
        <span><?php echo $fv->getCompoundMonthlyFormatted(); ?></span><br>
        
        <p>This calculation was done on <?php echo date('m/d/y'); ?> </p>
    </main>
</body>
</html>