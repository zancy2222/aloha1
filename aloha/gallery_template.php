
<?php
// gallery_template.php

// Assuming you have a database connection established

// Retrieve ROOMID from the URL parameter
$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : 0;

// Fetch gallery items for the specified ROOMID
// Adjust the SQL query according to your actual database structure
$query = "SELECT * FROM tblgallery WHERE ROOMID = $room_id";
$mydb->setQuery($query);

// Execute the query
$result = $mydb->executeQuery();

// Check if there are gallery items for the specified room
if ($result && $result->num_rows > 0) {

    echo '<a href="index.php?p=rooms" class="btn btn-primary mb-3">Back to Rooms</a>';
    echo '<div class="container text-center mb-4">';


    // Loop through gallery items
    while ($row = $result->fetch_assoc()) {
        // Display room title (if available)
        if (isset($row['TITLE'])) {
            echo '<h2 class="mb-3">' . $row['TITLE'] . '</h2>';
        }

        // Display room description (if available)
        if (isset($row['DESCRIPTION'])) {
            echo '<p class="mb-3">' . $row['DESCRIPTION'] . '</p>';
        }

        echo '<div class="row mx-auto">';

        echo '<div class="col-md-4">';
        echo '<div class="gallery-item">';
        
        // Add a container for the image to maintain consistent dimensions
        echo '<div class="image-container">';
        
        // Check if the "IMAGE_URL" key exists in the result set
        if (isset($row['IMAGE_URL'])) {
            // Check if there are multiple images
            $imageList = $row['IMAGE_URL'];

            // Use the generateImageList function to display the images
            echo generateImageList($imageList);
        } else {
            // If "IMAGE_URL" key is not present, display a placeholder or handle it accordingly
            echo '<p>No images available.</p>';
        }

        
    // Add a back button


        echo '</div>'; // Close the image-container
        echo '</div>';
        echo '</div>';

        echo '</div>';
    }

    echo '</div>';

   
}
else {
    echo '<p class="text-center">No gallery items found for this room.</p>';
}

// Include the function definition here if it's not already included
function generateImageList($imageList)
{
    $images = explode(',', $imageList);
    $html = '<div class="container"><div class="row justify-content-center">';

    foreach ($images as $image) {
        $imageName = basename($image);
        $html .= '<div class="col-md-4 mb-3 text-center">';
        
        // Add the "data-fancybox" attribute to enable Fancybox
        $html .= '<a href="admin/uploads/' . $imageName . '" data-fancybox="gallery">';
        $html .= '<img src="admin/uploads/' . $imageName . '" class="img-fluid" style="width: 200px; height: 150px;" alt="Gallery Image">';
        $html .= '</a>';
        
        $html .= '</div>';
    }

    $html .= '</div></div>';

    return $html;
}


?>

<style>
    /* Heading */
.container h2{
 padding-top:62px;
}

/* Paragraph */
.container p{
 font-size:18px;
 padding-top:3px;
 padding-bottom:0px;
}
 /* Row */
.gallery-item .justify-content-center{
 position:relative;
 top:14px;
}

/* Body */
body{
 position:relative;
 top:154px;
}





</style>