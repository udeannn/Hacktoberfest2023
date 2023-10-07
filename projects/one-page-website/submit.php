<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $language = $_POST["language"];

    // You can process the form data here, e.g., store it in a database.

    // For this example, let's just display a confirmation message.
    echo "<h2>Registration Successful</h2>";
    echo "<p>Thank you, $name, for registering with email: $email</p>";
} else {
    // Handle invalid request.
    echo "<h2>Error: Invalid Request</h2>";
}
?>
