<!DOCTYPE html>
<html>
<head>
	<title>PHRandom</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="front/fonts/SF Display/SFUIDisplay.css">
	<link rel="stylesheet" href="/front/css/styles.css">
	<script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery.redirect@1.1.4/jquery.redirect.min.js"></script>
	<script src="/front/js/ajax.js"></script>
  
</head>
<body>
	<div class="wrapper container-fluid ">
		<div class="placeholder align-items-center text-center" style="height: 100vh;"><?=$local->service->brand?></div>
		<div id="step_0">
			<div class="row justify-content-center align-items-center" style="height: 100vh;" >
				<div class="col-md-12 h1 text-center">
				   	<?=$local->service->{"18-question"}?><br>
			    
		     	<button class="btn btn-success btn-lg" onclick='next_step("step_1", "step_0")' href="#"><?=$local->service->yes?></button>
		     	<button class="btn btn-danger btn-lg" onclick='not_18()' href="#"><?=$local->service->no?></button>
				</div>
			</div>
		</div>
		<div id="step_1" style="display: none;">
			<div class="row justify-content-center align-items-center" style="height: 100vh;">
		     	<div class="b-md-4 col-md-3 h1 block" onclick='next_step("step_2_c", "step_1")' href="#"><i class="fas fa-venus-mars fa-4x"></i> <br><?=$local->service->classic?></div>
		     	<div class="b-md-4 col-md-3 h1 block" onclick='next_step("step_2_g", "step_1")'> <i class="fas fa-mars-double fa-4x"></i> <br><?=$local->service->gay?></div>
		     	<?
		    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' );
					$data = json_decode($j);
				?>
		     	<div class="b-md-4 col-md-3 h1 block" onclick='viewer("all")'><i class="fas fa-dice fa-4x"></i> <br><?=$local->service->{"absolutely-random"}?></div>
			</div>
		</div>
		<div id="step_2_c" style="display: none;">
			<div class="row  justify-content-center align-items-center" style="height: calc(100vh - 20px);">
		    	<button class="btn back-button" onclick='next_step("step_1","step_2_c")'><i class="fas fa-arrow-left fa-2x"></i></button>
		    	<div class="row  justify-content-center align-items-center" style="height: calc(100vh - 20px);">
			    	<div class="col-md-12 block h2 text-center"><?=$local->service->{"most-popular"}?></div>
			    	<div class="row col-md-12 justify-content-center">
			    	<?
				    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
				    		$data = json_decode($j);
				    		echo '<div id="all_classic" class="b-md-4 h3 block" onclick=\'cat_all("classic")\'>'.$local->service->all.'</div>';
							for($i = 0; isset($data->{"popularClassic"}[$i]); $i++){
								echo '<div id="'.$data->{"popularClassic"}[$i].'" class="b-md-4 h3 block" onclick=\'cat_clicked("'.$data->{"popularClassic"}[$i].'", false)\'>'.$local->{"categories"}->{$data->{"popularClassic"}[$i]}.'</div>';
							}
						?>
					</div>
					<button id="allB" class="btn btn-light btn-lg col-md-6 more-btn" onclick='next_step("other", "allB")'><?=$local->service->more?></button>
					<button id="lessB" style="display: none;" class="btn btn-light btn-lg col-md-6 more-btn" onclick='next_step("allB", "other")'><?=$local->service->less?></button>
				</div>
				<div id="other" class="row col-md-12 justify-content-center" style="display: none;transition: 0.5s;">
					<div class="col-md-12"></div>
					<div class="row text-center justify-content-center">
					<?
			    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' );
						$data = json_decode($j);
						for($i = 0; isset($data->{"classic"}[$i]); $i++){
							$duplicate = false;
							for($j = 0; isset($data->{"popularClassic"}[$j]); $j++)
								if($data->{"classic"}[$i] == $data->{"popularClassic"}[$j])
									$duplicate = true;
							if(!$duplicate)
								echo '<div id="'.$data->{"classic"}[$i].'" class="b-md-4 h3 block" onclick=\'cat_clicked("'.$data->{"classic"}[$i].'", false)\'>'.$local->{"categories"}->{$data->{"classic"}[$i]}.'</div>';
						}
					?>
					</div>
				</div>
		     	<button class="btn btn-light go-btn" id="go-btn" style="display:none;" onclick='viewer()'><h1>Go!</h1></button>
		    </div>	
		</div>
		<div id="step_2_g" style="display: none;">
			<div class="row justify-content-center">
		    	<button class="btn back-button" onclick='next_step("step_1","step_2_g")'><i class="fas fa-arrow-left fa-2x"></i></button>
			    <div class="row  justify-content-center align-items-center" style="height: calc(100vh - 20px);">	
			    	<div class="col-md-10 block h2 text-center"><?=$local->service->{"most-popular"}?></div>
			    	<div class="row col-md-12 justify-content-center">
			    	<?
			    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' );
						$data = json_decode($j);
						echo '<div id="all_gay" class="b-md-4 h3 block" onclick=\'cat_all("gay")\'>'.$local->service->all.'</div>';
						for($i = 0; isset($data->{"popularGay"}[$i]); $i++){
							echo '<div id="'.$data->{"popularGay"}[$i].'" class="b-md-4 h3 block" onclick=\'cat_clicked("'.$data->{"popularGay"}[$i].'", false)\'>'.$local->{"categories"}->{"Gay"}->{$data->{"popularGay"}[$i]}.'</div>';
						}
					?>
					</div>
					<button id="allB1" class="btn btn-light btn-lg col-md-6 more-btn" onclick='next_step("other1", "allB1")'><?=$local->service->more?></button>
					<button id="lessB1" style="display: none;" class="btn btn-light btn-lg col-md-6 more-btn" onclick='next_step("allB1", "other1")'><?=$local->service->less?></button>
				</div>
				
				<div id="other1" class="row col-md-12 justify-content-center" style="display: none">
					<div class="col-md-12"></div>
					<div class="row text-center justify-content-center">
					<?
			    		$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
						$data = json_decode($j);
						for($i = 0; isset($data->{"gay"}[$i]); $i++){
							$duplicate = false;
							for($j = 0; isset($data->{"popularGay"}[$j]); $j++)
								if($data->{"gay"}[$i] == $data->{"popularGay"}[$j])
									$duplicate = true;
							if(!$duplicate)
									echo '<div id="'.$data->{"gay"}[$i].'" class="b-md-4 h3 block" onclick=\'cat_clicked("'.$data->{"gay"}[$i].'", false)\'>'.$local->{"categories"}->{"Gay"}->{$data->{"gay"}[$i]}.'</div>';
								
						}
					?>
					</div>
				</div>
		     	<button class="btn btn-light go-btn" id="go-btn" style="display:none;" onclick='viewer()'><h1>Go!</h1></button>
			</div>
		</div>
	</div>
</body>
</html>