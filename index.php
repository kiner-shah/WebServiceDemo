<?php error_reporting(E_ERROR | E_PARSE); ?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			body {
				font-family: sans-serif;
			}
			table {
				border: 1px solid black;
			}
			input {
				height: 28px;
			}
			input[type=text] {
				font-size: 20px;
			}
			input[type=submit] {
				display: block;
				background-color: #0073e6;
				border-radius: 2px;
				border: 1px solid #0073e6;
				color: white;
			}
			input[type=submit]:hover {
				background-color: #4da6ff
			}
		</style>
		<script>
			function validate() {
				var aQS = document.querySelector("#first");
				var bQS = document.querySelector("#second");
				var a = parseInt(aQS.value); //document.getElementById("first").value;
				var b = parseInt(bQS.value); //document.getElementById("second").value;
				//var c = "";
				if (a < 0 || a > 100) {
					// c += "Wrong Base range: Please enter values in range [0, 100]\n";
					aQS.setCustomValidity("Wrong base range: Please enter values in range [0, 100]");
				}
				else if (b <= 0 || b > 10) {
					// c += "Wrong Power range: Please enter values in range [1, 10]";
					bQS.setCustomValidity("Wrong power range: Please enter values in range [1, 10]");
				}
				else {
					aQS.setCustomValidity("");
					bQS.setCustomValidity("");
				}
				// if(c.length != 0) {
				// 	alert(c);
				// }
			}
		</script>
	</head>
	<body>
		<div align="center">
			<h2>Web Service Demonstration: Calculation of Power</h2>
			<form autocomplete="off" action="server.php" method="post">
				<table>
					<tr><td><input type="text" id="first" name="first" placeholder="Enter Base"></td></tr>
					<tr><td><input type="text" id="second" name="second" placeholder="Enter Power"></td></tr>
					<tr align="center"><td><input type="submit" id="calculate" value="Calculate" onclick="validate()"></td></tr>
				</table>
			</form>
		</div>
		<div>
			<p>Returned results are:</p>
			<?php
				// Create a stream
				$opts = array(
  					'http'=> array(
    					'method'=>"GET",
    					'header'=>"Content-type: application/json"
  					)
				);

				$context = stream_context_create($opts);
				// Open the file using the HTTP headers set above
				$file = file_get_contents('http://localhost/WebService/results.json', false, $context);
				if($file == true) {
					//var_dump($file);
					$output = json_decode($file, true);
					echo $output['calculated_power'];
				}
			?>
		</div>
	</body>
</html>