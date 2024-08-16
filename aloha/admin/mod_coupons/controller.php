<?php
require_once("../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        doInsert();
        break;

    case 'edit':
        doEdit();
        break;

    case 'delete':
        doDelete();
        break;
}
function doInsert()
{
    global $mydb;

    if (isset($_POST['save'])) {
        $couponCode = $_POST['COUPON_CODE'];
        $maxUsers = $_POST['MAX_USERS'];
        $startDate = $_POST['START_DATE'];
        $endDate = $_POST['END_DATE'];
        $discountInput = isset($_POST['DISCOUNT']) ? $_POST['DISCOUNT'] : 0; // Assuming default value is 0 if not provided

        // Validate and sanitize input data before inserting into the database
        $discount = filter_var($discountInput, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 100)));

        if ($discount === false) {
            message("Invalid discount value. Please enter a number between 0 and 100.", "error");
            redirect("index.php");
            return;
        }

        // Convert percentage to decimal
        $discountDecimal = $discount / 100;

        // Perform the manual insert query
        $query = "INSERT INTO tblcoupon (COUPON_CODE, MAX_USAGE, START_DATE, END_DATE, CURRENT_USAGE, DISCOUNT) VALUES ('$couponCode', $maxUsers, '$startDate', '$endDate', 0, $discountDecimal)";
        $mydb->setQuery($query);

        if ($mydb->executeQuery()) {
            message("Coupon added successfully!", "success");
        } else {
            message("Failed to add coupon!", "error");
        }

        redirect("index.php");
    }
}


function doEdit()
{
    global $mydb;

    if (isset($_POST['save'])) {
        $couponID = $_POST['COUPON_ID'];
        $couponCode = $_POST['COUPON_CODE'];
        $maxUsage = $_POST['MAX_USAGE'];
        $startDate = $_POST['START_DATE'];
        $endDate = $_POST['END_DATE'];
        $discount = $_POST['DISCOUNT'];

        // You should validate and sanitize input data before updating the database

        // Perform the manual update query
        $query = "UPDATE tblcoupon SET COUPON_CODE='$couponCode', MAX_USAGE=$maxUsage, START_DATE='$startDate', END_DATE='$endDate', DISCOUNT=$discount WHERE COUPON_ID=$couponID";
        $mydb->setQuery($query);

        if ($mydb->executeQuery()) {
            message("Coupon updated successfully!", "success");
        } else {
            message("Failed to update coupon!", "error");
        }

        redirect("index.php");
    }
}



function doDelete()
{
    global $mydb;

    if (isset($_POST['delete'])) {
        $ids = isset($_POST['selector']) ? $_POST['selector'] : array();

        if (empty($ids)) {
            message("Please select at least one coupon to delete.", "error");
        } else {
            // Perform the manual delete query
            $idString = implode(",", $ids);
            $query = "DELETE FROM tblcoupon WHERE COUPON_ID IN ($idString)";
            $mydb->setQuery($query);

            if ($mydb->executeQuery()) {
                message("Coupons deleted successfully!", "success");
            } else {
                message("Failed to delete coupons!", "error");
            }
        }

        redirect("index.php");
    }
}




// Other functions (doEdit, doDelete) remain unchanged
