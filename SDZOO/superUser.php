#!/usr/local/bin/php -d display_errors=STDOUT
<?php
session_start();
date_default_timezone_set('America/Los Angeles');
?>
<?php
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

$query = "SELECT * FROM zookeeper_name WHERE id = '" . $_SESSION['id']."'";

$result = mysql_query($query);

$row1 = mysql_num_rows($result);
if($row1==0)
	{
	header( 'Location: login.php' ) ;
	}
/*else
	{
	header( 'Location: login.php' ) ;
/*	}*/
$row = mysql_fetch_array($result);
$name=$row['name'];
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; chaarset=UTF-8">
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
	

	</head>

  <body>
    <!-- Top NAVBAR -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><i class= "icon-leaf icon-white"></i>San Diego Zoo</a>
          
          <div class="nav-collapse">
            <!--User button -> edit sign off feature) !-->

            <ul class="nav pull-right">           
            	<div class="btn-group">
          			<a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i><?php echo $name;?></a>
          			<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
          			<ul class="dropdown-menu">
            			 <li><a href="login.php"><i class="i"></i> Sign off </a></li>
          			</ul>
        		</div>
        	</ul>
        	<!--END OF User button -> edit sign off feature) !-->	
        	
        	
         
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<!-- End of Top NAVBAR -->
    
    <!-- Beginning of body -->
    <div class="container">
	    
	    <div class="tabbable"> <!-- Only required for left/right tabs -->
    		<ul class="nav nav-tabs">
   				<li class="active"><a href="#tab1" id="Animals" data-toggle="tab">Animals</a></li>
   				<li><a href="#tab2" id="Zookeepers" data-toggle="tab">Zookeepers</a></li>
    			<li><a href="#tab3" id="EA" data-toggle="tab">Enrichment Activity</a></li>
    		</ul>
    		<!-- Individual Tab's Content -->
    		<div class="tab-content">
    			
    			<!--TAB ONE -->
    			<div class="tab-pane active" id="tab1">
    			<div class = "row twoOptionsAnimal">
    			<br/><br/><br/>
    				<div class = "span3 offset3">
    				 	<a class="btn btn-primary btn-large" data-toggle="modal" id="AddNewAnimal"  href="#newAnimal" >Add New Animal</a>
    				</div>
    				 <a class="btn btn-success btn-large" id="VE_CurrentAnimals">View/Edit Current Animals</a> 
    			</div>
    			
    			<div id="addAnimalZK"></div>
				
    			<div class = "CurrentAnimals">
    			<h4>Input Animal Name:</h4> 
    			
    			<div class="row">
    				<div class ="well form-search">
    				<div class ="span3">				
            			<input type="text" id="animName"  class="span3 input-medium search-query" placeholder ="House Name" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php
							$animal_list = mysql_query("SELECT animal_name FROM animal");
					
							$output = "";
							while($row = mysql_fetch_array($animal_list)){
								$output .= "\"";
								$output .= $row['animal_name'];
								$output .= "\",";
							}	
		
							$output = rtrim($output, "\,");
							echo $output;
						?>]'>
    				</div>
  					<div class = "span3 offset1">
    				 	<a class="btn btn-primary btn-large" id="VE_Zookeepers">View/Edit Zookeepers</a>
    				 </div>
    				 <a class="btn btn-success btn-large" id="DeleteAnimal">Remove From Zoo</a> 	  	
    				</div>
    			</div>
								<div id="zkTable"></div>

    			</div>
					
  					
  					
  	  		    </div>
    			<!--END OF TAB ONE -->
    			
    			
    			<!-- Tab TWO -->
    	
    			<div class="tab-pane" id="tab2">

					<div class = "row twoOptionsZK">
					<br/><br/><br/>
						<div class = "span3 offset3">
							<a class="btn btn-primary btn-large" data-toggle="modal" id="AddNewZK"  href="#newZK">Add New Zookeeper</a>
						</div>
						 <a class="btn btn-success btn-large" id="VE_CurrentZK">View/Edit Current Zookeeper</a> 
					</div>	

				</div>
				
				<div class="CurrentZKs">
					<h4>Input Zookeeper Name:</h4>
					<div class="row">
						<div class="well form-search">
							<div class="span3">
								<input class="span3 input-medium search-query" id="zk_name" type="text" placeholder="Zookeeper Name" data-provide="typeahead" data-items="4" data-source='[<?php
									$animal_list = mysql_query("SELECT name FROM zookeeper_name");
							
									$output = "";
									while($row = mysql_fetch_array($animal_list)){
										$output .= "\"";
										$output .= $row['name'];
										$output .= "\",";
									}	
				
									$output = rtrim($output, "\,");
									echo $output;
								?>]'>
							</div>
							<div class="span3 offset1">
								<a class="btn btn-primary btn-large" id="ViewZKData">View Zookeeper Data</a>
							</div>
								<a class="btn btn-success btn-large" id="DeleteZK">Remove Zookeeper</a>		
					
						</div>
								<div id="zkDataTable"></div>
					</div>
				</div>
    		<!-- END OF TAB TWO -->	
    		
    	<div class="tab-pane" id="tab3">
    	
    	    	<div class = "row twoOptionsEnrichment">
    			<br/><br/><br/>
    				<div class = "span3 offset3">
    				 	<a class="btn btn-primary btn-large" id="e_info">Species Enrichment Info</a>
    				</div>
    				  <a class="btn btn-large btn-success" data-toggle="modal" id="Add_Enrichment"  href="#newEnrichment" >Add New Enrichment Item</a>
    			</div>
    			<div id="EnrichmentForSpecies">
    				<p>Input species:</p> 
    			
    				<div class="row">
    				<div class ="well form-search">
    				<div class ="span3">				
            			<!---Get species--->
            			<input type="text" id="AnimalSpecies_E" class="span3 input-medium search-query" placeholder ="Animal Species" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php 
							$animal_list = mysql_query("SELECT DISTINCT species_name FROM animal_species");

							$output = "";
							while($row = mysql_fetch_array($animal_list)){
								$output .= "\"";
								$output .= $row['species_name'];
								$output .= "\",";
							}	

							$output = rtrim($output, "\,");
							echo $output;
						?>]'>
    				</div>
    				<div class = "offset4">
    				 <a class="btn btn-info btn-large" id="viewEnrichmentFromSpecies">View/Edit Enrichment Info</a> 	
    				 </div>
    			 </div>
    			</div>
    			<div id="ShowEnrichmentFromSpecies"></div>
    			
    			</div>
    		</div>
    		<!--End of Tab 3 -->
    		
    		
    		
    		</div>
    	</div>
	
	<!--End of Tabbable Content -->
	
	
		<!-- Modal Drop Down to Input New Enrichment -->
    				 <div id="newEnrichment" class="modal hide fade">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h3>Add New Enrichment</h3>
							</div>
							<div class="modal-body">
								    <div class="form-horizontal">
										<fieldset>
											<div class="control-group">
												<label class="control-label" for="animID">Item:</label>
													<div class="controls">
														<input type="text" class="span2 input-xlarge" id="en_name" >
									
													</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="animName">Category:</label>
													<div class="controls">
														<input type="text" class="input-xlarge" id="en_cat">
												
													</div>
											</div>	
											
											<div class="control-group">
												<label class="control-label" for="animName">SubCategory:</label>
													<div class="controls">
														<input type="text" class="input-xlarge" id="en_subcat">
												
													</div>
											</div>	
								
										</fieldset>
									</div> <!--FORM-->
																	
									
							
							</div>
							<div class="modal-footer">
								<a class="btn btn-info btn-large" id="submitEnrich" data-dismiss="modal">Add New Enrichment Information</a>
							</div>
						</div>
						<!-- END OF Modal Drop Down to Input New Enrichment -->
	
	
	
	
	 
    	<!-- Modal Drop Down to Input New Obervation -->
    				 <div id="newAnimal" class="modal hide fade">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h3>Add New Animal</h3>
							</div>
							<div class="modal-body">
								    <div class="form-horizontal">
										<fieldset>
											<div class="control-group">
												<label class="control-label" for="animID">Animal ID:</label>
													<div class="controls">
														<input type="text" class="span2 input-xlarge" id="animal_ID" >
									
													</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="animName">House Name:</label>
													<div class="controls">
														<input type="text" class="input-xlarge" id="animal_Name">
												
													</div>
											</div>	
											
											<div class="control-group">
												<label class="control-label" for="animName">Animal Species:</label>
													<div class="controls">
														<input type="text" id="animal_Species" class="span3 input-xlarge" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php 
											$animal_list = mysql_query("SELECT DISTINCT species_name FROM animal_species");

											$output = "";
											while($row = mysql_fetch_array($animal_list)){
												$output .= "\"";
												$output .= $row['species_name'];
												$output .= "\",";
											}	

											$output = rtrim($output, "\,");
											echo $output;
											?>]'>
														

												
													</div>
											</div>	
											
											<hr>

											
							
											
											
											
										</fieldset>
									</div> <!--FORM-->
																	
									
							
							</div>
							<div class="modal-footer">
								<a class="btn btn-info btn-large" id="submitNewAnimal" data-dismiss="modal">Add New Animal</a>
							</div>
						</div>
						<!-- END OF Modal Drop Down to Input New Obervation -->
						
						<!-- Beginning of Add ZK Modal -->
							<div id="newZK" class="modal hide fade">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">&times;</button>
									<h3>Add New Zookeeper</h3>
								</div>
								<div class="modal-body">
								    <div class="form-horizontal">
										<fieldset>
											<div class="control-group">
												<label class="control-label" for="zkID">Zookeeper ID:</label>
														<div class="controls">
															<input type="text" class="span2 input-xlarge" id="zk_ID" >
														</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="zkName">Zookeeper Name:</label>
														<div class="controls">
															<input type="text" class="span2 input-xlarge" id="zk_Name" >
														</div>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="modal-footer">
									<!-- Want to show success after submit-->
									<a class="btn btn-info btn-large" id="submitNewZK" data-dismiss="modal">Add New Zookeeper</a>
								</div>
							</div>
						<!-- End of Add ZK Modal -->
						
						
						<!-- Beginning of Remove Animal from ZOO Alert -->
						<div class="alert alert-block alert-error fade in span4 offset3" id="RemoveAlert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4 class="alert-heading">You are about to remove an animal!</h4>
							<p>Are you sure you want to remove this animal from the zoo?</p>
							<p>
							  <a class="btn btn-danger" id="RemoveAnimal">Remove Animal From Zoo</a> <a class="btn" id="goBack">Go Back</a>
							</p>
						</div>
						<!-- Beginning of Remove Animal from Zookeeper Alert -->
						<div class="alert alert-block alert-error fade in span4 offset3" id="RemoveAlert2">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4 class="alert-heading">You are about to remove an animal from this zookeeper!</h4>
							<p>Are you sure you want to remove this animal from this zookeeper?</p>
							<p>
							  <a class="btn btn-danger" id="RemoveAnimal2">Remove Animal From Zookeeper</a> 
							</p>
						</div>						
						
						<!-- End of Remove Animal Alert -->
						
						<!-- Beginning Remove Animal success alert -->
						<div class="alert alert-block alert-success fade in span4 offset3" id="RemoveSuccess">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4 class="alert-heading">Animal has been removed!</h4>
						</div>
						<!-- End of Remove Animal success alert -->					
						
						<!-- Beginning of Remove Zookeeper Alert -->
						<div class="alert alert-block alert-error fade in span4 offset3" id="RemoveZKalert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4 class="alert-heading">You are about to remove a ZooKeeper!</h4>
							<p>Are you sure you want to remove this zookeeper?</p>
							<p>
							  <!--Try data-dismiss instead-->
							  <a class="btn btn-danger" id="RemoveZK">Remove Zookeeper</a> <a class="btn" id="goBack">Go Back</a>
							</p>
						</div>
						<!-- End of Remove Animal Alert -->
				
						<!-- Beginning Remove Zookeeper success alert -->
						<div class="alert alert-block alert-success fade in span4 offset3" id="RemoveZKSuccess">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4 class="alert-heading">Zookeeper has been removed!</h4>
						</div>
						<!-- End of Remove Animal success alert -->	
						
						<!-- Begin Enter valid animal name alert -->
							<div class='alert alert-block alert-error fade in span4 offset3' id='RemoveAlert4'>
								<button type='button' class='close' data-dismiss='alert' >&times;</button>
									<h4 class='alert-heading'>Please enter valid animal name.</h4>
							 </div>
						<!-- End valid animal name alert -->

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
	
	
	$(document).ready(function(){
	//Hide these tabs until they are needed
	$(".CurrentAnimals").hide();
	$("#EnrichmentForSpecies").hide();
	$(".CurrentZKs").hide();
	
	$("#VE_CurrentAnimals").click(function(){
		$(".twoOptionsAnimal").hide();
		$("#addAnimalZK").hide();
		$(".CurrentAnimals").show();
	});
	
		$("#e_info").click(function(){
		$(".twoOptionsEnrichment").hide();
		$("#EnrichmentForSpecies").show();
	});
	
	
	
	
	
	
	
	$("#VE_CurrentZK").click(function(){
		$(".CurrentZKs").show();
		$(".twoOptionsZK").hide();
	});
	
	$("#Zookeepers").click(function(){
		$(".twoOptionsZK").show();
		$(".CurrentAnimals").hide();
		$(".CurrentZKs").hide();
		$(".twoOptionsEnrichment").show();
		$("#EnrichmentForSpecies").hide();
	})
	
	$("#EA").click(function(){
		$(".CurrentAnimals").hide();
		$(".CurrentZKs").hide();
		$(".twoOptionsAnimal").show();
		$(".twoOptionsEnrichment").show();
		$("#EnrichmentForSpecies").hide();
	})
	
	$("#Animals").click(function(){
		$(".twoOptionsAnimal").show();
		$(".CurrentZKs").hide();
		$(".CurrentAnimals").hide();
		$(".twoOptionsEnrichment").show();
		$("#EnrichmentForSpecies").hide();
	});
	
	$("#RemoveAlert").hide();
	$("#RemoveAlert2").hide();
	$("#RemoveAlert4").hide();
	$("#RemoveSuccess").hide();
	$("#RemoveZKalert").hide();
	$("#RemoveZKSuccess").hide();
	
	
	});
	</script>
	
	 <script type="text/javascript">
	$(document).ready(function(){
	
	//get table of animals from animal species search using Ajax
	$("#viewAnimalsFromSpecies").click(function(){
	value=$("#AnimalSpecies").val();
	//get the animal species FROM the input text box
	//$("#ShowAnimalsFromSpecies").html("I Love");
	$("#ShowAnimalsFromSpecies").load("view_data_animalSpecies.php",{species:value});})
	//});
	//END of get table of animals from animal species search using Ajax
	
	
	
	
	$("#behavList").change(function(){
	var value = $("#behavList").val();
	//alert(value=="Positive");
	if (value!="Positive")
	{
		$("#behavPos_Div").hide();
		$("#behavPos_List").val("N/A"); //setting value of BehaviorPositive to N/A if not a Positive Behavior!
		
	}
	else 
	{ 
		$("#behavPos_Div").show();
	}
	//document.write("value");
	});


	$("#submitNewAnimal").click(function() {
		value1 = $("#animal_ID").val();
		value2 = $("#animal_Name").val();
		value3 = $("#animal_Species").val();
		//value4 = $("#ZooKeeper_NewAnimal").val();
		
		$("#addAnimalZK").load("submitNewAnimal.php", {animalID:value1, animalName:value2, animalSpecies:value3} );
	});
	
	//Add new zookeeper to database 
	$('#submitNewZK').click(function(){
		value1 = $('#zk_Name').val();
		value2 = $('#zk_ID').val();
	
		$(".twoOptionsZK").load("submitNewZK.php", {zkname:value1, zkID:value2});
	});
	
	$("#DeleteAnimal").click(function(){
		if( $("#animName").val() == ""){
			$("#RemoveAlert4").show();
		}
		else{
			$("#RemoveAlert").show();
		}
	
	});
	
 
	$("[id=goBack]").click(function(){
		$("#RemoveAlert").hide();
		$("#RemoveZKalert").hide();
	});
	
	$("#RemoveAnimal").click(function(){
		value=$("#animName").val();
		$.post("remove_animal.php", {animalName:value});
		$("#RemoveAlert").hide();
		$("#RemoveSuccess").show();
	});
	
	$("#VE_Zookeepers").click(function(){
		value=$("#animName").val();
		$("#zkTable").load("show_zks.php", {animalName:value});
	});
	
	//Zookeeper Tab
	$("#DeleteZK").click(function(){
		val = $("#zk_name").val();
		
		$.post("remove_zk_from_zoo.php", {zkname:val});
	});

	$("#ViewZKData").click(function(){
		val = $("#zk_name").val();
		
		$("#zkDataTable").load("show_zk_data.php", {zkname:val});
	});
	
	});
	</script>

	
	<script type="text/javascript">
	$(document).ready(function(){
	
	

		
	$("#AddNewEncrichment").click(function(){
	value=$("#animName").val();
	//get the animal name for the enrichment form FROM the input text box
	$('#animal_Name').val(value);
	
	//get the animal id using AJAX, sending name to php file to search for ID
	$.post("getIDFromName.php", {animalName:value}, function(result){
	$("#animal_ID").val(result);});
	
	}); //AddNewEnrichment click ending
	
	
	$("#viewDataButton").click(function(){
		value=$("#animName").val();
		$("#viewDataDiv").load("view_data_animalName.php",{animalName:value});})
	});
	

	
	
	$("#viewEnrichmentFromSpecies").click(function(){
	value=$("#AnimalSpecies_E").val();
	$("#ShowEnrichmentFromSpecies").load("species_enrichment.php",{species:value});});
	

		
	
	
	$('#submitEnrich').click(function(){
		val1 = $('#en_name').val(); 
		val2 = $('#en_cat').val();
		val3 = $('#en_subcat').val();
		
		$.post('insert_enrichment.php', {name:val1, category:val2, subcat:val3});
		
	});
		
		$('.close_r').click(function(){
		$('#RemoveAlert2').hide();});
		

	

	
	
	
	</script>

  

  <?php
	mysql_close($con);
  ?>

</body></html>	