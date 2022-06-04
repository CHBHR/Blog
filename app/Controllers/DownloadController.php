<?php

namespace App\Controllers;

class DownloadController extends Controller{

    public function downloadpdf(){

        $file = 'D:\Programmes\wamp64\www\projects\P05_blog\public\downloads\CV2020.pdf';

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Content-Type: application/force-download");
            header('Content-Disposition: attachment; filename=' . urlencode(basename($file)));
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
        }
    }
}
