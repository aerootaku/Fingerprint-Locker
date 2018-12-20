<?php require_once '../controller/action.php'; ?>

<?php



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
                            <h5 class="p-t-b-20">Welcome <strong><?= $_SESSION['firstname'] . " ". $_SESSION['lastname']; ?> </strong></h5>
                          
                        </div>
                        <hr />
                        <div class="form-group">
							<button type="button" id="openLocker" class="btn btn-info btn-lg btn-block">OPEN</button>
                        </div>   
                        <div class="form-group">
							<button type="button" id="closeLocker" class="btn btn-warning btn-lg btn-block">CLOSE</button>
                        </div>    
                        <div class="form-group">
							<a href="logout.php?logout=true" class="btn btn-danger btn-lg btn-block"> LOGOUT</a>
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

<!--/#app -->
<script src="../assets/js/app.js"></script>
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#openLocker").click(function(){
			console.log("hello");
			$.ajax({
				type: 'POST',
				url: 'open.php',
				success: function(data) {
					$("#result").html(data);
					console.log("success");

				}
			});
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#closeLocker").click(function(){
			console.log("hello");
			$.ajax({
				type: 'POST',
				url: 'close.php',
				success: function(data) {
					$("#result").html(data);
					console.log("success");

				}
			});
   });
});
</script>
</body>

</html>
