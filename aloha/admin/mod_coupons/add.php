<form class="form-horizontal well span6" action="controller.php?action=add" method="POST">
    <fieldset>
        <legend>New Coupon</legend>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="COUPON_CODE">Coupon Code:</label>
                <div class="col-md-8">
                    <input name="COUPON_CODE" class="form-control input-sm" id="COUPON_CODE" placeholder="Coupon Code" type="text" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="MAX_USERS">Max Users:</label>
                <div class="col-md-8">
                    <input name="MAX_USERS" class="form-control input-sm" id="MAX_USERS" placeholder="Max Users" type="number" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="START_DATE">Start Date:</label>
                <div class="col-md-8">
                    <input name="START_DATE" class="form-control input-sm" id="START_DATE" placeholder="Start Date" type="date" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="END_DATE">End Date:</label>
                <div class="col-md-8">
                    <input name="END_DATE" class="form-control input-sm" id="END_DATE" placeholder="End Date" type="date" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="DISCOUNT">Discount (%):</label>
                <div class="col-md-8">
                    <input name="DISCOUNT" class="form-control input-sm" id="DISCOUNT" placeholder="Discount" type="text" value="">
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
