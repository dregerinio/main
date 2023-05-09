<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\Http;
use App\Models\Components;

class CommunicationHelper {
    public static function send_data($component_name, $params){
        $request_params = json_encode($params);
        $request_params = base64_encode($request_params);
        $url = config('app.system_components')[$component_name]['setter_url'];
        // dd($url . '/' . $request_params, $params);
        $temp = Http::get($url . '/' . $request_params);
// dd($temp->body());
        $response = preg_replace('/[^0-9.]+/', '', $temp->body());
        // dd($response);
    }

    public static function get_data($component_name){
        $params = [
            'command' => 'get_state',
        ];

        $request_params = json_encode($params);
        $request_params = base64_encode($request_params);
        $url = config('app.system_components')[$component_name]['getter_url'];

        // dd($url . '/' . $request_params, $params);
        $temp = Http::get($url . '/' . $request_params);

        return preg_replace('/[^0-9.]+/', '', $temp->body());
    }

    public static function update_states(){
        $params = [
            'command' => 'get_state',
        ];
        $request_params = json_encode($params);
        $request_params = base64_encode($request_params);

        foreach(config('app.system_components') as $component_name => $component_data){
            $url = $component_data['getter_url'];
//  dd($url . '/' . $request_params, $params);
            $request = Http::get($url . '/' . $request_params);
            $state =  preg_replace('/[^0-9.]+/', '', $request->body());

            Components::where('title', '=', $component_name)->update(['is_active' => $state, 'signal_sent' => 0]);
        }
    }
}