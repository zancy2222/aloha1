<?php
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
    $mydb->setQuery("SELECT * FROM tblcoupon WHERE COUPON_ID = " . $_SESSION['id']);
    $res = $mydb->loadSingleResult();
}

if (isset($_POST['save'])) {
    $couponID = $_POST['COUPON_ID'];
    $couponCode = $_POST['COUPON_CODE'];
    $maxUsage = $_POST['MAX_USERS']; // Change to MAX_USAGE
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
?>

<form class="form-horizontal well span6" action="controller.php?action=edit" method="POST">
    <fieldset>
        <legend>Edit Coupon</legend>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="COUPON_CODE">Coupon Code:</label>
                <div class="col-md-8">
                    <input name="COUPON_ID" type="hidden" value="<?php echo $res->COUPON_ID; ?>">
                    <input class="form-control input-sm" id="COUPON_CODE" name="COUPON_CODE" placeholder="Coupon Code" type="text" value="<?php echo $res->COUPON_CODE; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="MAX_USERS">Max Users:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" id="MAX_USAGE" name="MAX_USAGE" placeholder="Max Users" type="number" value="<?php echo $res->MAX_USAGE; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="START_DATE">Start Date:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" id="START_DATE" name="START_DATE" placeholder="Start Date" type="date" value="<?php echo $res->START_DATE; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="END_DATE">End Date:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" id="END_DATE" name="END_DATE" placeholder="End Date" type="date" value="<?php echo $res->END_DATE; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="DISCOUNT">Discount:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" id="DISCOUNT" name="DISCOUNT" placeholder="Discount" type="text" value="<?php echo $res->DISCOUNT; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="idno"></label>
                <div class="col-md-8">
                    <button class="btn btn-primary" name="save" type="submit">Save</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
