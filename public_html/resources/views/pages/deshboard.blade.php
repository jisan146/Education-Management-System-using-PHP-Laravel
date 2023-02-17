<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
 
  <title>Dashboard</title> 

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('/')}}/assets/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/assets/dashboard/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
 
<div class="wrapper">
  <!-- Navbar --> 
  


  <!-- Content Wrapper. Contains page content -->
  <div >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <h1 class="m-0 text-dark"><a href="{{url('/home')}}">Dashboard</a></h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><a href="{{url('/')}}">এখানে ক্লিক করলে সফটওয়্যার এ প্রবেশ করবে -->>></a></h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><h1 class="m-0 text-dark"><a href="{{url('/')}}">Portal</a></h1></li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-2">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Collection</span>
                <span class="info-box-number">
                 {{$todayCash}}
                  <small>TK</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-2">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Student</span>
                <span class="info-box-number">{{$activeStudent}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-2">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Employee</span>
                <span class="info-box-number">{{$activeStuff}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-2">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-mortar-pestle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Breakfast</span>
                <span class="info-box-number">{{$b}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-2">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-mortar-pestle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Lunch </span>
                <span class="info-box-number">{{$d}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-2">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-mortar-pestle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Dinner</span>
                <span class="info-box-number">{{$l}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
 <!-- Pie Chart -->
         <div class="row">
          <div class="col-md-4">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Today's Spend</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">This Month's Spend</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">This Year's Spend</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>


<div class="row">
          <!-- Left col -->
          <div class="col-md-6" style="overflow: scroll;height: 350px;">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Employee Colletion</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>TK</th>
                      
                      
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($coll as $element)
                        {{-- expr --}}
                      
                    <tr>
                      
                      <td>{{$element->name}}</td>
                      <td>{{$element->tk}}</td>
                      
                      
                        
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>


              <!-- /.card-body -->
             
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          
          <!-- /.col -->
        
          <!-- Left col -->
          <div class="col-md-6" style="overflow: scroll;height: 350px;">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Employee Spend</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>TK</th>
                      
                      
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($colls as $element)
                        {{-- expr --}}
                      
                    <tr>
                      <td>{{$element->name}}</td>
                      <td>{{$element->tk}}</td>
                     
                      
                        
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>

              
              <!-- /.card-body -->
             
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Today's Attendance Student</h5>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  
                  <!-- /.col -->
                  <div class="col-md-12" style="overflow: scroll;height: 350px;">
                  

                    @foreach ($att as $key)
                      {{-- expr --}}
                    
                    <div class="progress-group">
                      {{$key->class}}
                      <span class="float-right"><b>{{$key->total}}</b>/{{$key->total_att}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{$key->pers}}%"></div>
                      </div>
                    </div>

                    @endforeach
                    
                   

                   
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Today's Attendance Employee</h5>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  
                  <!-- /.col -->
                  <div class="col-md-12" style="overflow: scroll;height: 350px;">
                  

                    @foreach ($atts as $key)
                      {{-- expr --}}
                    
                    <div class="progress-group">
                      {{$key->designation}}
                      <span class="float-right"><b>{{$key->total}}</b>/{{$key->total_att}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{$key->pers}}%"></div>
                      </div>
                    </div>

                    @endforeach
                    
                   

                   
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>

         



          <!-- /.col -->
        </div>
        <!-- /.row -->



        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-6" style="overflow: scroll;height: 350px;">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Absense Student List</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Phone</th>
                      <th>Name</th>
                      <th>Father Name</th>
                      <th>Class</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($abs as $element)
                        {{-- expr --}}
                      
                    <tr>
                      <td>{{$element->sl}}</td>
                      <td>{{$element->phone_sms}}</td>
                      <td>{{$element->name}}</td>
                      <td>{{$element->father_name}}</td>
                      <td>{{$element->class}}</td>
                      
                        
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>


              <!-- /.card-body -->
             
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          
          <!-- /.col -->
        
          <!-- Left col -->
          <div class="col-md-6" style="overflow: scroll;height: 350px;">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Absense Employee List</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Phone</th>
                      <th>Name</th>
                      <th>Father Name</th>
                      <th>Designation</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($abss as $element)
                        {{-- expr --}}
                      
                    <tr>
                      <td>{{$element->sl}}</td>
                      <td>{{$element->phone_sms}}</td>
                      <td>{{$element->name}}</td>
                      <td>{{$element->father_name}}</td>
                      <td>{{$element->designation}}</td>
                      
                        
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>

              
              <!-- /.card-body -->
             
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          
          <!-- /.col -->
        </div>
        
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>-->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{url('/')}}/assets/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{url('/')}}/assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/assets/dashboard/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{url('/')}}/assets/dashboard/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{url('/')}}/assets/dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{url('/')}}/assets/dashboard/plugins/raphael/raphael.min.js"></script>
<script src="{{url('/')}}/assets/dashboard/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{url('/')}}/assets/dashboard/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{url('/')}}/assets/dashboard/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="{{url('/')}}/assets/dashboard/dist/js/pages/dashboard2.js"></script>
 <script>
  $(function () {

   
    var donutData1        = {
      labels: [
       @foreach ($stt as $stt1)
          '{{$stt1->des}}', 
      @endforeach 
      ],
      datasets: [
        {
          data: [@foreach ($stt as $stt1)
          {{$stt1->tk}}, 
      @endforeach],
          backgroundColor : [@foreach ($stt as $stt1)
          @php
          {{echo "'#".rand(111111,615429)."'";}}
          @endphp, 
      @endforeach],
        }
      ]
    }

        var donutData2        = {
      labels: [
       @foreach ($stm as $stm2)
          '{{$stm2->des}}', 
      @endforeach 
      ],
      datasets: [
        {
          data: [@foreach ($stm as $stm2)
          {{$stm2->tk}}, 
      @endforeach],
          backgroundColor : [@foreach ($stm as $stm2)
          @php
          {{echo "'#".rand(111111,615429)."'";}}
          @endphp, 
      @endforeach],
        }
      ]
    }

       var donutData3        = {
      labels: [
       @foreach ($sty as $sty3)
          '{{$sty3->des}}', 
      @endforeach 
      ],
      datasets: [
        {
          data: [@foreach ($sty as $sty3)
          {{$sty3->tk}}, 
      @endforeach],
          backgroundColor : [@foreach ($sty as $sty3)
          @php
          {{echo "'#".rand(111111,615429)."'";}}
          @endphp, 
      @endforeach],
        }
      ]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.


    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
    var pieData        = donutData1;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

    ////////////////////


        var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
    var pieData        = donutData2;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

/////////////////
            var pieChartCanvas = $('#pieChart3').get(0).getContext('2d')
    var pieData        = donutData3;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })



  })
</script>

</body>
</html>
