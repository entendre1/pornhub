<?
	$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/front/lang/en_US.local' ); 
	$local = json_decode($j);
?>
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
		     	<div class="b-md-4 col-md-2 h1 block" onclick='next_step("step_2_c", "step_1")' href="#"><i class="fas fa-venus-mars fa-4x"></i> <br>Classic</div>
		     	<div class="b-md-4 col-md-2 h1 block" onclick='next_step("step_2_g", "step_1")'> <i class="fas fa-mars-double fa-4x"></i> <br>Gay</div>
		     	<?
		    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
					$data = json_decode($j);
				?>
		     	<div class="b-md-4 col-md-2 h1 block" onclick='viewer("all")'><i class="fas fa-dice fa-4x"></i> <br>Absolutely Random</div>
			</div>
		</div>
		<div id="step_2_c" style="display: none;">
			<div class="row col-md-12 justify-content-center">
		    	<button class="btn back-button" onclick='next_step("step_1","step_2_c")'><i class="fas fa-arrow-left fa-2x"></i></button>
		    	<div class="col-md-10 block h2 text-center">Most popular:</div>
		    	<?
		    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
					$data = json_decode($j);
					for($i = 0; isset($data->{"popularClassic"}[$i]); $i++){
						echo '<div id="'.$data->{"popularClassic"}[$i].'" class="b-md-4 col-md-2 h3 block" onclick=\'cat_clicked("'.$data->{"popularClassic"}[$i].'")\'>'.$local->{$data->{"popularClassic"}[$i]}.'</div>';
					}
				?>
				<button id="allB" class="btn btn-light btn-lg col-md-6" onclick='next_step("other", "allB")'>More</button>
				
				<div id="other" class="row col-md-12 justify-content-center" style="display: none">
					<button class="btn btn-light btn-lg col-md-6" onclick='next_step("allB", "other")'>Less</button>
					<div class="col-md-12"></div>
					<?
			    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
						$data = json_decode($j);
						for($i = 0; isset($data->{"classic"}[$i]); $i++){
							for($j = 0; isset($data->{"popularClassic"}[$j]); $j++)
								if($data->{"classic"}[$i] == $data->{"popularClassic"}[$j])
									break;
							echo '<div id="'.$data->{"classic"}[$i].'" class="b-md-4 col-md-2 h3 block" onclick=\'cat_clicked("'.$data->{"classic"}[$i].'")\'>'.$local->{$data->{"classic"}[$i]}.'</div>';
						}
					?>
				</div>
		     	<button class="btn btn-light d-fixed go-btn" onclick='viewer()'><h1>Go!</h1></button>
			</div>
		</div>
		<div id="step_2_g" style="display: none;">
			<div class="row col-md-12 justify-content-center">
		    	<button class="btn back-button" onclick='next_step("step_1","step_2_g")'><i class="fas fa-arrow-left fa-2x"></i></button>
		    	<div class="col-md-10 block h2 text-center">Most popular:</div>
		    	<?
		    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
					$data = json_decode($j);
					for($i = 0; isset($data->{"popularGay"}[$i]); $i++){
						echo '<div id="'.$data->{"popularGay"}[$i].'" class="b-md-4 col-md-2 h2 block" onclick=\'cat_clicked("'.$data->{"popularClassic"}[$i].'")\'>'.$local->{"Gay"}->{$data->{"popularGay"}[$i]}.'</div>';
					}
				?>
				<button id="allB1" class="btn btn-light btn-lg col-md-6" onclick='next_step("other1", "allB1")'>More</button>
				
				<div id="other1" class="row col-md-12 justify-content-center" style="display: none">
					<button class="btn btn-light btn-lg col-md-6" onclick='next_step("allB1", "other1")'>Less</button>
					<div class="col-md-12"></div>
					<?
			    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
						$data = json_decode($j);
						for($i = 0; isset($data->{"gay"}[$i]); $i++){
							for($j = 0; isset($data->{"popularGay"}[$j]); $j++)
								if($data->{"gay"}[$i] == $data->{"popularGay"}[$j])
									break;
							echo '<div id="'.$data->{"gay"}[$i].'" class="b-md-4 col-md-2 h2 block" onclick=\'cat_clicked("'.$data->{"gay"}[$i].'")\'>'.$local->{"Gay"}->{$data->{"gay"}[$i]}.'</div>';
						}
					?>
				</div>
		     	<button class="btn btn-light d-fixed go-btn" onclick='viewer()'><h1>Go!</h1></button>
			</div>
		</div>
	</div>
</body>
</html>