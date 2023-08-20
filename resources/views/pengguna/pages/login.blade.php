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
                    <form id="contactUsForm" action="{{ route('CekLogin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Email</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" id="exampleFormControlSelect1" type="email"
                                placeholder="Masukkan Email Anda" required>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Password</label>
                            <input id="password" class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" name="password" id="exampleFormControlSelect1" type="password"
                                placeholder="Masukkan Password Anda" required>
                            <span class="text-danger" id="Errornomor_hp"></span>
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block btn-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection