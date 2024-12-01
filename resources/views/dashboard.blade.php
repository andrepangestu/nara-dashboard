<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>

<body class="hold-transition layout-navbar-fixed layout-top-nav dashboard-layout">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-layout ">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
          <img src="{{ asset('images/nara-logo.png') }}" alt="Nara Logo" class="mr-3 logo-navbar">
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <h1 class="text-white">Dashboard {{ $user->company_name }}</h1>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto mr-2">
        <li class="nav-item dropdown mr-2">
          <div class="input-group date" id="reservationdate" data-target-input="nearest"
            style="border-radius: 50%; background-color: #f8f9fa; width: 40px; height: 40px;">
            <input hidden type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
              <div class="input-group-text" style="border-radius: 50%;"><i class="fa fa-calendar"
                  style="color: #082259;"></i></div>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#"
            style="border-radius: 50%; background-color: #f8f9fa; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="far fa-user" style="color: #082259;"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">

              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper dashboard-layout">
      <!-- Content Header (Page header) -->
      <section class="content-header"></section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <x-amount-waste-card />
            </div>

            <div class="col-lg-3">
              <x-type-waste-card />
            </div>

            <div class="col-lg-3">
              <x-conversion-card class="w-100" />
            </div>
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-lg-6">
              <x-type-anorganic-waste-card />
            </div>

            <div class="col-lg-2">
              <x-type-organic-waste-card />
            </div>

            <div class="col-lg-4">
              <x-summary-card />
            </div>
          </div>
          <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
</body>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Chart.js -->
<script src="packages/chartjs/dist/chart.umd.js"></script>
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>
<script src="{{ asset('js/amount-waste-chart.js') }}"></script>
<script src="{{ asset('js/type-waste-chart.js') }}"></script>
<script src="{{ asset('js/type-anorganic-waste-chart.js') }}"></script>
<script src="{{ asset('js/type-organic-waste-chart.js') }}"></script>

<script
  src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
</script>


<script>
$(function() {

  $('#reservationdate').datetimepicker({
    format: 'L',
    maxDate: new Date()
  });

  $('#reservationdate').on('change.datetimepicker', function(e) {
    var selectedDate = e.date.format('YYYY-MM-DD');
    console.log('Selected date:', selectedDate);

    getDataAnorganic(selectedDate, selectedDate).then((data) => {
      loadAnorganicChart(data);
    }).catch((error) => {
      console.error('Error fetching data from SheetDB:', error);
    });

    getDataOrganic(selectedDate, selectedDate).then((data) => {
      loadOrganicChart(data);
    }).catch((error) => {
      console.error('Error fetching data from SheetDB:', error);
    });

    getDataTypeWaste(selectedDate, selectedDate).then((data) => {
      loadTypeWasteChart(data);
    }).catch((error) => {
      console.error('Error fetching data from SheetDB:', error);
    });
    // You can now send the selected date to the server or use it as needed
  });
});
</script>

</html>