<?php

require_once __DIR__ . "/vendor/autoload.php";


function echoline($line) {
    echo "<h4>" . $line . "</h4> " ;
}

function badRequest404($key) {
    echoline("ERROR - Bad Request 404. Missing: " . $key);
    die();
}

function serverError500() {
    echoline("ERROR - Server Error 500");
}


function requireTwig() {
    $loader = new Twig_Loader_Filesystem(__DIR__ . "/template");
    return new Twig_Environment($loader, array(
    //    'cache' => './compilation_cache',
    ));
}



//
// COPY PASTED FROM PROJECT 1 URGEWWW
//



 /**
  * @note stolen from okolloen examples
  */ 
function scaleThumbnail($_img, $new_width=150, $new_height=150) {

    $img = imagecreatefromstring($_img);

    $old_x = imageSX($img);
    $old_y = imageSY($img);

    if($old_x > $old_y) {                     // Image is landscape mode
        $thumb_w = $new_width;
        $thumb_h = $old_y*($new_height/$old_x);
    } else if($old_x < $old_y) {              // Image is portrait mode
        $thumb_w = $old_x*($new_width/$old_y);
        $thumb_h = $new_height;
    } if($old_x == $old_y) {                  // Image is square
        $thumb_w = $new_width;
        $thumb_h = $new_height;
    }

    if ($thumb_w>$old_x) {                    // Don't scale images up
        $thumb_w = $old_x;
        $thumb_h = $old_y;
    }

    $dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
    imagecopyresampled($dst_img,$img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

    ob_start();                         // flush/start buffer
    imagepng($dst_img, NULL,9);          // Write image to buffer
    $scaledImage = ob_get_contents();   // Get contents of buffer
    ob_end_clean();                     // Clear buffer

    return $scaledImage;
}

function encodeThumbnailToBase64($thing) {

    if (empty($thing)) {
        return $thing;
    }
    if(isset($thing['thumbnail']))
        $thing['thumbnail'] = base64_encode($thing['thumbnail']);
    return $thing;
}

function encodeThumbnailsToBase64($thingArray) {

    if (empty($thingArray)) {
        return $thingArray;
    }

    foreach ($thingArray as &$thing) {
        if(isset($thing['thumbnail']))
            $thing['thumbnail'] = base64_encode($thing['thumbnail']);
    }
    return $thingArray;
}


// Function for upload errors
function getFileuploadErrormessage($errorNumber){
  // Source: http://php.net/manual/en/function.is-uploaded-file.php
  // More source: http://php.net/manual/en/features.file-upload.errors.php
  switch($errorNumber){
    case UPLOAD_ERR_OK: // This should not show up, but is here just in case
      return "There is no error, the file uploaded with success."; break;
    case UPLOAD_ERR_INI_SIZE:
      return "The uploaded file exceeds the upload_max_filesize directive in php.ini."; break;
    case UPLOAD_ERR_FORM_SIZE:
      return "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form."; break;
    case UPLOAD_ERR_PARTIAL:
      return "The uploaded file was only partially uploaded."; break;
    case UPLOAD_ERR_NO_FILE:
      return "No file was uploaded."; break;
    case UPLOAD_ERR_NO_TMP_DIR:
      return "Missing a temporary folder."; break;
    case UPLOAD_ERR_CANT_WRITE:
      return "Failed to write file to disk."; break;
    case UPLOAD_ERR_EXTENSION:
      return "A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop;
      examining the list of loaded extensions with phpinfo() may help."; break;
    default:
      return "There was a problem with your upload."; break;
    }

}

//
// COPY PASTED FROM PROJECT 1 URGEWWW
//
