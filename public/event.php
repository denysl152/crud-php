<?php
require "functions.php";
?>

<?php require "templates/header.php"; ?>

<h2>Add an event</h2>

<form method="post" action="event.php">
	<label for="name">Event name</label>
	<input type="text" name="name" id="name" value="">

	<label for="date">Date</label>
	<input type="date" name="date" id="date" value="">

	<label for="start">Start</label>
	<input type="time" name="start" id="start" value="">

	<label for="end">End</label>
	<input type="time" name="end" id="end" value="">

	<label for="description">Description</label>
    <textarea id="description" name="description"></textarea>

	<label for="price">Price</label>
	<input type="text" name="price" id="price" value="">

	<label for="image">Image</label>
	<input type="text" name="image" id="image" value="">

	<input type="submit" name="submit" value="Envoyer">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>