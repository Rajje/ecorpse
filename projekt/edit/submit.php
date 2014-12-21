<?php header("Content-type: text/html; charset=utf-8"); ?>

<html>
	<head>
	</head>
	<body>

<?php
	// Connect using host, username, password and databasename
	$link = mysqli_connect('localhost', 'arvidsat', 'arvidsat-xmlpub13', 'arvidsat');

	// Check connection
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$storyID = $_POST['storyID'];
	$post = $_POST['newPost'];
	$writtenBy = $_POST['username'];
	$date = date("Y-m-d H:i:s");

	$query = "SELECT count(*) c FROM Post WHERE storyID = '$storyID'";

	// Execute the query
	if (($result = mysqli_query($link, $query)) === false) {
		printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
		exit();
	}

	$count = $result->fetch_object();
	var_dump($count->c);
	$count = (int)$count->c;
	$count = $count + 1;

	$query = "INSERT INTO Post VALUES ('$storyID', '$post', 'P$count', '$writtenBy', '$date')";

	// Execute the query
	if (($result = mysqli_query($link, $query)) === false) {
		printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
		exit();
	}

	mysqli_close($link);
?>

		ffffff
	</body>
</html>