// script.js
$(document).ready(function () {
    // Fetch entries on page load
    fetchEntries();

    // Event listener for form submission
    $("#entryForm").submit(function (event) {
        event.preventDefault();
        submitEntry();
    });

    // Event listener for sorting
    $("#sortButton").click(function () {
        fetchEntries();
    });

    // Event listener for search
    $("#searchButton").click(function () {
        searchEntries();
    });
});

function submitEntry() {
    // Client-side validation
    var name = $("#name").val().trim();
    var email = $("#email").val().trim();
    var message = $("#message").val().trim();

    if (!name || !email || !message) {
        showAlert("Please fill in all fields.");
        return;
    }

    if (message.length < 5) {
        showAlert("Message must be at least 5 characters long.");
        return;
    }

    // Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showAlert("Please enter a valid email address.");
        return;
    }

    // Assuming you have included jQuery
    $.ajax({
        type: "POST",
        url: "process.php",
        data: {
            name: name,
            email: email,
            message: message
        },
        success: function () {
            // Update entries list dynamically
            updateEntries();
            // Clear the form fields
            $("#name, #email, #message").val("");
        }
    });
}

function fetchEntries() {
    var sortColumn = $('#sortColumn').val(); // Assuming you have a dropdown for selecting the column to sort
    var sortOrder = $('#sortOrder').val();   // Assuming you have a dropdown for selecting the order (ASC or DESC)

    $.ajax({
        type: "GET",
        url: `fetch_entries.php?sort=${sortColumn}&order=${sortOrder}`,
        success: function (data) {
            $("#entriesList").html(data);
        }
    });
}

function searchEntries() {
    var searchTerm = $('#searchTerm').val().trim();

    $.ajax({
        type: "GET",
        url: `search_entries.php?term=${searchTerm}`,
        success: function (data) {
            $("#entriesList").html(data);
        }
    });
}

function updateEntries() {
    fetchEntries();
}

// Custom alert functions
function showAlert(message) {
    $("#alertMessage").text(message);
    $("#customAlert").fadeIn().delay(3000).fadeOut();
}

function closeCustomAlert() {
    $("#customAlert").fadeOut();
}
