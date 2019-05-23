@extends('template')
@section('content')
  <div class="layout-content">
    <div class="layout-content-body">
      <div class="row gutter-xs">
        <div class="col-xs-12">
          <div class="card">
            <div class="card-header">
              <strong>Rekapitulasi Kehadiran Karyawan</strong>
            </div>
            <div class="card-body">
              <div class="pull-right">
                <a href="{{ URL('kehadiran/cetak') }}" target="_blank" class="btn btn-info btn-sm"><i class="icon icon-file-pdf-o"></i> Export Data Kehadiran</a>
              </div>
              <div class="clearfix" style="margin-bottom: 10px"></div>
              <div class="table-responsive">
                <table id="demo-datatables" class="table table-striped table-hover table-nowrap dataTable" width="100%">
                  <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Lengkap</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alfa</th>
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
@stop
@push('scripts')
  <script type="text/javascript">
      var table;
      $(document).ready(function () {
          //	//datatables
          table = $('#demo-datatables').DataTable({
              processing: true,
              serverSide: true,
              responsive: true,
              aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
              order: [],

              ajax: {
                  "url": '{{ URL('kehadiran/json4') }}',
                  "type": "POST",
                  "headers": {
                      "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  },
              },

              columns: [
                  {data: 'DT_RowIndex'},
                  {data: 'nama'},
                  {data: 'hadir'},
                  {data: 'izin'},
                  {data: 'sakit'},
                  {data: 'alfa'},
              ],

              columnDefs: [
                  {
                      targets: [-1, 0, 2, 3, 4], //first column / numbering column
                      orderable: false, //set not orderable
                  },
              ],
          });
      });
  </script>
@endpush
