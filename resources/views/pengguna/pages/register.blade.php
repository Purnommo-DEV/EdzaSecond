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
                    <br>
                    <br>
                    <br>
                    <form action="{{ route('TambahUser') }}" method="POST" id="contactUsForm">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nama</label>
                            <input id="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" id="exampleFormControlSelect1" type="text"
                                placeholder="Masukkan Nama Anda" required>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Email</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" id="exampleFormControlSelect1" type="email"
                                placeholder="Masukkan Email Anda" required>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Password</label>
                            <input id="password" class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" name="password" id="exampleFormControlSelect1" type="password"
                                placeholder="Masukkan Password Anda" required>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br> 
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nomor Hp</label>
                            <input id="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
                                value="{{ old('password') }}" name="nomor_hp" id="exampleFormControlSelect1" type="number"
                                placeholder="Masukkan Nomor Hp Anda" required>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Alamat</label>
                            <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}" name="alamat" id="exampleFormControlSelect1" type="text"
                                placeholder="Masukkan Nama Anda" required></textarea>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="font-weight-bold">Provinsi</label>
                            <br>
                            <select class="form-control provinsi" name="provinsi_id" aria-hidden="true">
                                <option value="0" required>-- Pilih Provinsi --</option>
                                @foreach ($provinsi as $provinsis => $value)
                                <option value="{{ $provinsis  }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="font-weight-bold">Kota</label>
                            <br>
                            <select class="form-control kota" name="kota_id" aria-hidden="true">
                                <option value="" required>-- Pilih Kota --</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block btn-submit">Submit</button>
                    </form>
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