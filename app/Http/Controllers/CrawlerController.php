<?php

namespace App\Http\Controllers;

use Goutte\Client;

class CrawlerController {
    public function getRecommends (string $name) {
        try {
            $url = "https://www.last.fm/pt/music/$name/+similar";
            $client = new Client();
            $crawler = $client->request('GET', $url);
            $artists = $crawler->filter('.similar-artists-item-name')->each(function ($node) {
                $artistName = $node->filter('.link-block-target')->each(function ($innerNode) {
                    return $innerNode->text();                    
                });

                return $artistName[0];
            });
            
            return $artists;
        
        } catch (\Exception $ex) {
            return response()->json(["Error" => $ex->getMessage()]);
        }
    }
}