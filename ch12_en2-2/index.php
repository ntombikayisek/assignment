<?php
//start persistent session if it's not already started
if (session_id() == '') {
    $lifetime = 60 * 60 * 24 * 14;  // 2 weeks in seconds
    session_set_cookie_params($lifetime, '/');
    session_start();
}

//get values from session if they exist, otherwise set default
if (isset($_SESSION['investment'])) { 
    $investment = $_SESSION['investment'];        
} else { 
    $investment = '';    
}

if (isset($_SESSION['interest_rate'])) { 
    $interest_rate = $_SESSION['interest_rate'];
} else { 
    $interest_rate = '';    
} 

if (isset($_SESSION['years'])) { 
    $years = $_SESSION['years']; 
} else { 
    $years = '';
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
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } // end if ?>
    <form action="display_results.php" method="post">

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
    </main>
</body>
</html>