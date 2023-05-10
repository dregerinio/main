<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Components;
use App\Models\System_parameters;
use App\Http\Helpers\CommunicationHelper;

class MainController extends Controller
{
    public function home(Request $request)
    {
        $password = System_parameters::where('parameter', '=', 'password')->first();
        $difficulty = System_parameters::where('parameter', '=', 'difficulty')->first();
        $view_data = [
            'password' => $password->value,
            'difficulty' => $difficulty->value == 'easy' ? 0 : 1
        ];
        return view('home', $view_data);
    }

    public function get_component_status()
    {
        $components = Components::all();
        $result = [];
        foreach ($components as $component) {
            $result[$component->title] = $component->is_active;
        }

        $difficulty = System_parameters::where('parameter', '=', 'difficulty')->first();
        $result['difficulty'] = $difficulty->value == 'easy' ? 0 : 1;
        return json_encode($result);
    }

    public function activate_component($component_name = "")
    {
        Components::where('title', '=', $component_name)->update(['is_active' => '1', 'signal_sent' => 0]);

        $request_params = [
            'command' => 'change_state',
            'parameter' => 1
        ];

        CommunicationHelper::send_data($component_name, $request_params);
        return response()->json(['success' => true]);
    }

    public function deactivate_component($component_name = '')
    {
        Components::where('title', $component_name)->update(['is_active' => '0', 'signal_sent' => 0]);
        $request_params = [
            'command' => 'change_state',
            'parameter' => 0
        ];

        CommunicationHelper::send_data($component_name, $request_params);
        return response()->json(['success' => true]);
    }
    
    public function test(){
        return 'lol';
    }

    public function send_pattern(Request $request)
    {
        $pattern = $request->input('data');
        if (count($pattern) != 8) {
            return response()->json([$pattern]);
        }

        $patternstring = implode('', $pattern);

        $request_params = [
            'command' => 'change_pattern',
            'parameter' => $patternstring
        ];

        CommunicationHelper::send_data('game_1', $request_params);
        return response()->json(['success' => true]);
    }

    public function send_password(Request $request){
        $password = $request->input('data');
        System_parameters::where('parameter', '=', 'password')->update(['value' => $password]);


        $request_params = [
            'command' => 'change_password',
            'parameter' => $password
        ];

        CommunicationHelper::send_data('game_2', $request_params);
        return response()->json(['success' => true]);
    }

    public function set_difficulty(Request $request)
    {
        $level = $request->input('level');
        System_parameters::where('parameter', '=', 'difficulty')->update(['value' => $level]);

        $request_params = [
            'command' => 'change_difficulty',
            'parameter' => $level

        ];
        CommunicationHelper::send_data('game_1', $request_params);
        CommunicationHelper::send_data('game_2', $request_params);
        return response()->json(['success' => true]);
    }

    function reset(){
        CommunicationHelper::reset();
        Components::query()->update(['is_active' => 0, 'signal_sent' => 0]);
        Components::where(['title' => 'motor'])->update(['signal_sent' => 1]);
    }

    public function loop(){
        CommunicationHelper::update_states();
        // get statuses
        $components = [];
        $components_data = Components::all();
        foreach($components_data as $component){
            $components[$component->title] = ['is_active' => $component->is_active, 'signal_sent' => $component->signal_sent];
        }

        if($components['game_1']['is_active'] && !$components['door_1']['is_active']){
            $request_params = [
                'command' => 'change_state',
                'parameter' => 1
            ];
    
            CommunicationHelper::send_data('door_1', $request_params);
            Components::where('title', 'door_1')->update(['is_active' => '1', 'signal_sent' => 1]);
        }
        if($components['game_2']['is_active'] && !$components['door_2']['is_active']){
            $request_params = [
                'command' => 'change_state',
                'parameter' => 1
            ];
    
            CommunicationHelper::send_data('door_2', $request_params);
            Components::where('title', 'door_2')->update(['is_active' => '1', 'signal_sent' => 1]);
        }
        if($components['door_1']['is_active'] && !$components['door_1']['signal_sent']){
            $request_params = [
                'command' => 'change_state',
                'parameter' => 1
            ];
    
            CommunicationHelper::send_data('door_1', $request_params);
            Components::where('title', 'door_1')->update(['is_active' => '1', 'signal_sent' => 1]);
        }
        if($components['door_2']['is_active'] && !$components['door_2']['signal_sent']){
            $request_params = [
                'command' => 'change_state',
                'parameter' => 1
            ];
    
            CommunicationHelper::send_data('door_2', $request_params);
            Components::where('title', 'door_2')->update(['is_active' => '1', 'signal_sent' => 1]);
        }
        if($components['door_3']['is_active'] && !$components['door_3']['signal_sent']){
            $request_params = [
                'command' => 'change_state',
                'parameter' => 1
            ];
    
            CommunicationHelper::send_data('door_3', $request_params);
            Components::where('title', 'door_3')->update(['is_active' => '1', 'signal_sent' => 1]);
        }
        // if($components['door_4']['is_active'] && !$components['door_4']['signal_sent']){
        //     //send_command
        //     Components::where('title', 'door_4')->update(['is_active' => '1', 'signal_sent' => 1]);
        // }
        // if(!$components['motor']['signal_sent']){
        //     //send_command
        //     Components::where('title', 'motor')->update(['signal_sent' => 1]);
        // }
    }
}
