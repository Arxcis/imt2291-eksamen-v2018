<?php

session_start();

function handleAsyncUploadImage() {
    $fname    = $_SERVER['HTTP_X_ORIGINALFILENAME'];       // Get extra parameters
    $fsize    = $_SERVER['HTTP_X_ORIGINALFILESIZE'];
    $mimetype = $_SERVER['HTTP_X_ORIGINALMIMETYPE'];
  
    header("Content-type: application/json");           // Send back json data


    $fname = md5(microtime() . $fname . $fsize . $mimetype) . '-' . $fname;


    $handle = fopen('php://input', 'r');                // Read the file from stdin

    //
    // MODIFICATION - adding md5 hash to all file names, so pictures
    // with same file name can be uploaded and will not overwrite each other.
    // - JSolsvik 29.05.2018
    //
    $output = fopen('downloadedFiles/' . $fname, 'w');
    $contents = '';

    while (!feof($handle)) {                            // Read in blocks of 8 KB (no file size limit)
        $contents = fread($handle, 8192);
        fwrite($output, $contents);
    }
    fclose($handle);
    fclose($output);


    $data = array ('fname'=>$fname, 'size'=>$fsize, 'mime'=>$mimetype);

    echo json_encode($data);
}


// ASYNC upload image
if ($_SERVER['HTTP_X_ORIGINALFILENAME'] 
    && $_SERVER['HTTP_X_ORIGINALFILESIZE'] 
    && $_SERVER['HTTP_X_ORIGINALMIMETYPE']) {
    handleAsyncUploadImage();
}
