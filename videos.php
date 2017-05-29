<?php

	if(isset($_POST['submit_all_your_measurements'])){
	
				unset($_POST['submit_all_your_measurements']);
			
				
				$hidden_gender=$_POST['hidden_gender'] ; 
				
				unset($_POST['hidden_gender']) ;
				
				$json_format=json_encode($_POST);
				
				$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
			$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
				$connection = $resource->getConnection();
				$Front_end_Measurement_settings = $resource->getTableName('Front_end_Measurement_settings') ;
				
				$sql = "INSERT INTO " . $Front_end_Measurement_settings . "(Gender,ALL_Measurement_types) VALUES ('".$hidden_gender."','".$json_format."')";
				$connection->query($sql); 
				echo "Your Provided Male data has been successfully saved" ;
			
	} 
	
	if(isset($_POST['submit_all_your_Female_measurements'])){
		
			unset($_POST['submit_all_your_Female_measurements']);
			
				
				$hidden_gender=$_POST['hidden_gender'] ; 
				
				unset($_POST['hidden_gender']) ;
				
				$json_format=json_encode($_POST);
				
				$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
			$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
				$connection = $resource->getConnection();
				$Front_end_Measurement_settings = $resource->getTableName('Front_end_Measurement_settings') ;
				
				$sql = "INSERT INTO " . $Front_end_Measurement_settings . "(Gender,ALL_Measurement_types) VALUES ('".$hidden_gender."','".$json_format."')";
				$connection->query($sql); 
				echo "Your Provided Female data has been successfully saved" ;
		
	}
	
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
	$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
	$connection = $resource->getConnection();

	$Measurement_settings = $resource->getTableName('Measurement_settings') ;
	$select_gender="Male_choosen";
	$select_gender_one="Female_choosen";

	$sql = "SELECT * FROM " . $Measurement_settings . " WHERE Gender='".$select_gender."'";
	$result = $connection->fetchAll($sql); 
	
	$sql_one = "SELECT * FROM " . $Measurement_settings . " WHERE Gender='".$select_gender_one."'";
	$result_one = $connection->fetchAll($sql_one); 

