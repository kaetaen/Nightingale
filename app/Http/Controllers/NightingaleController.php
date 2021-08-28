<?php

namespace App\Http\Controllers;
  
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Http\Controllers\CrawlerController;
  
class NightingaleController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
  
        $botman->hears('{message}', function($botman, $message) {

            $crawler = new CrawlerController();
            $artists = $crawler->getRecommends($message);
            if ($artists) {
                $artists = implode("<br>", $artists);
                $botman->reply("🐦 Essas são minhas recomendações de artistas semelhantes a $message: ");
                $botman->reply($artists);
            } else {
                $botman->reply("🐦 Infelizmente não consegui identificar o artista. Como dizia o Raul Seixas: 'tente outra vez'!");
            }
                
        });
  
        $botman->listen();
    }
}
