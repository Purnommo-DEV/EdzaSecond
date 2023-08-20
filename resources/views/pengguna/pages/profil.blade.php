@extends('pengguna/layouts/Home')
@section('name')
Login
@endsection

@section ('content')

<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                          <div class="container-fluid">
                            <div class="row mb-2">
                              <div class="col-sm-6">
                                <br>
                                <h1></h1>
                              </div>
                              <div class="col-sm-6">
                              </div>
                            </div>
                          </div><!-- /.container-fluid -->
                        </section>
                    
                        <!-- Main content -->
                        <section class="content">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-md-3">
                    
                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                  <div class="card-body box-profile">
                                    {{-- <div class="text-center">
                                      <img class="profile-user-img img-fluid img-circle"
                                           src="../../dist/img/user4-128x128.jpg"
                                           alt="User profile picture">
                                    </div> --}}
                    
                                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                    
                                    <p class="text-muted text-center">{{Auth::user()->peran}}</p>
                    
                                    <ul class="list-group list-group-unbordered mb-3">
                                      <li class="list-group-item">
                                        <b>Alamat</b> <a class="float-right">{{Auth::user()->alamat}}</a>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Kota</b> <a class="float-right">{{Auth::user()->kota->nama}}</a>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Provinsi</b> <a class="float-right">{{Auth::user()->provinsi->nama}}</a>
                                      </li>
                                    </ul>
                    
                                    <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                    
                                <!-- About Me Box -->
                                <!-- /.card -->
                              </div>
                              <!-- /.col -->
                              <div class="col-md-9">
                                <div class="card">
                                  <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                      <li class="nav-item"><a class="nav-link active" href="#pesanan" data-toggle="tab">Pesanan</a></li>
                                      <li class="nav-item"><a class="nav-link" href="#terkirim" data-toggle="tab">Terkirim</a></li>
                                      <li class="nav-item"><a class="nav-link" href="#selesai" data-toggle="tab">Selesai</a></li>
                                    </ul>
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
                                    <div class="tab-content">

                                   @include('pengguna.pages.pesanan.pesanan')
                                   @include('pengguna.pages.pesanan.terkirim')
                                   @include('pengguna.pages.pesanan.selesai')
                                      <!-- /.tab-pane -->
                                     
                                      <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                  </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                          </div><!-- /.container-fluid -->
                        </section>
                        <!-- /.content -->
                      </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        //active select2
        $(".provinsi, .kota").select2({
            theme:'bootstrap4',dropdownCssClass: "bigdrop",
        });
        //ajax select kota asal
        $('select[name="provinsi_id"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/kota/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="kota_id"]').empty();
                        $('select[name="kota_id"]').append('<option value="">-- Pilih Kota --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="kota_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="kota_id"]').append('<option value="">-- Pilih Kota --</option>');
            }
        });
    });
</script>
@endsection