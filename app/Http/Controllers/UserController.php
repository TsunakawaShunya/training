<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RakutenRws_Client;

class UserController extends Controller
{
    public function shopping(Request $request) {
        //楽天APIを扱うRakutenRws_Clientクラスのインスタンスを作成
        $client = new RakutenRws_Client();
        //定数化
        define("RAKUTEN_APPLICATION_ID"     , config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        
        //アプリIDをセット
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        
        
        //dd($client);

        //リクエストから検索キーワードを取り出し
        $inputs = $request['keyword'];
        $keyword = "";
        if($inputs == null){
            $keyword = "フィットネス";
        } else {
            foreach($inputs as $input){
                $keyword .= $input . " ";
            }
        }
        // IchibaItemSearch API から、指定条件で検索
        if(!empty($keyword)){ 
            $response = $client->execute('IchibaItemSearch', array(
                //入力パラメーター
                'keyword' => $keyword,
            ));

            if ($response->isOk()) {
                $items = array();
                //配列で結果をいれる
                foreach ($response as $item){
                    //画像サイズを変えたかったのでURLを整形
                    $str = str_replace("_ex=128x128", "_ex=240x240", $item['mediumImageUrls'][0]['imageUrl']);
                    $items[] = array(
                        'itemName' => $item['itemName'],
                        'itemPrice' => $item['itemPrice'],
                        'itemUrl' => $item['itemUrl'],
                        'mediumImageUrls' => $str,
                    );
                }
            }
        }
        return view("shopping.index")->with(['items' => $items]);
    }
    
    public function showMap() {
        return view("map.index");
    }
}