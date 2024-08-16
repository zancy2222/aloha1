
<?php
		check_message();
			
		?>
        <form class="form-horizontal well span6" action="controller.php?action=add" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>New Gallery Item</legend>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="ROOM_ID">Select Room:</label>
                <div class="col-md-8">
                    <select name="ROOM_ID" class="form-control input-sm" id="ROOM_ID">
                        <?php
                        // Assuming $mydb is your database connection object
                        $mydb->setQuery("SELECT * FROM `tblroom`");
                        $rooms = $mydb->loadResultList();

                        foreach ($rooms as $room) {
                            echo '<option value="' . $room->ROOMID . '">' . $room->ROOM . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="DESCRIPTION">Description:</label>
                <div class="col-md-8">
                    <input name="DESCRIPTION" class="form-control input-sm" id="DESCRIPTION" placeholder="Description" type="text" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="IMAGES">Images:</label>
                <div class="col-md-8">
                    <input name="IMAGES[]" class="form-control input-sm" id="IMAGES" type="file" accept="image/*" multiple>
                </div>
            </div>
        </div>

        <!-- Add more fields if needed -->

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
