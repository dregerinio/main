<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                <span class="brand-text font-weight-light">Control Panel</span>
            </a>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Main control panel</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body text-center">
                                    <h5 class="card-title float-none mb-3">Component 1</h5>
                                    <p class="card-text">
                                        TBD
                                    </p>
                                    <button id="component_1_pusk" onclick="activate_component(1)" class="btn btn-success">ПУСК</button>
                                    <button id="component_1_stop" onclick="deactivate_component(1)" class="btn btn-danger">СТОП</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body text-center">
                                    <h5 class="card-title float-none mb-3">Component 2</h5>
                                    <p class="card-text">
                                        TBD
                                    </p>
                                    <button id="component_2_pusk" onclick="activate_component(2)" class="btn btn-success">ПУСК</button>
                                    <button id="component_2_stop" onclick="deactivate_component(2)" class="btn btn-danger">СТОП</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body text-center">
                                    <h5 class="card-title float-none mb-3">Component 3</h5>
                                    <p class="card-text">
                                        TBD
                                    </p>
                                    <button id="component_3_pusk" onclick="activate_component(3)" class="btn btn-success">ПУСК</button>
                                    <button id="component_3_stop" onclick="deactivate_component(3)" class="btn btn-danger">СТОП</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body text-center">
                                    <h5 class="card-title float-none mb-3">Component 4</h5>
                                    <p class="card-text">
                                        TBD
                                    </p>
                                    <button id="component_4_pusk" onclick="activate_component(4)" class="btn btn-success">ПУСК</button>
                                    <button id="component_4_stop" onclick="deactivate_component(4)" class="btn btn-danger">СТОП</button>
                                </div>
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
            init_components();
        });

        function init_components(){
            $.ajax({
                url: "{{ route('init_components') }}",
                cache: false,
                type: 'GET',
                success: function(result) {
                    get_status();
                }
            });
        }
        function get_status() {
            $.ajax({
                url: "{{ route('get_component_status') }}",
                cache: false,
                type: 'GET',
                success: function(result) {
                    result=JSON.parse(result);
                    console.log(result)
                    for (const key in result) {
                        if(result[key]){
                            $("#component_" + key +"_pusk").removeClass("btn-success").addClass('btn-default').prop("disabled", true);
                            $("#component_" + key +"_stop").removeClass("btn-default").addClass('btn-danger').prop("disabled", false);
                        } else {
                            $("#component_" + key +"_pusk").removeClass("btn-default").addClass('btn-success').prop("disabled", false);
                            $("#component_" + key +"_stop").removeClass("btn-danger").addClass('btn-default').prop("disabled", true);
                        }
                    }
                }
            });
            setTimeout(get_status,1000);
        }

        function activate_component(id){
            $.ajax({
                url: "{{ route("activate_component") }}" + '/' + id,
                cache: false,
                type: 'GET',
                success: function(result) {
                    
                }
            });
        }

        function deactivate_component(id){
            $.ajax({
                url: "{{ route("deactivate_component") }}" + '/' + id,
                cache: false,
                type: 'GET',
                success: function(result) {
                    
                }
            });
        }
    </script>
</body>

</html>
