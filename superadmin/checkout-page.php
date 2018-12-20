<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/12/2018
 * Time: 11:13 PM
 */

include 'controller/action.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="2;url=http://localhost/retailing/shop.php" />

    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <![endif]-->
    <meta name="keywords" content="HTML5 Template" />

    <meta name="description" content="Fashion Shop - Multipurpose Ecommerce Responsive Html Template" />
    <meta name="author" content="webaashi.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Print</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Master Css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet" id="colors">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<?php $cardno = $_GET['card_no']; ?>
      
        <p>Printing Receipt<p>
       <?php
            $prod = $_SESSION['product_ref'];
            $value = custom_query("SELECT * FROM tbl_cart WHERE product_ref = '$prod' ORDER BY ID DESC");
            if($value->rowCount()>0)
            {
                while($row=$value->fetch(PDO::FETCH_ASSOC)) {
                   $data[] =  "Product: " . $row['name'] . "\nQuantity: " . $row['qty'] . "\nSize: " . $row['size'] . "\nColor: " . $row['color'];
                }
            }
            ?>
        <?php
        $order = "";
        foreach ($data as $key => $value){
            $order .= substr($key . ": ". $value . "\n\n", 3);

        }
//        print_r($data);
        ?>
        <p> Total:  <?php echo number_format($sum = sum('tbl_cart', 'price', $data = array("product_ref" => $_SESSION['product_ref'])) * $qty = sum('tbl_cart', 'qty', $d2 = array("product_ref"=>$_SESSION['product_ref']))); ?></p>

        <?php
        //print all data to python terminal
        $ref = $_SESSION['product_ref'];
        $dt = date('Y/m/d h:i:s');
        $capture = system('sudo ./camera.sh');
        $last_line = system("echo '================================\n\nThe Fashion Shop - Product Order\n\n\nReference Number: $ref\n\nCard No: $cardno \nOrders: \n$order \n\nTotal: $sum\n\n\t\t$dt\n\n================================\n\n\n' > /dev/ttyUSB0", $retval)
        ?>

        <?php
        $data = array(
            "product_ref"=>$_SESSION['product_ref'],
            "product_total"=>$sum,
            "card_no"=>$cardno
        );
            $insert = db_insert('tbl_orders', $data);
            $update = db_update('tbl_cart', $data = array("status"=>"Ordered"), $where = array("product_ref"=>$_SESSION['product_ref']));

session_destroy();
        ?>
</body>
</html>
