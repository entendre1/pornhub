

<!DOCTYPE html>
<html>
<head>
	<title>rhub.dev</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/front/css/styles.css">
	<script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery.redirect@1.1.4/jquery.redirect.min.js"></script>
	<script src="/front/js/ajax.js"></script>
  
</head>
<body>
	<div class="wrapper container-fluid ">
		<div id="step_0">
			<div class="row step justify-content-center">
				<div class="col-md-12 h1 text-center">
				   	Are you 18+ years old?
			    </div>
		     	<button class="btn btn-success btn-lg" onclick='next_step("step_1", "step_0")' href="#">Yes</button>
		     	<button class="btn btn-danger btn-lg" onclick='not_18()' href="#">No</button>
			</div>
		</div>
		<div id="step_1" style="display: none;">
			<div class=" row col-md-12 step justify-content-center">
		     	<div class="b-md-4 col-md-2 h1 block" onclick='next_step("step_2_c", "step_1")' href="#"><i class="fas fa-venus-mars fa-4x"></i> <br> Classic</div>
		     	<div class="b-md-4 col-md-2 h1 block" onclick='viewer("gay")'> <i class="fas fa-mars-double fa-4x"></i> <br>Gay</div>
		     	<div class="b-md-4 col-md-2 h1 block" onclick='viewer("lesbian")'><i class="fas fa-venus-double fa-4x"></i> <br>Lesbian</div>
			</div>
		</div>
		<div id="step_2_c" style="display: none;">
			<div class="row col-md-12 justify-content-center">
		    	<button class="btn back-button" onclick='next_step("step_1","step_2_c")'><i class="fas fa-arrow-left fa-2x"></i></button>
		     	<div id="anal" class="b-md-4 col-md-4 h1 block" onclick='cat_clicked("anal")'>Anal</div>
		     	<div id="creampie" class="b-md-4 col-md-4 h1 block" onclick='cat_clicked("creampie")'>Creampie</div>
		     	<div id="cartoon" class="b-md-4 col-md-4 h1 block" onclick='cat_clicked("cartoon")'>Cartoon</div>
		     	<button class="btn btn-light d-fixed go-btn" onclick='viewer()'><h1>Go!</h1></button>
			</div>
		</div>
	</div>
</body>
</html>