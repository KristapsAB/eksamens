<?php
// process.php
require_once 'guestbook.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $guestbook = new Guestbook();
    $guestbook->addEntry($_POST["name"], $_POST["email"], $_POST["message"]);

    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
