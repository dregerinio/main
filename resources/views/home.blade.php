<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('home') }}" class="brand-link text-center">
                <span class="brand-text font-weight-light">ТУ-София</span>
            </a>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <h1 class="m-0">Главен контролен панел</h1>
                        </div>
                        <div class="col-sm-8">
                            <table style="width:100%;">
                                <tbody style="width:100%;" class="text-right">
                                    <tr>
                                        <td>
                                            <button onclick="reset()" class="btn btn-warning text-light">Рестартирай</button>
                                        </td>
                                        <td style="width: 25%;">
                                            <h5 class="align-middle mr-5">Избери трудност</h5>
                                        </td>
                                        <td style="width: 10%;">
                                            <div>
                                                <button style='width:100%;' id='difficulty_button_low' type="button"
                                                    onclick="set_difficulty('easy')" class="btn">Лесна</button>
                                            </div>
                                            <div>
                                                <button style='width:100%;' id='difficulty_button_high' type="button"
                                                    onclick="set_difficulty('difficult')" class="btn">Трудна</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-11 offset-1">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-4 offset-4">
                                                    <h5 id="game_1_card" class="card-text float-none p-2 mb-3">Пъзел 1
                                                    </h5>
                                                </div>
                                            </div>
                                            <h5 class="card-text mb-3">
                                                Simon Says
                                            </h5>
                                            <div class="row">
                                                <button id="game_1_go" onclick="activate_component('game_1')"
                                                    class="col-md-4 offset-1 btn btn-success">Пропусни</button>
                                                <button id="game_1_stop" onclick="deactivate_component('game_1')"
                                                    class="col-md-4 offset-2 btn btn-danger">Възспри</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-11 offset-1">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body text-center">
                                            <h5 class="card-text float-none mb-3">Избиране на шарка</h5>
                                            <button onclick="add_to_pattern(0)" class="btn btn-danger"></button>
                                            <button onclick="add_to_pattern(1)" class="btn btn-warning"></button>
                                            <button onclick="add_to_pattern(2)" class="btn btn-success"></button>
                                            <button onclick="add_to_pattern(3)" class="btn btn-primary"></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-11 offset-1">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body text-center">
                                            <h5 class="card-text float-none mb-3">Текуща шарка</h5>
                                            <p class="row">
                                                <button onclick="send_pattern()"
                                                    class="col-md-4 offset-1 btn btn-primary">Изпрати</button>
                                                <button onclick="reset_pattern()"
                                                    class="col-md-4 offset-2 btn btn-danger">Нулирай</button>
                                            </p>
                                            <div class="container overflow-hidden">
                                                <div class="row gy-5" id="pattern_visualizer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-4 offset-4">
                                                    <h5 id="game_2_card" class="card-text float-none p-2 mb-3">Пъзел 2
                                                    </h5>
                                                </div>
                                            </div>
                                            <h5 class="card-text mb-3">
                                                Password game
                                            </h5>
                                            <div class="row">
                                                <button id="game_2_go" onclick="activate_component('game_2')"
                                                    class="col-md-4 offset-1 btn btn-success">Пропусни</button>
                                                <button id="game_2_stop" onclick="deactivate_component('game_2')"
                                                    class="col-md-4 offset-2 btn btn-danger">Възспри</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body text-center">
                                            <h5 class="card-text float-none mb-3">Избиране на парола</h5>
                                            <input type="text" id="password_input" onchange="handle_password()"
                                                class="text-center form-control"
                                                value='{{ $password }}'>
                                            <div class="row">
                                                <button onclick="send_password()"
                                                    class="col-md-4 offset-4 btn btn-primary mt-3">Изпрати</button>
                                            </div>
                                            <div class="container overflow-hidden">
                                                <div class="row gy-5" id="pattern_visualizer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-11 offset-1">
                                            <div class="card card-primary card-outline">
                                                <div class="card-body text-center">
                                                    <h5 class="card-text float-none mb-3">Врата 1</h5>
                                                    <div class="row">
                                                        <button id="door_1_go" onclick="activate_component('door_1')"
                                                            class="col-md-4 offset-1 btn btn-success mt-3">Отвори</button>
                                                        <button id="door_1_stop" onclick="deactivate_component('door_1')"
                                                            class="col-md-4 offset-2 btn btn-danger mt-3">Затвори</button>
                                                    </div>
                                                    <div class="container overflow-hidden">
                                                        <div class="row gy-5" id="pattern_visualizer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="card card-primary card-outline">
                                                <div class="card-body text-center">
                                                    <h5 class="card-text float-none mb-3">Врата 2</h5>
                                                    <div class="row">
                                                        <button id="door_2_go" onclick="activate_component('door_2')"
                                                            class="col-md-4 offset-1 btn btn-success mt-3">Отвори</button>
                                                        <button id="door_2_stop" onclick="deactivate_component('door_2')"
                                                            class="col-md-4 offset-2 btn btn-danger mt-3">Затвори</button>
                                                    </div>
                                                    <div class="container overflow-hidden">
                                                        <div class="row gy-5" id="pattern_visualizer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-11 offset-1">
                                            <div class="card card-primary card-outline">
                                                <div class="card-body text-center">
                                                    <h5 class="card-text float-none mb-3">Врата 3</h5>
                                                    <div class="row">
                                                        <button id="door_3_go" onclick="activate_component('door_3')"
                                                            class="col-md-4 offset-1 btn btn-success mt-3">Отвори</button>
                                                        <button id="door_3_stop" onclick="deactivate_component('door_3')"
                                                            class="col-md-4 offset-2 btn btn-danger mt-3">Затвори</button>
                                                    </div>
                                                    <div class="container overflow-hidden">
                                                        <div class="row gy-5" id="pattern_visualizer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="card card-primary card-outline">
                                                <div class="card-body text-center">
                                                    <h5 class="card-text float-none mb-3">Врата 4</h5>
                                                    <div class="row">
                                                        <button id="door_4_go" onclick="activate_component('door_4')"
                                                            class="col-md-4 offset-1 btn btn-success mt-3">Отвори</button>
                                                        <button id="door_4_stop" onclick="deactivate_component('door_4')"
                                                            class="col-md-4 offset-2 btn btn-danger mt-3">Затвори</button>
                                                    </div>
                                                    <div class="container overflow-hidden">
                                                        <div class="row gy-5" id="pattern_visualizer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-3">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body text-center">
                                            <h5 class="card-text float-none mb-3">Завеса</h5>
                                            <div class="row">
                                                <button id="motor_go" onclick="activate_component('motor')"
                                                    class="col-md-4 offset-1 btn btn-success mt-3">Отвори</button>
                                                <button id="motor_stop" onclick="deactivate_component('motor')"
                                                    class="col-md-4 offset-2 btn btn-danger mt-3">Затвори</button>
                                            </div>
                                            <div class="container overflow-hidden">
                                                <div class="row gy-5" id="pattern_visualizer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            get_status();
        });

        pattern_length = 0;
        pattern = [];

        function reset_pattern() {
            pattern = [];
            pattern_length = 0;
            $("#pattern_visualizer").html("");
        }

        function add_to_pattern(input) {
            if (++pattern_length > 8) {
                pattern_length = 8
                return;
            }
            if (input == 0) {
                temp_class = 'danger';
            } else if (input == 1) {
                temp_class = 'warning';
            } else if (input == 2) {
                temp_class = 'success';
            } else if (input == 3) {
                temp_class = 'primary';
            }
            pattern.push(input);
            $("#pattern_visualizer").append("<div style='margin-bottom: 5px;' class='col-3 btn btn-" + temp_class +
                "'>&nbsp;</div>")
        }

        function send_pattern() {
            if (pattern_length != 8) return;

            $.ajax({
                url: "{{ route('send_pattern') }}",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    data: pattern,
                },
                type: 'POST',
                dataType: "json",
                success: function(result) {}
            });
        }

        function get_status() {
            $.ajax({
                url: "{{ route('get_component_status') }}",
                cache: false,
                type: 'GET',
                success: function(result) {
                    result = JSON.parse(result);
                    for (const key in result) {
                        if (key == 'difficulty') {
                            if (result[key]) {
                                $("#difficulty_button_high").removeClass('btn-default').addClass('btn-danger')
                                    .prop("disabled", true);
                                $("#difficulty_button_low").removeClass('btn-success').addClass('btn-default')
                                    .prop("disabled", false);
                            } else {
                                $("#difficulty_button_high").removeClass('btn-danger').addClass('btn-default')
                                    .prop("disabled", false);
                                $("#difficulty_button_low").removeClass('btn-default').addClass('btn-success')
                                    .prop("disabled", true);
                            }
                        } else if (key == 'game_1' || key == 'game_2') {
                            if (result[key]) {
                                $("#" + key + "_card").removeClass('bg-danger').addClass('bg-success');
                            } else {
                                $("#" + key + "_card").removeClass('bg-success').addClass('bg-danger');
                            }
                        } else if (key == 'motor') {
                            if (result[key]) {
                                $("#" + key + "_go").removeClass("btn-success").addClass('btn-default')
                                    .prop("disabled", true);
                                $("#" + key + "_stop").removeClass("btn-default").addClass('btn-danger')
                                    .prop("disabled", false);
                            } else {
                                $("#" + key + "_go").removeClass("btn-default").addClass('btn-success')
                                    .prop("disabled", false);
                                $("#" + key + "_stop").removeClass("btn-danger").addClass('btn-default')
                                    .prop("disabled", true);
                            }
                        }else if (result[key]) {
                            $("#" + key + "_go").removeClass("btn-success").addClass('btn-default')
                                .prop("disabled", true);
                            $("#" + key + "_stop").removeClass("btn-default").addClass('btn-danger')
                                .prop("disabled", false);
                        } else {
                            $("#" + key + "_go").removeClass("btn-default").addClass('btn-success')
                                .prop("disabled", false);
                            $("#" + key + "_stop").removeClass("btn-danger").addClass('btn-default')
                                .prop("disabled", true);
                        }
                    }
                }
            });
            setTimeout(get_status, 500);
        }

        function activate_component(component_name) {
            $.ajax({
                url: "{{ route('activate_component') }}" + '/' + component_name,
                cache: false,
                type: 'GET',
                success: function(result) {

                }
            });
        }

        function reset(){
            $.ajax({
                url: "{{ route('reset') }}",
                cache: false,
                type: 'GET',
                success: function(result) {

                }
            });
            reset_pattern();
        }

        function deactivate_component(component_name) {
            $.ajax({
                url: "{{ route('deactivate_component') }}" + '/' + component_name,
                cache: false,
                type: 'GET',
                success: function(result) {

                }
            });
        }

        function set_difficulty(level) {
            $.ajax({
                url: "{{ route('set_difficulty') }}",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    level: level,
                },
                type: 'POST',
                dataType: "json",
                success: function(result) {}
            });
        }

        function send_password() {
            password = $("#password_input").val();
            if(password.length !=6){
                // return
            }

            $.ajax({
                url: "{{ route('send_password') }}",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    data: password,
                },
                type: 'POST',
                dataType: "json",
                success: function(result) {}
            });
        }

        function handle_password(){
            password = $("#password_input").val();
            password = password.replace(/\D/g,'');

            if(password.length > 6)
            password = password.substring(0, 6);

            $("#password_input").val(password);
        }
    </script>
</body>

</html>
