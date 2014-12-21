<?php header("Content-type: text/xml; charset=utf-8"); ?>
<?php
print("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
print("<?xml-stylesheet type=\"text/xsl\" href=\"edit_pc.xsl\"?>\n");
print("<!DOCTYPE ecorpse SYSTEM \"http://xml.csc.kth.se/~rberggre/DM2517/projekt/corpse_dtd.dtd\">\n");
?>


<ecorpse>

	<language>
		swedish
	</language>

	<stories>
		<?php
			// Connect using host, username, password and databasename
			$link = mysqli_connect('localhost', 'arvidsat', 'arvidsat-xmlpub13', 'arvidsat');

			// Check connection
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}

			$storyID = "S1";

			$query = "SELECT storyID, totalNumberOfPosts, completed FROM Story WHERE storyID = '$storyID'";

			// Execute the query
			if (($result = mysqli_query($link, $query)) === false) {
				printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
				exit();
			}

			$line = $result->fetch_object();

			$points = $line->points;

			print ("<story id=\"$line->storyID\" totalNumberOfPosts=\"$line->totalNumberOfPosts\" completed=\"$line->completed\">\n");

			

			$query = "SELECT * FROM Post WHERE storyID = '$storyID' ORDER BY dateWritten DESC LIMIT 1";

			// Execute the query
			if (($result = mysqli_query($link, $query)) === false) {
				printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
				exit();
			}

			if (mysqli_num_rows($result) == 0) {
				$newStory = true;
			} else {
				$newStory = false;
			}

			$line = $result->fetch_object();

			print ("<post number=\"$storyID$line->postNr\">\n");

			print("<writtenBy user=\"$line->writtenBy\"/>\n");
			print("<date>$line->dateWritten</date>\n");

			if ($newStory == true) {
				print("<content>");
				print("New Story");
				print("</content>\n");
			} else {
				print("<content>");
				print utf8_encode("$line->post");
				print("</content>\n");
			}
			print ("</post>\n");

			print("<points>$points</points>\n");
			print("</story>\n");

			mysqli_free_result($result);
			mysqli_close($link);
		?>
	</stories>


</ecorpse>
