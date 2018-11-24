<?php 
$hoje = getdate();

	echo $hoje['mday']."/".$hoje['mon']."/".$hoje['year']." as ".$hoje['hours'].":".$hoje['minutes'].":".$hoje['seconds']."<br>";
	 $data_locale = new DateTimeZone("Brazil/East");
	 var_dump($data_locale);



?>