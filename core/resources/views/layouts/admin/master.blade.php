<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') </title>
    <!--

    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.min.css')}}">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/fullcalendar.min.css')}}">
    <!-- https://fullcalendar.io/ -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/tooplate.css')}}">
</head>

<body id="reportsPage">
    <div class="" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12 ">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show mx-auto h-25" role="alert">
                        {{ session('status') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </div>
                    @endif
                    <nav class="navbar navbar-expand-xl navbar-light bg-light ">
                        <a class="navbar-brand" href="">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                            <h1 class="tm-site-title mb-0">Dashboard</h1>
                        </a>
                        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('admin.dashboard')}}">Dashboard
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('all.transaction')}}">All Transaction Logs</a>
                                        <a class="dropdown-item" href="{{route('admin.all.referral')}}">All referral Logs</a>
                                        {{-- <a class="dropdown-item" href="#">Log</a>
                                        <a class="dropdown-item" href="#">Yearly Report</a> --}}
                                    </div>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.user.list')}}">Manage Users</a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="accounts.html">Accounts</a>
                                </li> --}}
                                <li class="nav-item ">
                                    <a class="nav-link " href="{{route('admin.settings')}}">
                                        Settings
                                    </a>
                                    {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Site Name</a>
                                        <a class="dropdown-item" href="#">Join Bonus</a>
                                        <a class="dropdown-item" href="#">Fixed Charge (transaction)</a>
                                        <a class="dropdown-item" href="#">Percentage Charge (transaction)</a>
                                    </div> --}}
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                <form action="{{route('admin.logout')}}" method="POST">
                                    @csrf
                                        <button class="btn btn-danger d-flex" type="submit">
                                            <i class="far fa-user mr-2 tm-logout-icon"></i>
                                            <span>Logout</span>
                                        </button>
                                </form>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!--content-->
            <div class="row tm-content-row tm-mt-big">
                @yield('content')
            </div>

            <footer class="row tm-mt-small">
                <div class="col-12 font-weight-light">
                    <p class="d-inline-block tm-bg-black text-white py-2 px-4">
                       
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('assets/admin')}}/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="{{asset('assets/admin')}}/js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="{{asset('assets/admin')}}/js/utils.js"></script>
    <script src="{{asset('assets/admin')}}/js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="{{asset('assets/admin')}}/js/fullcalendar.min.js"></script>
    <!-- https://fullcalendar.io/ -->
    <!-- https://getbootstrap.com/ -->
    <script src="{{asset('assets/admin')}}/js/tooplate-scripts.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="{{asset('assets/admin')}}/js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function () {
            $('.tm-product-name').on('click', function () {
                window.location.href = "edit-product.html";
            });
        })
    </script>
  
    <script>
        let ctxLine,
            ctxBar, 
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            updateChartOptions();
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart
            drawCalendar(); // Calendar

            $(window).resize(function () {
                updateChartOptions();
                updateLineChart();
                updateBarChart();
                reloadPage();
            });
        })
    </script>
    @include('alert.error')
    @include('alert.errors')
    @include('alert.success')
</body>
</html>