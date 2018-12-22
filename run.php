<?php 
include('function.php');
$world = new apiTinder;
while (true) {
	$run = $world->fetchAllTomodachi();
	for ($i=0; $i < count($run); $i++) { 
		$exe = $world->autoLikeTomodachi($run[$i]['uid'], $run[$i]['s_number']);
		echo "$i AUTO LIKE " . $run[$i]['name']. ' ' .$run[$i]['dob']. ' ' .$run[$i]['distance']. PHP_EOL;
		$world->logTinder($exe);
		sleep(5);
	}
	echo "==============================".PHP_EOL;
}

 ?>