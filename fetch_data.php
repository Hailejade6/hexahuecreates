<?php

$DB_HOST = "localhost"; // Change if needed
$DB_USER = "root"; // Your database username
$DB_PASS = ""; // Your database password
$DB_NAME = "hexahuecreates_db"; // Your database name

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle GET requests for fetching messages (if applicable)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['message' => 'Welcome! This site uses cookies to enhance your experience.']);
}

// Handle POST requests for recording cookie acceptance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept'])) {
    // Log the incoming POST data
    error_log(print_r($_POST, true)); // Log to error log

    $preferences = isset($_POST['preferences']) ? implode(',', $_POST['preferences']) : '';
    
    // Log the preferences
    error_log("Preferences: " . $preferences); // Log preferences

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO cookie_consent (accepted, preferences) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $accepted = 1; // 1 for accepted
    $stmt->bind_param("is", $accepted, $preferences);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Cookie preferences recorded successfully.']);
    } else {
        echo json_encode(['message' => 'Error recording preferences: ' . $stmt->error]);
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
