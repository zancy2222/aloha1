<?php 
require_once("../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	
	case 'delete' :
	doDelete();
	break;


	}


    function doDelete() {
        global $mydb;
    
        if (isset($_POST['selector']) && !empty($_POST['selector'])) {
            $selectedIds = $_POST['selector'];
            $ids = implode("', '", $selectedIds);
            $sql = "DELETE FROM tblreviews WHERE REVIEWID IN ('$ids')";
    
            $mydb->setQuery($sql);
    
            if ($mydb->executeQuery()) {
                message("Deleted successfully!", "success");
            } else {
                message("Error deleting records. Please try again.", "error");
            }
    
            redirect('index.php');
        } else {
            echo 'No reviews selected for deletion';
            // Handle the case when no reviews are selected
        }
    }
    
?>