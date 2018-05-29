<?php

session_start();

require_once "DB.php";
require_once "helper.php";


function handleAsyncUploadImage() {
    $fname    = $_SERVER['HTTP_X_ORIGINALFILENAME'];       // Get extra parameters
    $fsize    = $_SERVER['HTTP_X_ORIGINALFILESIZE'];
    $mimetype = $_SERVER['HTTP_X_ORIGINALMIMETYPE'];
    $craftId  = $_SERVER['HTTP_X_CRAFTID'];
  
    header("Content-type: application/json");           // Send back json data


    $fname = md5(microtime() . $fname . $fsize . $mimetype) . '-' . $fname;


    //
    // Stream file from client
    //
    $handle = fopen('php://input', 'r');                // Read the file from stdin
    $output = fopen('uploadedFiles/' . $fname, 'w');
    $contents = '';

    while (!feof($handle)) {                            // Read in blocks of 8 KB (no file size limit)
        $contents = fread($handle, 8192);
        fwrite($output, $contents);
    }
    fclose($handle);
    fclose($output);


    //
    // PRocess thumbnail
    //    
    $thumbnail = file_get_contents('uploadedFiles/' . $fname);
    $scaledThumbnail = scaleThumbnail($thumbnail, 200, 200);

    $db = DB::getConnection();
    DB::postAircraftImage(
        $db,
        $scaledThumbnail,
        $mimetype,
        $fname,
        $craftId
    );

    //
    // Return response
    //
    $data = array ('fname'=>$fname, 'size'=>$fsize, 'mime'=>$mimetype);
    echo json_encode($data);
}



// ASYNC upload image
if ($_SERVER['HTTP_X_ORIGINALFILENAME'] 
    && $_SERVER['HTTP_X_ORIGINALFILESIZE'] 
    && $_SERVER['HTTP_X_ORIGINALMIMETYPE']
    && $_SERVER['HTTP_X_CRAFTID']) {
    handleAsyncUploadImage();
}
