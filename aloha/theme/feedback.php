// Feedback processing logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['GUESTID'])) {
  // Assuming you have a database connection established
  global $conn; // Replace with your database connection variable

  $guestId = $_SESSION['GUESTID'];
  $feedbackText = $_POST["feedbackText"];
  $rating = $_POST["rating"];
  $feedbackDate = date("Y-m-d"); // Get the current date

  // Validate and sanitize data as needed

  // Insert data into tblreviews (modify as per your table structure)
  $sql = "INSERT INTO tblreviews (GUESTID, REVIEW_TEXT, RATING, REVIEW_DATE) 
          VALUES ('$guestId', '$feedbackText', '$rating', '$feedbackDate')";


$mydb->setQuery($sql);
$msg = $mydb->executeQuery();
}