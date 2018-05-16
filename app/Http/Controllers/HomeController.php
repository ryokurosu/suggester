<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Goutte\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    private $textarray;

    public function update(Request $request){
        $lastid = $request->lastid;
        $word = \App\Word::findOrFail($lastid + 1);
        $ret = ['id' => $word->id,'word' => $word->word];
        return $ret;
    }

    public function post(Request $request){

        $word = $request->word;
        $markup = $request->markup;

        $word = trim(mb_convert_kana($word, 's'));

        $this->textarray = ["1,{$word}"];
        $this->getSuggestWord($word,1);
        $ret = $this->formatLevel($this->textarray,$markup);
        noticeDiscord($word);
        \App\Word::create(['word' => $word]);
        return $ret;

    }
    public function getSuggestWord($word,$level){
        $level = $level * 10;
        try {
          $client = new Client();
          $sitemap = $client->request('GET',"https://www.google.com/complete/search?hl=en&q=hello&output=toolbar&q=" . urlencode($word));
          $sitemap->filter('suggestion')->each(function($node) use ($word,&$level){
            try{
                $suggest_word = $node->attr('data');
                if(in_array($suggest_word,$this->suggest_word)) return false;
                $level++;
                array_push($this->textarray,$level.','.$suggest_word);
                // var_dump($this->textarray);
                $this->getSuggestWord($suggest_word,$level);
            }catch(Exception $e){

            }
        });
      } catch (Exception $e) {

      }
  }

  public function formatLevel($textarray,$markup){
    $ret = "";
    foreach($textarray as $line){
        $array = explode(',',$line);

        $array[1] = str_replace(array("\r\n", "\r", "\n"), '', $array[1]);
        $word = $array[1];
        if($array[0] < 10){
            $prefix = 1;
        }else if($array[0] < 100){
            $prefix = 2;
        }else if($array[0] < 1000){
            $prefix = 3;
        }else if($array[0] < 10000){
            $prefix = 4;
        }else if($array[0] < 100000){
            $prefix = 5;
        }else{
            continue;
        }
        if($markup){
            $ret .= "&lt;h{$prefix}&gt;{$word}&lt;/h{$prefix}&gt;" . PHP_EOL;
        }else{
            $ret .= str_repeat("\t",$prefix - 1).$word.PHP_EOL;
        }
        
    }
    return $ret;
}
}
