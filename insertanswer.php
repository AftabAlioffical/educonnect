<?php
// Start the session
session_start();
// Include config file
require_once "admin/config1.php";
echo $_SESSION['user_id'];
echo $_SESSION['name'];


// Initialize variables and error messages
$user_id = $question_id = $user_name = $asked_on = $answer = "";
$answer_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate answer input
    $input_answer = trim($_POST["answer"]);
    if (empty($input_answer)) {
        $answer_err = "Please enter your answer.";
    } else {
        $answer = $input_answer;
    }

    // Retrieve user and question data from the session or request
    if (isset($_SESSION['user_id'], $_SESSION['name'], $_SESSION['question_id'])) {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['name'];
        $question_id = intval($_SESSION['question_id']); // Ensure it's an integer
        $asked_on = date("Y-m-d"); // Current date
    } else {
        echo "Invalid session or request data.";
        exit;
    }

    // Check for errors before inserting into the database
    if (empty($answer_err)) {
        // Prepare an insert query
        $sql = "INSERT INTO user_answers (user_id, question_id, user_name, asked_on, answer) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement
            mysqli_stmt_bind_param($stmt, "iisss", $user_id, $question_id, $user_name, $asked_on, $answer);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Answer submitted successfully!";
                header("Location: query.php?id=" . $question_id);

            } else {
                echo "Error: Could not execute the query.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare the query.";
        }
    } else {
        echo $answer_err;
    }

    // Close the database connection
    mysqli_close($link);
}
?>
