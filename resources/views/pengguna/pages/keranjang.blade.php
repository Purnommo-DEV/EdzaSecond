@extends('pengguna/layouts/Home')
@section('name')
Keranjang
@endsection

@section ('content')

<!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sub_total = 0;
                                $total_semua = 0;
                            @endphp
                            @foreach ($keranjang as $keranjangs)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{asset('inputan/produk/img/')}}/{{$keranjangs->produk->gambarproduk1}}" alt="" width="100">
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $keranjangs->produk->namaproduk }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>@currency($keranjangs->produk->harga)</h5>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <p>{{ $keranjangs->kuantitas }}</p>
                                    </div>  
                                    {{-- <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                            class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div> --}}
                                </td>
                                @php
                                    $sub_total = $keranjangs->kuantitas * $keranjangs->produk->harga;
                                    $total_semua += $keranjangs->kuantitas * $keranjangs->produk->harga;
                                @endphp
                                <td>
                                    <h5>@currency($sub_total)</h5>
                                </td>
                                <td>
                                    <a href="#" keranjang-id="{{$keranjangs->id}}" class="btn btn-danger hapusDataKeranjang" data-original-title="Hapus">
                                        <i class="fa fa-times">Hapus</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5>@currency($total_semua)</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    
                </div>
              

                </div>
                <div class="checkout_btn_inner d-flex align-items-center mt-5">
                    <a class="gray_btn" href="#">Continue Shopping</a>
                    <a class="primary-btn" href="{{ route('Checkout') }}">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
@section('script')
    <script>
    //Jika ada class yang bernama delete lalu di klik maka jalankan function() dan tampilkan alert(1) atau pesan
    $('.hapusDataKeranjang').click(function(){
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var keranjang_id = $(this).attr('keranjang-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapusDataKeranjang/"+keranjang_id;
                }
            });
        });
    </script>
@endsection