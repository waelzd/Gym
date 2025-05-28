@extends('pages.app')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-2" style="font-weight: bold;">Subscribers Chart Reports</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Donut Chart Column -->
      <div class="col-md-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Subscribers Status</h3>
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
            <canvas id="donutChart" style="min-height: 250px; height: 250px;"></canvas>
          </div>
        </div>
      </div>

      <!-- Pie Chart Column -->
      <div class="col-md-6">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Subscribers Genders</h3>
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
            <canvas id="pieChart" style="min-height: 250px; height: 250px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>

<script>
  const donutChartCanvas = document.getElementById('donutChart').getContext('2d');
  const pieChartCanvas = document.getElementById('pieChart').getContext('2d');

  // Donut chart for Paid vs Unpaid
  const donutData = {
    labels: ['Paid', 'Unpaid'],
    datasets: [{
      data: [{{ $paidCount }}, {{ $unpaidCount }}],
      backgroundColor: ['rgba(40, 167, 69, 0.8)', 'rgba(220, 53, 69, 0.8)'],
      borderColor: ['rgba(40, 167, 69, 1)', 'rgba(220, 53, 69, 1)'],
      borderWidth: 1
    }]
  };

  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: {
      maintainAspectRatio: false,
      responsive: true
    }
  });

  // Pie chart for Gender
  const pieData = {
    labels: ['Male', 'Female'],
    datasets: [{
      data: [{{ $maleCount }}, {{ $femaleCount }}],
      backgroundColor: ['rgba(0, 123, 255, 0.8)', 'rgba(255, 99, 132, 0.8)'],
      borderColor: ['rgba(0, 123, 255, 1)', 'rgba(255, 99, 132, 1)'],
      borderWidth: 1
    }]
  };

  new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        tooltip: {
          callbacks: {
            label: function (context) {
              let total = context.dataset.data.reduce((a, b) => a + b, 0);
              let value = context.raw;
              let percentage = ((value / total) * 100).toFixed(2) + '%';
              return `${context.label}: ${value} (${percentage})`;
            }
          }
        }
      }
    }
  });
</script>





@endsection
