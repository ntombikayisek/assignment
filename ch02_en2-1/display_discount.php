<?php
    // get the data from the form
    $product_description = filter_input(INPUT_POST, 'product_description');
    $list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
    $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_INT);

    // validate data
    if (empty($product_description)) {
        $error_message = 'Product description is a required field.';
    } else if ($list_price === FALSE) {
        $error_message = 'List price must be a valid number.';
    } else if ($list_price <= 0) {
        $error_message = 'List price must be greater than 0.';
    } else if ($discount_percent === FALSE) {
        $error_message = 'Discount percent must be a valid whole number.';
    } else if ($discount_percent <= 0) {
        $error_message = 'Discount percent must be greater than 0.';
    } else {
        $error_message = '';
    }
    
    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }

    // calculate the discount
    $discount = $list_price * $discount_percent * .01;
    $discount_price = $list_price - $discount;

    // calculate the sales tax
    $sales_tax_percent = 8;
    $sales_tax = $discount_price * $sales_tax_percent * .01;

    // apply currency formatting to the dollar and percent amounts
    $list_price_formatted = "$".number_format($list_price, 2);
    $discount_percent_formatted = $discount_percent."%";
    $discount_formatted = "$".number_format($discount, 2);
    $discount_price_formatted = "$".number_format($discount_price, 2);            
    $sales_tax_percent_formatted = $sales_tax_percent."%";
    $sales_tax_formatted = "$".number_format($sales_tax, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_formatted); ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_formatted); ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_formatted; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_formatted; ?></span><br>

        <br>

        <label>Sales Tax Rate:</label>
        <span><?php echo $sales_tax_percent_formatted; ?></span><br>

        <label>Sales Tax Amount:</label>
        <span><?php echo $sales_tax_formatted; ?></span>

    </main>
</body>
</html>