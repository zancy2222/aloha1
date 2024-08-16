<div class="container">
    <?php
    check_message();
    ?>
    <div class="panel-body">
        <h3 align="left">List of Reviews</h3>
        <form action="controller.php?action=delete" method="POST">
            <table id="example" class="table table-striped" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">
                            Guest Name
                        </th>
                        <th>Review Text</th>
                        <th>Rating</th>
                        <th>Review Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                 $mydb->setQuery("SELECT r.*, CONCAT(g.G_FNAME, ' ', g.G_LNAME) AS GUEST_NAME
				 FROM `tblreviews` r
				 INNER JOIN `tblguest` g ON r.GUESTID = g.GUESTID
				 WHERE r.`REVIEW_TEXT` !=  ''");
 
                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                        echo '<tr>';
                        echo '<td width="5%" align="center"></td>';
						echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="' . $result->REVIEWID . '"/>
						' . $result->GUEST_NAME . '</td>';
				  
                        echo '<td>' . $result->REVIEW_TEXT . '</td>';
                        echo '<td>' . $result->RATING . '</td>';
                        echo '<td>' . $result->REVIEW_DATE . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
			<button type="submit" class="btn btn-default" name="delete">
        <span class="glyphicon glyphicon-trash"></span> Delete Selected
    </button>
        </form>
    </div><!-- End of Panel Body -->
</div><!-- End of container -->
