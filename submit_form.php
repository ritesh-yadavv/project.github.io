<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "job_applications";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO job_seekers (name, email, phone, resume) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $resume);

// Set parameters and execute statement
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$resume = $_FILES['resume']['name'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);

if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
  $stmt->execute();
  echo "Your application has been submitted successfully!";
} else {
  echo "Sorry, there was an error uploading your file.";
}

$stmt->close();
$conn->close();
?>
