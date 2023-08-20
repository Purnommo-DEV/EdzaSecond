 @extends('pengguna/layouts/Home')
 @section('name')
 Checkout
 @endsection

 @section ('content')


 <!-- Start Banner Area -->
 <section class="banner-area organic-breadcrumb">
     <div class="container">
         <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
             <div class="col-first">
                 <h1>Checkout</h1>
                 <nav class="d-flex align-items-center">
                     <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                     <a href="single-product.html">Checkout</a>
                 </nav>
             </div>
         </div>
     </div>
 </section>
 <!-- End Banner Area -->
 <form action="{{route('Pembayaran')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Produk Pesanan</h3>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <p>{{ $keranjangs->kuantitas}}</p>
                                        </td>
                                        <td>
                                            <p>@currency($keranjangs->produk->harga)</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h3>Alamat</h3>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Alamat Pengirim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Auth::user()->alamat }}, {{ Auth::user()->kota->nama }}, {{ Auth::user()->provinsi->nama }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                            {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Alamat Pengirim</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <label>Alamat Pengitim</label>
                                                <input class="form-control" type="text" placeholder="Default input">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @php
                                    $sub_total = 0;
                                    $total_semua = 0;
                                @endphp
                                @foreach ($keranjang as $keranjangs)
                                <li><a href="#">{{ $keranjangs->produk->namaproduk }}<span class="middle">x {{ $keranjangs->kuantitas }}</span> 
                                    <span class="last">@currency($keranjangs->produk->harga)</span></a>
                                </li>
                                @php
                                    $sub_total = $sub_total + ($keranjangs->produk->harga * $keranjangs->kuantitas);
                                    $total_semua += $keranjangs->kuantitas * $keranjangs->produk->harga;
                                @endphp
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Total <span id="tampilTotal">@currency($total_semua)</span></a></li>
                            </ul>

                            <ul class="list list_2">
                                <li><a href="#">Pilih Jasa Pengiriman</a></li>
                            </ul>

                            <div class="row">
                                <div class="checkbox" style="padding: 0px 50px;">
                                    @foreach ($cek_ongkir as $result)
                                    <input class="form-check-input" type="radio"
                                        id="jasaKirim{{ $result['service'] }}"
                                        value="{{ $result['cost'][0]['value'] }}" name="ongkos_kirim" required>
                                    <label for="jasaKirim{{ $result['service'] }}" style="position: inherit;">
                                        {{ $result['service'] }} - @currency($result['cost'][0]['value']) -
                                        {{ $result['cost'][0]['etd'] }} Hari
                                    </label>
                                    <br>
                                    @endforeach
                                </div>
                            </div>

                            <ul class="list list_2">
                                <li><a href="#">Rekening Transfer</a></li>
                            </ul>
                            <div class="row">
                                <div class="checkbox" style="padding: 0px 20px;">
                                    @foreach ($metodes as $metodes)
                                    <label>
                                        {{$metodes->namapemilik}} - {{$metodes->namametode}} - {{$metodes->norekening}}
                                    </label>
                                    @endforeach
                            </div>
                        </div>

                            <ul class="list list_2">
                                <li><a href="#">Unggah Bukti Pembayaran</a></li>
                            </ul>
                            
                            <div class="row">
                                <div class="checkbox" style="padding: 0px 20px;">
                                    
                                <input type="file" name="bukti_bayar" class="form-control-file" id="exampleFormControlFile1" accept="image/*">
                                <input type="checkbox" id="f-option4" name="selector" required>
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            </div>
                            <button type="submit" class="primary-btn">Pesan</button>
                            </div>

                      
                        </div>
                    </div>
                </div>
            </div>
    </section>
</form>
 @endsection
 @section('script')
 <script>
     $(document).on('change', 'input[type=radio][name=ongkos_kirim]', function (event) {
 
         ongkir = $(this).attr('value');
         pengiriman = $(this).attr('id');
 
         var subtotal = "{{ $sub_total }}"
         var total = parseInt(ongkir) + parseInt(subtotal);
         $('#totalBayar').attr("value", total);
         $('#jasaPengiriman').attr("value", pengiriman);
 
         var reverse = total.toString().split('').reverse().join(''),
             ribuan = reverse.match(/\d{1,3}/g);
         total_dalam_rupiah = ribuan.join('.').split('').reverse().join('');
         $('#tampilTotal').text('Rp ' + total_dalam_rupiah);
 
     });
     $(function () {
         $(".formTransfer").hide();
         $("#metode_pembayaran").on("click", function () {
             $(".formTransfer").toggle(this.checked);
         });
     });
 
 </script>
 @endsection