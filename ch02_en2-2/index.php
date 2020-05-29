<?php
    // if the request is a POST request, validate the data
    // (this is true for all requests, except the first one)
    if (isset($_POST['investment'])) {
        // set default values for future value variables
        $investment_f = '';
        $years_f = '';
        $yearly_rate_f = '';
        $future_value_f = '';
        
        // get the data from the form
        $investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
        $interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
        $years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT);

        // validate investment entry
        if ( $investment === FALSE ) {
            $error_message = 'Investment must be a valid number.'; 
        } else if ( $investment <= 0 ) {
            $error_message = 'Investment must be greater than zero.';        
        // validate interest rate entry 
        } else if ( $interest_rate === FALSE ) {
            $error_message = 'Interest rate must be a valid number.'; 
        } else if ( $interest_rate <= 0 OR $interest_rate > 15 ) {
            $error_message = 'Interest rate must be greater than zero and less than or equal to 15.';
        // validate years entry 
        } else if ( $years === FALSE ) {
            $error_message = 'Years must be a valid number.'; 
        } else if ( $years < 1 OR $years > 50 ) {
            $error_message = 'Years must be greater than zero and less than or equal to 50.';        
        // set error message to empty string if no invalid entries
        } else {
            $error_message = '';           
        }

        // if the data is valid, perform the calculations and apply formatting
        if ($error_message == '') {
            // calculate the future value
            $future_value = $investment;
            for ($i = 1; $i <= $years; $i++) {
                $future_value = $future_value + ($future_value * $interest_rate *.01);
            }

            // apply currency and percent formatting
            $investment_f = '$'.number_format($investment, 2);
            $years_f = $years;
            $yearly_rate_f = $interest_rate.'%';
            $future_value_f = '$'.number_format($future_value, 2);

            // clear text boxes
            $investment = '';
            $interest_rate = '';
            $years = '';
        }
    } else {
        //first request - set default values for all variables
        $investment = '';
        $interest_rate = '';
        $years = '';
        $investment_f = '';
        $years_f = '';
        $yearly_rate_f = '';
        $future_value_f = '';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>

<body>
<main>
    <h1>Future Value Calculator</h1>
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } // end if ?>
    <form action="" method="post">

        <div id="data">
            <label>Investment Amount:</label>
            <input type="text" name="investment"
                   value="<?php echo htmlspecialchars($investment); ?>"><br>

            <label>Yearly Interest Rate:</label>
            <input type="text" name="interest_rate"
                   value="<?php echo htmlspecialchars($interest_rate); ?>"><br>

            <label>Number of Years:</label>
            <input type="text" name="years"
                   value="<?php echo htmlspecialchars($years); ?>"><br>
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Calculate"><br>
        </div>

    </form>

    <label>Investment Amount:</label>
    <span><?php echo htmlspecialchars($investment_f); ?></span><br>

    <label>Yearly Interest Rate:</label>
    <span><?php echo htmlspecialchars($yearly_rate_f); ?></span><br>

    <label>Number of Years:</label>
    <span><?php echo htmlspecialchars($years_f); ?></span><br>

    <label>Future Value:</label>
    <span><?php echo htmlspecialchars($future_value_f); ?></span><br>

    <p>This calculation was done on <?php echo date('m/d/y'); ?> </p>

</main>
</body>
</html>