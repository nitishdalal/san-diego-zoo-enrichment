<?php

echo "Welcome " . $_POST["username"] ."<br />"; 
echo "The current date is ". date("l F m Y")."<br />";
echo "Click on you animals to see past enrichment history: <br/>";
echo "<table border=1>
<tr>
<td>Animal 1</td>
</tr>
<tr>
<td>Animal 2</td>
</tr>
</table> ";

echo "<br/><br/>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<form action="review_sumbission.php" method="post" id="login_form">
<fieldset>
<legend>Enrichment Input</legend>
<p>Select Animal</p>
<select name="name">
<option value="volvo">Tiger</option>
<option value="saab">Jacky</option>
<option value="fiat">Frosty</option>
<option value="audi">Natan</option>
</select>
<p>Type of Enrichment </p>
<input type="radio" name="sex" value="a" /> Boomer Ball<br />
<input type="radio" name="sex" value="female" /> Thmye<br />
<input type="radio" name="sex" value="a" /> Boomer Ball<br />
<input type="radio" name="sex" value="female" /> Earthworm<br />
<input type="radio" name="sex" value="a" /> Sage Oil<br />
<input type="radio" name="sex" value="female" /> Other cool stuff

<p>Duration: <input type="text" id="username" name="username" /></p>
Level of Interaction:
<select name="name">
<option value="volvo">Tiger</option>
<option value="saab">Jacky</option>
<option value="fiat">Frosty</option>
<option value="audi">Natan</option></select>
<br/>

<p><input type="submit" value="Sumbit Data" name="submit" class="bar" />
<input type="reset" value="Clear" class="bar" /></p>

</fieldset>
</form> 