?>				
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<style>
*{margin:0px;padding:0px;}
.tailer{width:550px;margin:0px auto;}
.top-icon li {
    display: inline-block;
    padding-left: 25px;
}
.top-icon {text-align: center;padding: 20px 0 0px;}
.tail-1 li{
    position: relative;
	margin-right: 15px;
	cursor: pointer;
}
.tail-1 li p:after {
    content: "";
    border: 2px solid #333;
    width: 20px;
    height: 20px;
    border-radius: 30px;
    position: absolute;
    left: 0;
    top: 0;
}
.tail-1 li p:hover:after {
    background-color: #333;
}
.tail-1 li:last-child {
    margin-right: 0;
}
.div-im img {
    width: 100%;
}
.div-im {
    box-shadow: 5px 5px 5px #ddd;
}
.inc-dec {
    text-align: center;
    padding: 20px 0;
}
.inc-dec p {
    margin-bottom: 15px;
}
.inc-dec .altera {
    width: 20px;
}
.inc-dec input.in-p {
    width: 100px;
    text-align: center;
	vertical-align: top;
}
.tail-1 li a {
    text-decoration: none;
    color: #333;
}
.inc-dec p strong {
    background-color: #ddd;
    color: #000;
    padding: 5px;
}
.after_cond .carousel-indicators {
    bottom: -10px;
}
.after_cond .carousel-indicators li {
    background-color: #333;
}
.after_cond .carousel-indicators li.active{background-color: #4285f4;}
</style>
<script type="text/javascript">

	  $(document).ready(function(){
	  
		$("#select_style").hide();
		$(".Male_slider").hide();
		$(".Female_slider").hide();
		
		$('.new-form').on('submit', function (e) {
			
			e.preventDefault();
		
			var select_gender = $("select[name='select_gender']").val() ;
		
			$.ajax({ 
				type:"POST",
				url:"<?php echo $block->getUrl('excellence/Hello/checkboxrequest') ;?>",
				data: {'select_gender': select_gender},
					success: function(response){
						if(response == "Male_choosen"){
						
							$("#gender_heading").hide();
							$("#submit-id").hide();
							$("#nn").hide();
							
							$("#select_style").show();
							$(".Male_slider").show();
						}
						else{
							$("#gender_heading").hide();
							$("#submit-id").hide();
							$("#nn").hide();
							
							$("#select_style").show();
							$(".Female_slider").show();
						}
					}	
			}); 
			
		});
	});  
</script>


 <!-- choose Gender Modal Modal -->
 
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="gender_heading" class="modal-title">Select Gender</h4>
        <h4 id="select_style" class="modal-title">Select Style</h4>
      </div>
	  
		  <div class="modal-body">
		  
			 <form class="new-form" method="POST" enctype="multipart/form-data">
				<div id="nn" class="text-inner">
					<select name="select_gender">
						<option value="Male_choosen">Male</option>
						<option value="Female_choosen">Female</option>
					</select>
				</div>
				<br/>
				<br/>
				<br/>
				
				<div id="submit-id" class='text-inner'>
					<input type="submit" name="save_file" value="START"/>
				</div>
				
			 </form> 
			 
			 
			 
			 
			 <!-- Slider for the Male measurements-->
			 <form action="" class="frontend-form" method="POST" enctype="multipart/form-data">
			 
				<div class="Male_slider"> 
					 
					 <div id="myCarousel" class="carousel slide" data-interval="false">
					  
						<div class="carousel-inner">
						
							<?php 
							if(!empty($result)){
							?>	
							<div class='item active'>
									<div class='video-section'>
											<video id="video-first-male" width="320" height="240" controls>
												<source src="<?php echo $result['0']['video_url'] ;?>">
											</video>
									</div>
								
									<input type='hidden' name='hidden_gender' value='Male_Measurement'/>
									
									<div class='measurements fields'>
											<label>Input your <?php echo $result['0']['Measurement_type'] ;?>  Measurements</label>
											
											<input type='text' name='<?php echo $result['0']['Measurement_type'] ;?>' value=''/>
									</div>
							</div>	
							<?php		
								unset($result['0']) ;
							
								foreach($result as $key => $value){
							?>
								<div class='item'>
										<div class='video-section'>
											<video id="<?php echo $key ;?>" width="320" height="240" controls>
											<source src="<?php echo $value['video_url'] ;?>">
											</video>
										</div>
										<div class='measurements fields'>
											<label>Input your <?php echo $value['Measurement_type'] ;?>  Measurements</label>
											<input type='text' name='<?php echo $value['Measurement_type'] ;?>' value=''/>
										</div>
								</div>
								<?php		
								}
								?>
								<div class='item'>
									<input type="submit" name="submit_all_your_measurements" value="submit all your measurements"/>
								</div>
							
							<?php			
							}
							?>
						</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only">Next</span>
							</a>
					</div>
				
				</div>
				
			</form>
			
			 <!-- Slider for the Female measurements-->
			 
		 <form action="" class="frontend-form" method="POST" enctype="multipart/form-data">
			<div class="Female_slider"> 
				 
				 <div id="myCarouselone" class="carousel slide" data-interval="false">
				 
					<div class="carousel-inner">
					
						<?php 
						if(!empty($result_one)){
						?>
							<div class='item active'>
								<div class='video-section'>
								
									<video id="video-first-female" width="320" height="240" controls>
									<source src="<?php echo $result_one['0']['video_url'] ;?>">
									</video>
								</div>
								
								<input type='hidden' name='hidden_gender' value='Female-Measurement'/>
								
								<div class='measurements fields'>
										<label>Input your <?php echo $result_one['0']['Measurement_type'] ;?>  Measurements</label>
										<input type='text' name='<?php echo $result_one['0']['Measurement_type'] ;?>' value=''/>
								</div>
							</div>
						<?php	 
							unset($result_one['0']) ;
							
							foreach($result_one as $key => $value){
								?>
								<div class='item'>
									<div class='video-section'>
										<video width="320" height="240" controls>
										<source src="<?php echo $value['video_url'] ;?>">
										</video>
									</div>
									<div class='measurements fields'>
										<label>Input your <?php echo $value['Measurement_type'] ;?>  Measurements</label>
										<input type='text' name='<?php echo $value['Measurement_type'] ;?>' value=''/>
									</div>
								</div>
								<?php
							}
							?>
							<div class='item'>
									<input type="submit" name="submit_all_your_Female_measurements" value="submit all your measurements"/>
							</div>
						<?php			
						}
						?>
					</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarouselone" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarouselone" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
						</a>
				</div>
			
			</div>
		</form>
			 
			 
			 
						 
				
			 
			 
		  </div>
	 </div>

  </div>
</div>

 

      