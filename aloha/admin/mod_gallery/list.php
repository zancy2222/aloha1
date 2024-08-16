<div class="container">
    <?php
    check_message();

    // Assuming you have a connection object named $mydb
    $mydb->setQuery("SELECT * FROM `tblgallery`");
    $galleryItems = $mydb->loadResultList();

      
    ?>




    <div class="panel-body">
        <h3 align="left">List of Gallery Items</h3>
        <form action="controller.php?action=delete" method="POST">
            <table id="example" class="table table-striped" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">
                            Image
                        </th>
                   
                        <th>Description</th>
                        <!-- Add more columns if needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($galleryItems as $key => $item) {
                        echo '<tr>';
                        echo '<td width="5%" align="center">' . ($key + 1) . '</td>';
                        echo '<td>
                            <input type="checkbox" name="selector[]" id="selector[]" value="' . $item->GALLERYID . '"/>
                            ' . generateImageList($item->IMAGE_URL) . '
                        </td>';
              
                        echo '<td>' . $item->DESCRIPTION . '</td>';
                        // Add more columns if needed
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

<?php
// Function to generate a list of images with delete buttons


function generateImageList($imageList)
{
    $images = explode(',', $imageList);
    $html = '<ul class="image-list">';
    foreach ($images as $image) {
        $html .= '<li>
                    <img src="' . $image . '" alt="Gallery Image" style="max-width: 100px; max-height: 100px; margin: 5px;">
                </li>';
    }
    $html .= '</ul>';
    return $html;
}
?>


