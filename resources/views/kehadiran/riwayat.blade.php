@extends('template')
@section('content')
  <div class="layout-content">
    <div class="layout-content-body">
      <div class="row gutter-xs">
        <div class="col-xs-12">
          <div class="card">
            <div class="card-header">
              <strong>Riwayat Karyawan</strong>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="demo-datatables" class="table table-striped table-hover table-nowrap dataTable" width="100%">
                  <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Lengkap</th>
                    <th>Status Karyawan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="infoModalColoredHeader1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title-update">Riwayat Kehadiran Karyawan</h4>
        </div>
        <form class="form" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-5 col-md-5">
                <div class="table-responsive">
                  <table class="table table-stripped">
                    <tr>
                      <td>Nama Lengkap</td>
                      <td>: <span id="nama"></span></td>
                    </tr>
                    <tr>
                      <td>Hadir</td>
                      <td>: <span id="hadir"></span></td>
                    </tr>
                    <tr>
                      <td>Izin</td>
                      <td>: <span id="izin"></span></td>
                    </tr>
                    <tr>
                      <td>Sakit</td>
                      <td>: <span id="sakit"></span></td>
                    </tr>
                    <tr>
                      <td>Tanpa Keterangan</td>
                      <td>: <span id="tpktr"></span></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-lg-7 col-md-7 chart">
                <canvas id="staffChart"></canvas>
              </div>
              <div class="col-lg-12 col-md-12">
                <table class="table table-striped table-responsive" id="table_latest_history">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal Kehadiran</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
@push('scripts')
  <script type="text/javascript">
      var table;
      $(document).ready(function () {
          var styles = {
              nama: function (row, type, data) {
                  return data.nama;
              },

              status: function (row, type, data) {
                  if (data.status == 0) {
                      return '<span class="label label-danger">Tidak Aktif</span>';
                  } else {
                      return '<span class="label label-success">Aktif</span>';
                  }
              },

              button: function (row, type, data) {
                  return `<a href="#" class="btn btn-info btn-sm btn-view" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-eye"></i></a>`;
              }
          };

          //	//datatables
          table = $('#demo-datatables').DataTable({
              processing: true,
              serverSide: true,
              responsive: true,
              aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
              order: [],

              ajax: {
                  "url": '{{ URL('kehadiran/json1') }}',
                  "type": "POST",
                  "headers": {
                      "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  },
              },

              columns: [
                  {data: 'DT_RowIndex'},
                  {data: 'nama', render: styles.nama},
                  {data: 'status', render: styles.status},
                  {data: 'action', render: styles.button},
              ],

              columnDefs: [
                  {
                      targets: [-1, 0, 2], //first column / numbering column
                      orderable: false, //set not orderable
                  },
              ],
          });

          table.on('click', '.btn-view', function (e) {
              e.preventDefault();
              var id = $(this).attr('id');
              var sData = "id=" + id;
              $('#staffChart').remove();
              $('.chart').append('<canvas id="staffChart"></canvas>');
              $.ajax({
                  headers: {
                      "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  },
                  url: "{{ URL('kehadiran/getKaryawan') }}",
                  type: "GET",
                  data: sData,
                  dataType: 'json',
                  success: function (data) {
                      $("#nama").html(data.list.nama);
                      $("#hadir").html(data.list.hadir);
                      $("#izin").html(data.list.izin);
                      $("#sakit").html(data.list.sakit);
                      $("#tpktr").html(data.list.alfa);
                      getKaryawan(data.list.id);

                      var presenceChart = $('#staffChart');
                      Chart.defaults.scale.ticks.beginAtZero = true;
                      let staffChart = new Chart(presenceChart, {
                          responsive: true,
                          bDestroy: true,
                          type: 'doughnut',
                          data: {
                              labels: [
                                  "Hadir",
                                  "Izin",
                                  "Sakit",
                                  "Tanpa Keterangan"
                              ],
                              datasets: [
                                  {
                                      data: [
                                          data.list.hadir,
                                          data.list.izin,
                                          data.list.sakit,
                                          data.list.alfa
                                      ],
                                      backgroundColor: [
                                          'rgba(46, 204, 113, 1)',
                                          'rgba(25, 181, 254, 1)',
                                          'rgba(254, 241, 96, 1)',
                                          'rgba(242, 38, 19, 1)'
                                      ],
                                      borderColor: [
                                          'rgba(46, 204, 113, 1)',
                                          'rgba(25, 181, 254, 1)',
                                          'rgba(254, 241, 96, 1)',
                                          'rgba(242, 38, 19, 1)'
                                      ],
                                      borderWidth: 0.5
                                  }]
                          },
                          options: {
                              cutoutPercentage: 40,
                              animation: {
                                  animateScale: true
                              }
                          }
                      });

                      staffChart.update();
                  },
                  error: function (xhr) {
                      alert(xhr);
                  }
              });
          });
      });

      function getKaryawan(id) {
          //	//datatables
          table = $('#table_latest_history').DataTable({
              processing: true,
              serverSide: true,
              responsive: true,
              destroy: true,
              aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
              order: [],

              ajax: {
                  "url": '{{ URL('kehadiran/json3') }}' + '/' + id,
                  "type": "POST",
                  "headers": {
                      "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  },
              },

              columns: [
                  {data: 'DT_RowIndex'},
                  {data: 'tanggal'},
                  {data: 'status'},
              ],

              columnDefs: [
                  {
                      targets: [-1, 0], //first column / numbering column
                      orderable: false, //set not orderable
                  },
              ],
          });
      }
  </script>
@endpush
