<?php include "templates/header.php"; ?>

<ul>
	<li><a href="event.php"><strong>Create</strong></a> - Add an event</li>
</ul>

<?php
	require "functions.php";
	require "../connection.php";

	if(isset($_POST['delete'])){
		if(delete_event(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
			header('Location: index.php');
			exit;
		}
	}
?>

<ul>
<?php
foreach(get_event_list() as $event){
	echo "<div id='container-flex'><a href='event.php?id=".$event['id']."'>". $event["name"] . "</a>";
	echo "<form method='post' action='index.php' />\n";
	echo "<input type='hidden' value='".$event['id']."' name='delete' />\n";
	echo "<input type='submit' value='Delete' />\n";
	echo "</form>";
	echo "</div>";
}
?>
</ul>


<?php include "templates/footer.php"; ?>