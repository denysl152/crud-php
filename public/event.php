<?php
require "functions.php";

if(isset($_GET['id'])){
	list($id, $name, $date, $start, $end, $description, $price, $image) = get_event(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
	$id=filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
	$date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_URL));
	$start = trim(filter_input(INPUT_POST, 'start', FILTER_SANITIZE_URL));
	$end = trim(filter_input(INPUT_POST, 'end', FILTER_SANITIZE_URL));
	$description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
	$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT));
	$image = trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL));

	if(empty($name) ||empty($date) || empty($start) || empty($end)|| empty($description) || empty($price) || empty($image)){
		$error_message= "Please fill in the required fields";
	} else {

		if(add_event($name, $date, $start, $end, $description, $price, $image, $id)){
			header('Location: index.php');
			exit;
		} else {
			$error_message = "Could not add event";
		}
	}
}
?>

<?php require "templates/header.php"; ?>

<?php 
if(isset($error_message)){
	echo $error_message;
}
?>

<h2>
<?php
if(!empty($id)){
	echo "Update";
} else {
	echo "Add an event";
}
?></h2>

<form method="post" action="event.php">
	<label for="name">Event name</label>
	<input type="text" name="name" id="name" value="<?php echo $name ?>">

	<label for="date">Date</label>
	<input type="date" name="date" id="date" value="<?php echo $date ?>">

	<label for="start">Start</label>
	<input type="time" name="start" id="start" value="<?php echo $start ?>">

	<label for="end">End</label>
	<input type="time" name="end" id="end" value="<?php echo $end ?>">

	<label for="description">Description</label>
    <textarea id="description" name="description"><?php echo $description ?></textarea>

	<label for="price">Price</label>
	<input type="text" name="price" id="price" value="<?php echo $price ?>">

	<label for="image">Image</label>
	<input type="text" name="image" id="image" value="<?php echo $image ?>">
	<?php
	if(!empty($id)){
		echo '<input type="hidden" name="id" value="'.$id.'">';
	}
?>
	<input type="submit" name="submit" value="Envoyer">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>