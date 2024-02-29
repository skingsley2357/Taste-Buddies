<?php
require_once('private/initialize.php');
// Database connection parameters
$servername = "localhost";
$user_name = "webuser"; // Replace with your MySQL user_name
$password = "secretpassword"; // Replace with your MySQL password
$dbname = "dbv4q3sg6wsoto";

// Create connection
$conn = new mysqli($servername, $user_name, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Users";

// Execute the query
$result = $conn->query($sql);
include(SHARED_PATH . '/public_header.php');

// Display the data in a table
echo "<table border=1>
    <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Admin</th>
    </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["user_id"] . "</td>
            <td>" . $row["user_name"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["password"] . "</td>
            <td>" . $row["is_admin"] . "</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found</td></tr>";
}

echo "</table>";

// Close the connection
$conn->close();
include(SHARED_PATH . '/public_footer.php');
?>
