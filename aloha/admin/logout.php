<?php
require_once("../includes/initialize.php");

// Check if the user has confirmed logout
if (isset($_POST['confirm_logout']) && isset($_SESSION['loginid'])) {
    // 1. Unset all the session variables
    unset($_SESSION['ADMIN_ID']);
    unset($_SESSION['ADMIN_UNAME']);
    unset($_SESSION['ADMIN_USERNAME']);
    unset($_SESSION['ADMIN_UPASS']);
    unset($_SESSION['ADMIN_UROLE']);

    // 2. Get the current logout time
    $logoutTime = date('Y-m-d H:i:s');

    // 3. Update logout time in tbladminlogs table based on loginid
    $loginid = $_SESSION['loginid'];
    $query = "UPDATE tbladminlogs SET logouttime = '$logoutTime' WHERE loginid = $loginid";
    $mydb->setQuery($query);

    if ($mydb->executeQuery()) {
        message("Logout time updated successfully!", "success");
    } else {
        message("Failed to update logout time!", "error");
    }

    // 4. Destroy the session
    session_destroy();

    redirect(WEB_ROOT . "admin/index.php?logout=1");
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="">
                    <button type="submit" class="btn btn-danger" name="confirm_logout">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Automatically show the modal on page load -->
<script>
    $(document).ready(function() {
        $('#logoutModal').modal('show');

        // Store the current URL in a variable
        var currentUrl = window.location.href;

        // Set the action attribute of the form to the current URL
        $('#logoutModal form').attr('action', currentUrl);

        // Handle form submission when clicking "No"
        $('#logoutModal button[data-dismiss="modal"]').on('click', function() {
            // Redirect to index.php
            window.location.href = "<?php echo WEB_ROOT; ?>admin/index.php";
        });
    });
</script>


</body>
</html>
