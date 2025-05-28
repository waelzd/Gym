@extends('pages.app')

@section('content')

<style>
  .icon {
    font-size: 60px;
    color: white;
    margin-top: 10px;
    margin-left: 10px;
  }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-2" style="font-weight: bold;">Dashboard</h1>
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="bi bi-people-fill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Subscribers</span>
                <span class="info-box-number">{{ $totalSubscribers }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="bi bi-person-fill-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Paid Subscribers</span>
                <span class="info-box-number">{{ $paidSubscribers }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="bi bi-person-fill-x"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Unpaid Subscribers</span>
                <span class="info-box-number">{{ $unpaidSubscribers }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="bi bi-currency-dollar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Monthly Revenue</span>
                <span class="info-box-number">${{ number_format($monthlyRevenue) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->
        <!-- /.row -->
        <!-- Main row -->

            <!-- BAR CHART -->
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title">Subscriber Trends</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>


<script>

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function () {
    var barChartCanvas = $('#barChart').get(0).getContext('2d');

    var barChartData = {
        labels  : @json($months),
        datasets: [
    {
      label               : 'Paid Subscribers',
      backgroundColor     : 'rgba(40, 167, 69, 0.8)',
      borderColor         : 'rgba(40, 167, 69, 1)',
      borderWidth         : 1,
      data                : @json($paidData)
    },
    {
      label               : 'Unpaid Subscribers',
      backgroundColor     : 'rgba(220, 53, 69, 0.8)',
      borderColor         : 'rgba(220, 53, 69, 1)',
      borderWidth         : 1,
      data                : @json($unpaidData)
    }
  ]
};


    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            precision: 0
          }
        }]
      }
    };

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    });
  });
</script>


@endsection