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

// Fetch data from the registration_form table
$sql = "SELECT id, name, f_name, m_name, email, phone, dob, gender, course, photo FROM pview_form";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List View of Submitted Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>

<h2>Submitted Data List</h2>
<?php
// Display the submitted data in a table
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th>Mother's Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Course</th>
                <th>Photo</th>
            </tr>";
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['f_name'] . "</td>
                <td>" . $row['m_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['dob'] . "</td>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['course'] . "</td>
                <td><img src='" . $row['photo'] . "' alt='Photo'></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close connection
$conn->close();
?>

</body>
</html>

