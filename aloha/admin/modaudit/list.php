<div class="container">
    <?php
    check_message();
    
    ?>
    <div class="panel-body">
        <h3 align="left">List of Audit Logs</h3>
        <table id="example" class="table table-striped" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                 
                </tr>
            </thead>
            <tbody>
                <?php 
                $mydb->setQuery("SELECT * FROM tbladminlogs");
                $cur = $mydb->loadResultList();

                foreach ($cur as $key => $result) {
                    echo '<tr>';
                    echo '<td>' . ($key + 1) . '</td>';
                    echo '<td>' . $result->uname . '</td>';
                    echo '<td>' . $result->logintime . '</td>';
                    echo '<td>' . $result->logouttime . '</td>';
                   
                    echo '</tr>';
                } 
                ?>
            </tbody>
        </table>
    </div><!--End of Panel Body-->
</div><!--End of container-->
