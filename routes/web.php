<?php

use Illuminate\Support\Facades\Route;
use App\Events\Register;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/te/{type}', function ($type) {
    $data['artsion']=$type;
//    $data['params'][0]['body']=["user"=>"第八区-jacklove2","message"=>"today is good day","uid"=>5,"age"=>30,"city"=>"纽约","country"=>"America","address"=>"美国纽约","location"=>["lat"=>"10.32354","lon"=>"48.23233"]];
//    $data['params'][1]['body']=["user"=>"第八区-jacklove3","message"=>"today is good day","uid"=>5,"age"=>30,"city"=>"纽约","country"=>"America","address"=>"美国纽约","location"=>["lat"=>"10.32354","lon"=>"48.23233"]];
//    $data['field']=[
//        'bool' =>[
//            'must'=>[
//                ['match'=>['user'=>'jacklove2']],
//                ['match'=>['age'=>30]]
//            ]
//        ]
//    ];
    $data['field']=['match_all' => new \stdClass()];
    $data['page']=1;
    $data['pageSize']=10;

    $re = event(new Register($data));
    var_dump($re);
});


Route::get('/user', function () {
    return view('welcome');
});
