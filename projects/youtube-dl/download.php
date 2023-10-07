<?php

    $file = $_SERVER['QUERY_STRING'] ?? null;

    if ($file === null || substr($file, 0, 18) !== 'video_url=https://') {
        die('Cannot find the video_url URL parameter');
    }

    $file = substr($file, 10);

    $headers = array_change_key_case(get_headers($file, true));

    $fileSize = (array)$headers['content-length'];

    if (count($fileSize) === 0) {
        die('Cannot fetch the file size');
    }

    if (strpos('404 Not Found', $headers[0]) === false) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=videoplayback.mp4');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $fileSize[count($fileSize)-1]);
        echo "downloading";
        ob_clean();
        flush();
        readfile($file);
        exit;
    } else {
        die($file . " is not found...\n");
    }

    while(true) {
        echo "\n";
        if (connection_status() != 0) {
            die;
        }
    }
