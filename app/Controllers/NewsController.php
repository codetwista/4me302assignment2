<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NewsController extends BaseController
{
    public function index()
    {
        if (! $this->session->profile || $this->session->profile !== 'researcher') {
            return redirect()->back();
        }
    
        libxml_use_internal_errors(TRUE);
    
        $rss = 'https://www.news-medical.net/tag/feed/Parkinsons-Disease.aspx';
        $rssFeed = simplexml_load_file($rss);
    
        if ($rssFeed === FALSE) {
            echo "There were errors parsing the XML file.\n";
            foreach(libxml_get_errors() as $error) {
                echo $error->message;
            }
        }
    
        /*$objJsonDocument = json_encode($objXmlDocument);
        $arrOutput = json_decode($objJsonDocument, TRUE);*/
        
        // Render news view
        return view('researcher/news', [
            'title' => 'Researcher news',
            'news' => $rssFeed
        ]);
    }
}
