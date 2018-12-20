<?php require_once '../controller/action.php'; ?>

<?php
$_SESSION['user_start'] = time();
if($action->is_loggedin() !=''){

    if($_SESSION['role']=='Super Admin'){
        redirect('../superadmin/dashboard.php');
    }
    else if($_SESSION['role']=='Admin')
    {
        redirect('../admin/dashboard.php');
    } 

}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($action->login($username, $password)){
        unset($_SESSION['pinError']);
    }
    else{
        redirect('index.php?Error');
    }

}

if(isset($_POST['pinLogin'])){
    $expireAfter = 3;
    $secondsInactive = time() - $_SESSION['last_action'];

    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 10;

    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        unset($_SESSION['last_action']);
    }

	if($action->pinLogin($_POST['pin'])){

	}
	else{
			$capture = system('sudo ./camera.sh');
        //minutes or more.


        //Check to see if our "last action" session
        //variable has been set.
        if(isset($_SESSION['last_action'])){

            //Figure out how many seconds have passed
            //since the user was last active.

            if(isset($_SESSION['pinError'])){
                  $_SESSION['pinError'] = $_SESSION['pinError'] + 1;
            }
            else {
                $_SESSION['pinError'] = 1;
            }
            if($_SESSION['pinError'] > 3){
                $error[] = 'your Account is now Locked Please reload this page after a few minutes';
            }


        }

        //Assign the current timestamp as the user's
        //latest activity
        $_SESSION['last_action'] = time();

        $error[] = "The pin you entered is invalid";
	}
}

if(isset($_POST['fprint'])){
	$data = system('sudo python search_fp.py');// Printing additional info
	if($data!="error" || $data!="e"){
		$value = custom_query("SELECT * FROM tbl_client WHERE fp_template ='$data'");
		if($value->rowCount()>0){
			while($row=$value->fetch(PDO::FETCH_ASSOC))
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['lastname'] = $row['lastname'];
				$_SESSION['port'] = $row['locker_no'];
				$_SESSION['locker_no'] = $row['locker_no'];
				$_SESSION['fp_template'] = $row['fp_template'];	
				redirect('dashboard.php');
			}
			
		}
		else{
				$capture = system('sudo ./camera.sh');

				$error[] = 'User Fingerprint is not registered, Please contact administrator';
			}
	}
	else{
	    $error[] = 'There was an error with the server';
	}

}
?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from xvelopers.com/demos/html/paper-panel-1.0.1/login-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jun 2018 06:12:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/basic/favicon.ico" type="image/x-icon">
    <title><?php echo $APP_NAME; ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/app.css">
    
	<link rel="stylesheet" href="jquery.numpad.css">


		<style type="text/css">
			.nmpd-grid {border: none; padding: 20px;}
			.nmpd-grid>tbody>tr>td {border: none;}
			
			/* Some custom styling for Bootstrap */
			.qtyInput {display: block;
			  width: 100%;
			  padding: 6px 12px;
			  color: #555;
			  background-color: white;
			  border: 1px solid #ccc;
			  border-radius: 4px;
			  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
			  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			}
		</style>
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
</head>
<body class="light">
<!-- Pre loader -->

<div id="app">
    <main>
        <div id="primary" class="p-t-b-100 height-full ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mx-md-auto">
                        <div class="text-center">
                            <img src="../assets/img/dummy/u5.png" alt="">
                            <h3 class="mt-2">Electronic Locker</h3>
                            <p class="p-t-b-20">Welcome Back! Login using your pin or fingerprint</p>
                        </div>
                        <form action="" method="POST">
							<div class="form_group">
                                <button type="submit" name="fprint" class="btn btn-success btn-lg btn-block"> Login with Fingerprint</button>
							</div>
                        </form>
                        <hr />
                        <br />
                        <div class="form-group">
							<a href="#" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#pin"> Login with Pin</a>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
        <!-- #primary -->
    </main>
</div>
<div class="modal fade" id="pin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                     <div class="form-group">
                        <label>Enter your Pin Number</label>
                        <input type="number" name="pin" class="form-control" id="text-basic" required />
                    </div>
                    <div class="form-group">
						<button type="submit" class="btn btn-block btn-warning" name="pinLogin">Enter</button>
                    </div>                    
                </div>
               
            </div>
        </form>
    </div>
</div>
<?php if(isset($_SESSION['toastr'])){ ?>
    <div class="toast"
         data-title="<?php echo $_SESSION['toastr']['title']; ?>"
         data-message="<?php echo $_SESSION['toastr']['message']; ?>"
         data-type="<?php echo $_SESSION['toastr']['type']; ?>">
    </div>
<?php }?>
<?php
if(isset($error))
{
    foreach($error as $error)
    {
        ?>
        <div class="toast"
             data-title="Error"
             data-message="<?php echo $error; ?>"
             data-type="error">
        </div>
    <?php } }?>
<!--/#app -->
<script src="../assets/js/app.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    $("#fingerprintScan").click(function(){
        setTimeout(6000);
        $.ajax({

            type: 'POST',

            url: 'fp_scan.php',

            success: function(data) {
                console.log(data);
                if(data == 'Success')
					alert('Success')
				else
					alert('Error')

            }

        });

});

});

</script>
<script src="jquery.numpad.js"></script>
		<script type="text/javascript">
			// Set NumPad defaults for jQuery mobile. 
			// These defaults will be applied to all NumPads within this document!
			$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
			$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
			$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
			$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
			$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
			$.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};
			
			// Instantiate NumPad once the page is ready to be shown
			$(document).ready(function(){
				$('#text-basic').numpad();
				$('#password').numpad({
					displayTpl: '<input class="form-control" type="password" />',
					hidePlusMinusButton: true,
					hideDecimalButton: true	
				});
				$('#numpadButton-btn').numpad({
					target: $('#numpadButton')
				});
				$('#numpad4div').numpad();
				$('#numpad4column .qtyInput').numpad();
				
				$('#numpad4column tr').on('click', function(e){
					$(this).find('.qtyInput').numpad('open');
				});
			});
		</script>
</body>

</html>
