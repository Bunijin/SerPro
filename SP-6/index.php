<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="document">Document:</label>
		<textarea name="text" rows="10" cols="100"></textarea>
		<input type="submit" value="Submit">
	</form>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$text = $_POST['text'];
		if (empty($text)) {
			echo "Text area is empty.";
		} else {
			$all_countries = file_get_contents('globe.txt');
			preg_match('/\$globe\s*=\s*array\((.*)\);/', $all_countries, $matches);
			$array_string = 'array(' . $matches[1] . ')';
			$globe = eval("return $array_string;");
			$foundCountries = array();
			foreach ($globe as $country) {
				if (stripos($text, $country) !== false) {
					$foundCountries[] = $country;
				}
			}
			$asia_continent = array("Kazakhstan", "Kyrgyzstan", "Tajikistan", "Turkmenistan", "Uzbekistan", "China", "China, Hong Kong Special Administrative Region", "China, Macao Special Administrative Region", "Democratic People's Republic of Korea", "Japan", "Mongolia", "Republic of Korea", "Afghanistan", "Bangladesh", "Bhutan", "India", "Iran (Islamic Republic of)", "Maldives", "Nepal ", "Pakistan", "Sri Lanka", "Brunei Darussalam", "Cambodia", "Indonesia", "Lao People's Democratic Republic", "Malaysia", "Myanmar", "Philippines", "Singapore", "Thailand", "Timor-Leste", "Viet Nam", "Armenia", "Azerbaijan", "Bahrain", "Cyprus", "Georgia", "Iraq", "Israel", "Jordan", "Kuwait", "Lebanon", "Oman", "Qatar", "Saudi Arabia", "State of Palestine", "Syrian Arab Republic", "Turkey", "United Arab Emirates", "Yemen");
			$inside_asia = array();
			$outside_asia = array();

			if (!empty($foundCountries)) {
				foreach ($foundCountries as $country) {
					if (in_array($country, $asia_continent)) {
						$inside_asia[] = $country;
					} else {
						$outside_asia[] = $country;
					}
				}

				// Display the results
				if (!empty($inside_asia)) {
					echo "Countries found in Asia: " . implode(', ', $inside_asia) . "<br>";
				}

				if (!empty($outside_asia)) {
					echo "Countries found outside Asia: " . implode(', ', $outside_asia) . "<br>";
				}
			} else {
				echo "No countries found in the text.";
			}
		}
	}
	?>

</body>

</html>