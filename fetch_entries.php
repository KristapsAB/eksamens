<?php
// fetch_entries.php
require_once 'guestbook.php';

$guestbook = new Guestbook();

// Default sorting column and order
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';

// Validate the input to prevent SQL injection
$allowedColumns = ['name', 'email', 'created_at'];
$sortColumn = in_array($sortColumn, $allowedColumns) ? $sortColumn : 'created_at';
$sortOrder = ($sortOrder == 'ASC' || $sortOrder == 'DESC') ? $sortOrder : 'DESC';

$entries = $guestbook->getEntries($sortColumn, $sortOrder);

while ($entry = $entries->fetch_assoc()) {
    echo "<div class='entry'>";
    echo "<p><strong>{$entry['name']}</strong> ({$entry['email']})</p>";
    echo "<p>{$entry['message']}</p>";
    echo "<p>{$entry['created_at']}</p>";
    echo "</div>";
}
?>
