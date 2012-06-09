#!/usr/local/bin/php -d display_errors=STDOUT
<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
?>
<?php

$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

$query = "SELECT * FROM zookeeper_name WHERE id = '" . $_POST['userid']."'";


$result = mysql_query($query);
$_SESSION['id']='';
$row1 = mysql_num_rows($result);
$row = mysql_fetch_array($result);
if($row1==1 && $_POST['su']!='superuser')
	{
	$_SESSION['id']=$_POST['userid'];
	}
else if($row1==1 && $_POST['su']=='superuser' && $row['superuser']==1)
	{
	$_SESSION['id']=$_POST['userid'];
	header( 'Location: superUser.php');
	}
else
	{
	header( 'Location: login.php' ) ;
	}
//$row = mysql_fetch_array($result);
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
   				<li><a href="#tab2" data-toggle="tab">Search by Species</a></li>
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
    				 	<a class="btn btn-primary btn-large" data-toggle="modal" id="AddNewEncrichment" >Add New Enrichment</a>
    				 </div>
    				 <a class="btn btn-success btn-large" id="viewDataButton">View Animal's Existing Data</a> 	  	
    				</div>
    			</div>
					<div id="viewDataDiv"></div> 
    		    </div>
    			<!--END OF TAB ONE -->
    			
    			
    			<!-- Tab TWO -->
    	
    			<div class="tab-pane" id="tab2">
    				<p>Input species:</p> 
    			
    				<div class="row">
    				<div class ="well form-search">
    				<div class ="span3">				
            			<!---Get species--->
            			<input type="text" id="AnimalSpecies" class="span3 input-medium search-query" placeholder ="Animal Species" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source='[<?php
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
    				<div class="offset4">
    				 <a class="btn btn-info btn-large" id="viewAnimalsFromSpecies">Find Animals</a> 	  
    				 </div>
    				</form>
    			</div>
    		</div>
    				
    				
    				<div id="ShowAnimalsFromSpecies"></div>
    				
    				<!--
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
    				 </div>
    				 -->

    		</div>
    		<!-- END OF TAB TWO -->	
    		
    	
    		<!--Beginning of Tab THREE -->
    		<div class="tab-pane" id="tab3">
    			<div class="control-group">
				<div class="controls">
						<select id="ActivityShown">
								<option value="TwoWeeks">View Last 2 Weeks</option>
								<option value="FourWeeks">View Last 4 Weeks</option>
								<option value="All">View All Data</option>
						</select>	
						<div id="ViewRecentData"></div>
						
			    </div>
				</div>
											
    			
    			
    			<!--
    			<h3>This will have a table of Zookeeper's recent activity </h3>
				<div class="recentDataDiv">
				<?php
					$user = $_SESSION['id'];
					$tstamp = time();
					$date = date("Y-m-d", $tstamp);
					$two_weeks = $tstamp - (3600*24*14);
					$date_offsest = date("Y-m-d", $two_weeks);
					
					$query = "SELECT * FROM enrichment_animal WHERE zookeeper_id = $user AND DATE_SUB(CURDATE(), INTERVAL 2 WEEK) < date";
					$recent_result = mysql_query($query);
	
					echo "<table class=\"table table-striped\">
						<thead> <td>Duration Observed</td>
								<td>Indirect Use</td>
								<td>Behavior</td>
								<td>Behavior Pos</td>
								<td>Duration Interaction</td>
						</thead><tbody>";
					while($row = mysql_fetch_array($recent_result))
						{
							echo "<tr><td>".$row['duration_observed']."</td><td>".$row['indirect_use']."</td><td>".$row['behavior']."</td><td>".$row['behavior_pos']."</td><td>".$row['duration_interaction']."</td></tr>";
						}
					echo "</tbody></table>";
				?>	

					<a class="btn btn-info btn-large" id="back">Back 2 Weeks</a>
					<a class="btn btn-info btn-large" id="forward">Forward 2 Weeks</a>
					!-->
					
				</div>
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
														<!--
														<?php 
														//This is the query that needs to replace the existing query. I have writtent this as a comment because I was not sure how to access animal_id here, which is required in the WHERE clause of query
														
														//$enrichment = mysql_query("select enrichment.enrichment_id, enrichment.enrichment_name from enrichment, animal, species_enrichment where animal.species_name = species_enrichment.species_id and species_enrichment.enrichment_id = enrichment.enrichment_id and animal_id = ".$animal_ID );
														
														 $enrichment=mysql_query("select enrichment_id, enrichment_name from enrichment");
															
															while ($row=mysql_fetch_array($enrichment)){
																echo "<option value = $row[enrichment_id]>$row[enrichment_name]</option>";}?>
																!-->
				
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
											
											
											
											
											<!--MUST BE INPUTTED LATER -->
											<!--
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
											
											-->
							
											
											
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
															<option value="N/A" style="display: none;">N/A</option>
														</select>													
													</div>
											</div>
											
											
							
											
											
											
										</fieldset>
									</div> <!--FORM-->
							</div>
							<div class="modal-footer">
								<a class="btn btn-info btn-large" id="submitNewObservation" data-dismiss="modal">Add Observation</a>
							</div>
						</div>
						<!-- END OF Modal Drop Down to Input New Obervation -->
						
						
						<!-- Modal Drop Down to Input Indirect Use For Later -->
    				 <div id="IndirectUse" class="modal hide fade">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h3>Indirect Use</h3>
							</div>
							<div class="modal-body">
								    <div class="form-horizontal">
										<fieldset>
										<div class="control-group">
													<div class="controls">
														<input type="hidden" class="span2 input-xlarge" id="time_hidden" >		
													</div>
											</div>
												<div class="control-group">
												<label class="control-label" for="animID">Animal ID</label>
													<div class="controls">
														<input type="text" class="span2 input-xlarge" id="animal_ID_IU" >
														<p class="help-block">Enter 6 character ID.</p>
									
													</div>
											</div>
											
		
											
											<div class="control-group">
													<div class="controls">
														<input type="hidden" class="span2 input-xlarge" id="date_hidden" >		
													</div>
											</div>
											
											<div class="control-group">
												<label class="control-label" for="animName">Animal Name</label>
													<div class="controls">
														<input type="text" class="input-xlarge" id="animal_Name_IU">
												
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
											
											
											
										</fieldset>
									</div> <!--FORM-->
							</div>
							<div class="modal-footer">
								<a class="btn btn-info btn-large" id="submitIndirectUse" data-dismiss="modal">Add Indirect Use</a>
							</div>
						</div>
						<!-- END OF Modal Drop Down For Indirect Use -->
					
					
						
				
						
    			

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
	
	//get table of animals from animal species search using Ajax
	$("#viewAnimalsFromSpecies").click(function(){
	value=$("#AnimalSpecies").val();
	//get the animal species FROM the input text box
	$("#ShowAnimalsFromSpecies").load("view_data_animalSpecies.php",{species:value});})
	//});
	//END of get table of animals from animal species search using Ajax
	
	
	
	/*The following function is for the view/ecent activity that changes the outputted table depending on date chosen*/
	var value1 = $("#ActivityShown").val();
	$("#ViewRecentData").load("RecentActivity_Zookeeper.php",{time:value1});
	$("#ActivityShown").change(function(){
	var value = $("#ActivityShown").val();
	$("#ViewRecentData").load("RecentActivity_Zookeeper.php",{time:value});
	});
	
	
	
	
	
	
	
	
	$("#behavList").change(function(){
	var value = $("#behavList").val();
	//alert(value=="Positive");
	if (value!="Positive")
	{
		$("#behavPos_List").val("N/A"); //setting value of BehaviorPositive to N/A if not a Positive Behavior!
		$("#behavPos_Div").hide();
		
		
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
	
	//ADD new observation inputs from modal into database
	$("#submitNewObservation").click(function(){
	
	value1=$("#animal_ID").val();
	value2=$("#animal_Name").val();
	value3=$("#enrichList").val();
	value4=$("#Duration_Observation").val();
	value5=$("#Duration_Interaction").val();
	value6=$("#behavList").val();
	value7=$("#behavPos_List").val();
	
	$.post("submitObservation_DataBase.php", {animalID:value1,animalName:value2,enrichment:value3,Duration_Observation:value4,Duration_Interaction:value5,Behavior:value6,Behavior_Positive:value7}, function(result){
	var value1 = $("#ActivityShown").val();
	$("#ViewRecentData").load("RecentActivity_Zookeeper.php",{time:value1});
	
	
	});
	
	
	});
	
	

		
	$("#AddNewEncrichment").click(function(){
	$('#newObs').modal('show');
	value=$("#animName").val();
	//get the animal name for the enrichment form FROM the input text box
	$('#animal_Name').val(value);
	
	//get the animal id using AJAX, sending name to php file to search for ID
	$.post("getIDFromName.php", {animalName:value}, function(result){
		$("#animal_ID").val(result);
		$("#enrichList").load("get_enrichment.php",{id:result});
	});
	
		
	
	
	}); //AddNewEnrichment click ending
	



	
	$("#viewDataButton").click(function(){
		value=$("#animName").val();
	$("#viewDataDiv").load("view_data_animalName.php",{animalName:value});})
	});
	
	
	
	//test
	$('#submitIndirectUse').click(function(){
   value_Use=$('input:radio[name=Indirect_Use]:checked').val();
    value_ID=$('#animal_ID_IU').val();
    value_time=$('#time_hidden').val();
    value_date=$('#date_hidden').val();

	$.post('update_indirect_use.php', {animal_id:value_ID,time:value_time,iu:value_Use,date:value_date}, function(result){
	var value1 = $("#ActivityShown").val();
	$('#ViewRecentData').load('RecentActivity_Zookeeper.php',{time:value1});});
	});
	
	
	
	
	
	</script>

  

  <?php
	mysql_close($con);
  ?>

</body></html>
