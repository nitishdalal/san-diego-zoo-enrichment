#!/usr/local/bin/php -d display_errors=STDOUT
<?php
session_start();
?>
<?php
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

$query = "SELECT name FROM zookeeper_name WHERE id = '" . $_POST['userid']."'";

$result = mysql_query($query);
$_SESSION['id']='';
$row1 = mysql_num_rows($result);
if($row1==1)
	{
	$_SESSION['id']=$_POST['userid'];
	}
else
	{
	header( 'Location: login.php' ) ;
	}
$row = mysql_fetch_array($result);
$name=$row['name'];
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
            </ul>
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
   				<li class="active"><a href="#tab1" data-toggle="tab">Search by Name</a></li>
   				<li><a href="#tab2" data-toggle="tab">Search By Species</a></li>
    			<li><a href="#tab3" data-toggle="tab">View/Edit Recent Inputted Activity</a></li>
    		</ul>
    		<!-- Individual Tab's Content -->
    		<div class="tab-content">
    			
    			<!--TAB ONE -->
    			<div class="tab-pane active" id="tab1">
    			<p>Input Animal name:</p> 
    			
    			<div class="row">
    				<div class ="well form-search">
    				<div class ="span3">				
            			<input type="text" id="animName"  class="span3 input-medium search-query" placeholder ="Animal Name" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php
							$user_id = $_SESSION['id']; 
							$animal_list = mysql_query("SELECT animal_name FROM animal WHERE animal_id IN(SELECT animal_id FROM zookeeper_animal WHERE zookeeper_id = $user_id)");
					
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
    				 	<a class="btn btn-primary btn-large" data-toggle="modal" id="AddNewEncrichment"  href="#newObs" >Add New Enrichment</a>
    				 </div>
    				 <a class="btn btn-success btn-large" id="viewDataButton">View Animal's Existing Data</a> 	  	
    				</div>
    			</div>
					<div id="viewDataDiv"></div> 
    		    </div>
    			<!--END OF TAB ONE -->
    			
    			
    			<!-- Tab TWO -->
    			<!--NOT CORRECT. Cant put a button in form without it going back to home page -->
    			<div class="tab-pane" id="tab2">
    				<p>Input species:</p> 
    			
    				<div class="row">
    				<form class ="well form-search">
    				<div class ="span3">				
            			<input type="text" class="span3 input-medium search-query" placeholder ="Animal Species" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='["Rabbit","Lion","Cat","Sheep","Horse","Bug","Lizard","Bear"]'>
    				</div>
    				<div class="offset4">
    				 <a class="btn btn-info btn-large" href="#tab2" id="showtable">Find Animals</a> 	  
    				 </div>
    				</form>
    			</div>
    				
    				
    				<form id="ToggleTable">
    				<table class ="table table-striped">
    					<thead>
    						<tr>
    							<th></th>
    							<th>Animal Name</th>
    							<th>Animal I.D.</th>
    						</tr>
    					</thead>
    					<tbody>
    						<tr>
    							<td><input type="radio" name="animal" value="Animal1" /><br />
    							<td>Alfred the Squirrel</td>
    							<td>103290321903</td>
    						</tr>
    						<tr>
    							<td><input type="radio" name="animal"  value="Animal1" /><br />
    							<td>Roger the Rabbit</td>
    							<td>103290321903</td>
    						</tr>
    						<tr>
    							<td><input type="radio" name="animal"  value="Animal1" /><br />
    							<td>Mango the Dog</td>
    							<td>103290321903</td>
    						</tr>
    						<tr>
    							<td><input type="radio" name="animal"  value="Animal1" /><br />
    							<td>Freddy the Lion</td>
    							<td>103290321903</td>
    						</tr>
    						<tr>
    							<td><input type="radio" name="animal"  value="Animal1" /><br />
    							<td>Wilfred the Tiger</td>
    							<td>103290321903</td>
    						</tr>
    						<tr>
    							<td><input type="radio" name="animal"  value="Animal1" /><br />
    							<td>Harry the Worm</td>
    							<td>103290321903</td>
    						</tr>
    						<tr>
    							<td><input type="radio" name="animal"  value="Animal1" /><br />
    							<td>Tim the Parrot</td>
    							<td>103290321903</td>
    						</tr>
    					</tbody>
    				 </table>
    				 	<div class="row">
  							  <div class = "span3 offset3">
    				 			<a class="btn btn-primary btn-large" data-toggle="modal" href="#newObs" >Add New Enrichment</a>
    				 	  	  </div>
    				 	  	  <div class = "span 3">
    				 	  	  	<a class="btn btn-success btn-large" href="">View Animal's Existing Data</a>
    				 	  	  </div>
    				 	</div>
    				 </form>
    				 <!--DIV -->
    				
    		</div>
    		<!-- END OF TAB TWO -->	
    		
    	
    		<!--Beginning of Tab THREE -->
    		<div class="tab-pane" id="tab3">
    			<h3>This will have a table of Zookeeper's recent activity </h3>
    		</div>
    		<!--End of Tab THREE-->
    		</div>
    	</div>
	
	<!--End of Tabbable Content -->
	 
    	<!-- Modal Drop Down to Input New Obervation -->
    				 <div id="newObs" class="modal hide fade">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h3>New Observation</h3>
							</div>
							<div class="modal-body">
								    <div class="form-horizontal">
										<fieldset>
											<div class="control-group">
												<label class="control-label" for="animID">Animal ID</label>
													<div class="controls">
														<input type="text" class="span2 input-xlarge" id="animal_ID" >
														<p class="help-block">Enter 6 character ID.</p>
									
													</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="animName">Animal Name</label>
													<div class="controls">
														<input type="text" class="input-xlarge" id="animal_Name">
												
													</div>
											</div>										
											<div class="control-group">
												<label class="control-label" for="Enrichment">Enrichment</label>
													<div class="controls">
														<select id="enrichList">
															<option>Thyme</option>
															<option>Earthworms</option>
															<option>Ice Blocks</option>
															<option>Lavendar</option>
															<option>Plastic Logs</option>
															<option>Dirt</option>
														</select>
													</div>
											</div>
											<div class="control-group input-append">
												<label class="control-label" for="durObs">Duration Observation</label>
													<div class="controls">
														<input type="text" class="span1 input-xlarge" id="Duration_Observation"><span class="add-on">minutes</span>
																								
													</div>
											</div>
											
											<div class="control-group input-append">
												<label class="control-label" for="durObs">Duration Interaction</label>
													<div class="controls">
														<input type="text" class="span1 input-xlarge" id="Duration_Interaction"><span class="add-on">minutes</span>
																								
													</div>
											</div>
											
											
											
											
											
											<div class="control-group">
												<label class="control-label" for="Indirect_Use">Indirect Use</label>
													<div class="controls">
														<label class="radio inline">
                										<input type="radio" name="Indirect_Use" value="Yes"> Yes</label>
                										<label class="radio inline">
                										<input type="radio" name="Indirect_Use" value="No"> No</label>
                										<label class="radio inline">
                										<input type="radio" name="Indirect_Use" value="N/A">N/A</label>							
													</div>
											</div>
											
											
							
											
											
											<div class="control-group">
												<label class="control-label" for="behav">Behavior</label>
													<div class="controls">
														<select id="behavList">
															<option value="Positive">Positive</option>
															<option value="Negative">Negative</option>
															<option value="Avoid">Avoid</option>
															<option value="N/A">N/A</option>
														</select>													
													</div>
											</div>
											
											
											<div class="control-group" id="behavPos_Div">
												<label class="control-label" for="behavPos">Behavior Positive</label>
													<div class="controls">
														<select id="behavPos_List">
															<option value="Forage">Forage</option>
															<option value="Explore">Explore</option>
														</select>													
													</div>
											</div>
											
											
							
											
											
											
										</fieldset>
									</div> <!--FORM-->
							</div>
							<div class="modal-footer">
								<a class="btn btn-info btn-large" id="submitNewObservation">Add Observation</a>
							</div>
						</div>
						<!-- END OF Modal Drop Down to Input New Obervation -->
					
						
				
						
    			

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
	$("#ToggleTable").hide();
	$("#showtable").click(function(){
	$("#ToggleTable").show();});
	
	
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
	</script>

  

  <?php
	mysql_close($con);
  ?>

</body></html>