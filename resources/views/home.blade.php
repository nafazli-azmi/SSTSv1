@extends('layouts.admin')

<title>Student Supervision Tracking System</title>

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>111</h3>

                <p>Ongoing Projects</p>
              </div>
              <div class="icon">
              <i class="fas fa-project-diagram"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>70</h3>

                <p>Lecturers</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-user-secret"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>213</h3>

                <p>Active Students</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-user-tie"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>111</h3>

                <p>Completed Projects</p>
              </div>
              <div class="icon">
              <i class="fas fa-file-archive"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

            <div class="card">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Project By Categories
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- chart here -->
                  <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="sales-chart-canvas" style="height: 300px; display: block; width: 816px;" class="chartjs-render-monitor" width="816" height="300"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
    </section>
    <!-- /.content -->
  </div>
  </body>
  <!-- /.content-wrapper -->
@endsection
