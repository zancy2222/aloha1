<div class="container">
    <?php
    check_message();

    $mydb->setQuery("SELECT * FROM `tblcoupon`");
    $coupons = $mydb->loadResultList();
    ?>

    <div class="panel-body">
        <h3 align="left">List of Coupons</h3>
        <form action="controller.php?action=delete" method="POST">
            <table id="example" class="table table-striped" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">
                            Coupon Code
                        </th>
                        <th>Max Usage</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Discount</th> <!-- Add this line -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($coupons as $key => $coupon) {
                        echo '<tr>';
                        echo '<td width="5%" align="center">' . ($key + 1) . '</td>';
                        echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="' . $coupon->COUPON_ID . '"/>
                        <a href="index.php?view=edit&id=' . $coupon->COUPON_ID . '">' . $coupon->COUPON_CODE . '</a></td>';
                  
                        echo '<td>' . $coupon->MAX_USAGE . '</td>';
                        echo '<td>' . $coupon->START_DATE . '</td>';
                        echo '<td>' . $coupon->END_DATE . '</td>';
                        echo '<td>' . $coupon->DISCOUNT . '</td>'; 
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="btn-group">
                <a href="index.php?view=add" class="btn btn-default">New</a>
                <button type="submit" class="btn btn-default" name="delete">
                    <span class="glyphicon glyphicon-trash"></span> Delete Selected
                </button>
            </div>
        </form>
    </div>
</div>
