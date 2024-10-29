<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "12345";  // Your MySQL password
$dbname = "preform";
$port = 3307;

// Create a connection
$conn = new mysqli("localhost", "root", "", "preform", "3307");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];

    // Handle file upload
    $photo = $_FILES['photo'];
    $photoPath = 'uploads/' . basename($photo['name']);
    move_uploaded_file($photo['tmp_name'], $photoPath);

    // Insert data into the registration_form table
    $sql = "INSERT INTO pview_form (name, f_name, m_name, email, phone, dob, gender, course, photo)
            VALUES ('$name', '$f_name', '$m_name', '$email', '$phone', '$dob', '$gender', '$course', '$photoPath')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <style>
        /* Styling for form */
        form {
            margin-bottom: 20px;
        }

        input, select {
            display: block;
            margin-bottom: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>

<h2>Submit Form</h2>
<form action ="index.php" method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="f_name">Father's Name:</label>
    <input type="text" name="f_name" id="f_name" required>

    <label for="m_name">Mother's Name:</label>
    <input type="text" name="m_name" id="m_name">

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required>

    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required>

    <label for="gender">Gender:</label>
    <select name="gender" id="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <label for="course">Course:</label>
    <input type="text" name="course" id="course">

    <label for="photo">Upload Photo:</label>
    <input type="file" name="photo" id="photo" required>

    <button type="submit">Submit</button>
</form>

<!-- Button to view submitted data in table format -->
<form action="form.php" method="get">
    <button type="submit">List View</button>
</form>

</body>
</html>

