<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function home(){
        return view('home');
    }

    public function init_components(){
        $result = [];
        foreach(config('app.system_components') as $component_name => $component_data){
            $result[$component_name] = Http::get($component_data['url'] . '/init')->status() == 200;
        }
        return json_encode($result);
    }

    public function get_component_status(){
        $result = [];
        foreach(config('app.system_components') as $component_name => $component_data){
            $result[str_replace('Component ', '', $component_name)] = json_decode(Http::get($component_data['url'] . '/get_status')->body(), true)['active'];
        }
        return json_encode($result);
    }

    public function activate_component($component_number = 0){
        Http::get(config('app.system_components')['Component '. $component_number]['url'] . '/activate');
    }

    public function deactivate_component($component_number = 0){
        Http::get(config('app.system_components')['Component '. $component_number]['url'] . '/deactivate');
    }
}