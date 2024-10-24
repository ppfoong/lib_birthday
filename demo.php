<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;" />
	<meta charset="UTF-8">
	<meta name="author" content="P.P. Foong">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Demo of birthday library functions</title>
</head>
<body>
	<p><div style="text-align:center;">
		<form action="" method="get">
		  <label for="birthday">Birthday:</label>
		  <input type="date" id="birthday" name="birthday">
		  <input type="submit">
		</form>
	
<?php
	require_once('lib_birthday.php');
	
	if (!empty($_GET)) {
		if (isset($_GET['birthday'])) {
			$today = todayYMD();
			$thisYear = $today[0];
			$thisMonth = $today[1];
			$thisDay = $today[2];
			$date = date_parse($_GET['birthday']);
			if($date['error_count'] > 0) {
				echo "<p style=\"color:red;\"><b><i>Error: Invalid date detected. Defaulting the birthday to today...</i></b></p>";
				$year = $thisYear;
				$month = $thisMonth;
				$day = $thisDay;
			} else {
				$year = $date['year'];
				$month = $date['month'];
				$day = $date['day'];
			}
			echo "<br>Today: ".$thisYear."-".$thisMonth."-".$thisDay;
			echo "<br>Birthday: ".$year."-".$month."-".$day;
			$cnyState = passedCNY($year,$month,$day)?"after":"before";
			echo " (".$cnyState." Chinese New Year)";
			$cny = getCNYday($thisYear);
			if ($cny != -1) {
				$mon = ($cny[0]==1)?"Jan ":"Feb ";
				echo "<br>This year's Chinese New Year falls on: ".$mon.$cny[1];
			} else {
				echo "<br><i>Current year is out of Chinese New Year checking range.</i>";
			}
			$cny = getCNYday($year);
			if ($cny != -1) {
				$mon = ($cny[0]==1)?"Jan ":"Feb ";
				echo "<br>Birth year's Chinese New Year falls on: ".$mon.$cny[1];
			} else {
				echo "<br><i>Birth year is out of Chinese New Year checking range.</i>";
			}
			echo "<br><br>Zodiac sign: ";
			echo getZodiac($month,$day)." ";
			echo getZodiac($month,$day,2);
			echo "<br><br>Symbolic animal: ";
			echo getAnimal($year,$month,$day)." ";
			echo getAnimal($year,$month,$day,4);
			echo "<br><br>Life path number: ";
			echo getLifePathNumber($year,$month,$day);
			
			echo "<br><br>Age: ";
			echo getAge($year,$month,$day);
			$age = getAge($year,$month,$day,1);
			echo "<br>Age: ";
			echo $age[0]." year(s) ".$age[1]." month(s) ".$age[2]." day(s)";
			echo "<br><br>Has been living for: ";
			echo getAge($year,$month,$day,2)." days";
			echo "<br><br>Days from last birthday: ";
			echo getDays2Bday($month,$day,1);
			echo "<br><br>Days to next birthday: ";
			echo getDays2Bday($month,$day);
		}
	}
?>

	</div></p>
</body>
</html>
