<?php
require_once("../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        doInsert();
        break;

    case 'edit':
        doEdit();
        break;

    case 'delete':
        doDelete();
        break;





    }


    function doInsert()
    {
        global $mydb;
    
        if (isset($_POST['save'])) {
            $roomId = $_POST['ROOM_ID'];
            $description = $_POST['DESCRIPTION'];
    
            // Fetch ROOM from tblroom based on ROOM_ID
            $roomQuery = "SELECT ROOM FROM tblroom WHERE ROOMID = '$roomId'";
            $mydb->setQuery($roomQuery);
            $roomResult = $mydb->executeQuery();
            $roomRow = $roomResult->fetch_assoc();
    
            // Get TITLE from tblroom
            $title = isset($roomRow['ROOM']) ? $roomRow['ROOM'] : '';
    
            // Handle multiple images
            if (isset($_FILES['IMAGES'])) {
                $imageFiles = $_FILES['IMAGES'];
                $uploadedImages = handleMultipleImages($imageFiles);
    
                // Validate if at least one image is uploaded
                if (empty($uploadedImages)) {
                    message("Please upload at least one image.", "error");
                    redirect("index.php");
                    return;
                }
            }
    
            // Perform the manual insert query
            $query = "INSERT INTO tblgallery (ROOMID, IMAGE_URL, DESCRIPTION, TITLE) 
                      VALUES ('$roomId', '$uploadedImages', '$description', '$title')";
            $mydb->setQuery($query);
    
            if ($mydb->executeQuery()) {
                message("Gallery item added successfully!", "success");
            } else {
                message("Failed to add gallery item!", "error");
            }
    
            redirect("index.php");
        }
    }
    
    // Helper function to handle multiple image uploads
    function handleMultipleImages($imageFiles)
    {
        $uploadedImages = [];
        
        foreach ($imageFiles['name'] as $key => $name) {
            $tempName = $imageFiles['tmp_name'][$key];
    
            // Generate a filename like "img1", "img2", etc.
            $newName = "img" . ($key + 1);
            $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
            $targetPath = "../uploads/" . $newName . "." . $fileExtension;
    
            // Validate and move the uploaded image
            if (move_uploaded_file($tempName, $targetPath)) {
                $uploadedImages[] = $targetPath;
            }
        }
    
        // Return comma-separated string of image paths
        return implode(",", $uploadedImages);
    }
    

   
function doDelete()
{
    global $mydb;

    if (isset($_POST['delete'])) {
        $ids = isset($_POST['selector']) ? $_POST['selector'] : array();

        if (empty($ids)) {
            message("Please select at least one gallery to delete.", "error");
        } else {
            // Perform the manual delete query
            $idString = implode(",", $ids);
            $query = "DELETE FROM tblgallery WHERE GALLERYID IN ($idString)";
            $mydb->setQuery($query);

            if ($mydb->executeQuery()) {
                message("Gallery deleted successfully!", "success");
            } else {
                message("Failed to delete Gallery!", "error");
            }
        }

        redirect("index.php");
    }
}

// Other functions (doEdit, doDelete) remain unchanged
