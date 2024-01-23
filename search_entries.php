<?php
// search_entries.php
require_once 'guestbook.php';

$guestbook = new Guestbook();

// Get the search term from the GET request
$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

// Validate the input to prevent SQL injection
$searchTerm = $guestbook->connection->real_escape_string($searchTerm);

$entries = $guestbook->searchEntries($searchTerm);

while ($entry = $entries->fetch_assoc()) {
    echo "<div class='entry'>";
    echo "<p><strong>{$entry['name']}</strong> ({$entry['email']})</p>";
    echo "<p>{$entry['message']}</p>";
    echo "<p>{$entry['created_at']}</p>";
    echo "</div>";
}

// Close the database connection
$guestbook->closeConnection();
?>
