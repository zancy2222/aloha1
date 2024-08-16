<?php
// Feedback processing logic

require_once("includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['GUESTID'])) {
    // Assuming you have a database connection established
    global $conn; // Replace with your database connection variable

    $guestId = $_SESSION['GUESTID'];
    $feedbackText = $_POST["feedback"];
    $rating = $_POST["rating"];
    $feedbackDate = date("Y-m-d"); // Get the current date

    // Validate and sanitize data as needed

    // Insert data into tblreviews (modify as per your table structure)
    $sql = "INSERT INTO tblreviews (GUESTID, REVIEW_TEXT, RATING, REVIEW_DATE) 
            VALUES ('$guestId', '$feedbackText', '$rating', '$feedbackDate')";

    $mydb->setQuery($sql);
    $msg = $mydb->executeQuery();

    // Debug prints
    if ($msg == "1") {
        echo "Feedback successfully submitted. Redirecting to index.php...";
    } else {
        echo "Error submitting feedback. Debug message: " . $msg;
    }

    // Redirect to index.php
    header("Location: index.php");
    exit(); // Ensure that no further code is executed after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .feedback-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            resize: vertical;
        }

        .rating {
            display: flex;
            margin-bottom: 20px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            padding: 5px;
            font-size: 24px; /* Adjust the font size as needed */
            color: #ddd; /* Unselected star color */
        }

        .rating label:hover,
        .rating input:checked ~ label,
        .rating input:checked + label {
            color: orange; /* Selected star color on hover or when checked */
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="feedback-form">
    <h2>Feedback Form</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Display a message after submitting feedback
        echo "<p>Thank you for your feedback!</p>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="feedback">Your Feedback:</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="4" required></textarea>
        </div>

        <div class="form-group">
    <label for="rating">Rate us:</label>
    <div class="rating" id="starRating">
        <?php
        // Display custom star rating options
        for ($i = 1; $i <= 5; $i++) {
            echo "<input type='radio' id='star$i' name='rating' value='$i'>";
            echo "<label for='star$i' style='cursor:pointer;'>&#9733;</label>";
        }
        ?>
    </div>
</div>


        <button type="submit">Submit Feedback</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        // jQuery script to handle star rating behavior
        $('.rating input').on('click', function () {
            var selectedRating = $(this).val();

            // Set color for all stars up to the selected one
            $('.rating label').each(function () {
                var starValue = $(this).prev().val();
                if (starValue <= selectedRating) {
                    $(this).css('color', 'orange');
                } else {
                    $(this).css('color', '#ddd');
                }
            });
        });
    });
</script>

</body>
</html>
