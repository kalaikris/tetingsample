<?php
	include 'php/site-config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>404 | page not found</title>
    <link rel="icon" href="asset/fav-icon.png" />
    <link rel="stylesheet" href="css/404.css<?php echo $cache_str; ?>"/>
    
</head>
<body>
    <section class="">
        <div class="container-fluid">
            <div class="row">
            	<div class="error-mg-box">
            		<div class="error-mg-subbox">
	            		<img src="asset/404.svg" class="error-img desktop" alt="404 img" draggable="false">
	            		<img src="asset/404.svg" class="error-img mobile" alt="404 img" draggable="false">
	            		<div class="btn-box">
							<!-- <button id="go_to_home">Back to home</button> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src='js/jquery.min.js'></script>
	<script type="text/javascript">
		// $('#go_to_home').on('click',function(){
		//     window.location.href = "index";
		// });
	</script>
</body>
</html>