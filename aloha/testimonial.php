<!-- visitors -->
<div class="w3l-visitors-agile">
    <div class="container">
        <h3 class="title-w3-agileits title-black-wthree">What other visitors experienced</h3>
    </div>
    <div class="w3layouts_work_grids">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">

                    <?php

                    require_once("includes/initialize.php");

                    // Function to fetch only the latest reviews for each guest
                    function fetchLatestReviews($mydb)
                    {
                        // Modify this part based on your table and database structure
                        $query = "SELECT r.*, g.G_FNAME, g.G_LNAME
                                  FROM tblreviews r
                                  JOIN tblguest g ON r.GUESTID = g.GUESTID
                                  WHERE r.REVIEW_DATE = (
                                      SELECT MAX(REVIEW_DATE)
                                      FROM tblreviews
                                      WHERE GUESTID = r.GUESTID
                                  )";

                        // Execute the query using $mydb
                        $mydb->setQuery($query);
                        $result = $mydb->executeQuery();

                        $reviews = [];
                        while ($row = $result->fetch_object()) {
                            $reviews[] = $row;
                        }

                        return $reviews;
                    }

                    // Fetch latest reviews using the function
                    $reviews = fetchLatestReviews($mydb);

                    // Display reviews in HTML structure
                    foreach ($reviews as $review) {
                        echo '<li>';
                        echo '<div class="w3layouts_work_grid_left">';
                        echo '<img src="images/image/Front.jpeg" alt=" " class="img-responsive" />';
                        echo '<div class="w3layouts_work_grid_left_pos"></div>';
                        echo '</div>';
                        echo '<div class="w3layouts_work_grid_right">';
                        echo '<h4>';
                        
                        // Display star icons based on the rating
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $review->RATING) {
                                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                            } else {
                                echo '<i class="fa fa-star-o" aria-hidden="true"></i>'; // Use 'fa-star-o' for empty star
                            }
                        }
                    
                        echo '</h4>';
                        echo '<p>' . $review->REVIEW_TEXT . '</p>';
                        echo '<h5>' . $review->G_FNAME . ' ' . $review->G_LNAME . '</h5>'; // Display guest name
                        echo '</div>';
                        echo '<div class="clearfix"> </div>';
                        echo '</li>';
                    }

                    ?>

                </ul>
            </div>
            
        </section>
    </div>
</div>






  <style>
    @media (min-width:1081px){

/* Heading */
.w3l-visitors-agile li h4{
 font-size:20px;
}

}
  </style>