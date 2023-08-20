<div class="tab-pane" id="terkirim">
    <!-- Post -->
    @php
        $total = 0; 
    @endphp
    @foreach($pesanan as $pesanans)
    @if ($pesanans->status_pesanan === "Terkirim")
    <div class="accordion accordion-icon" id="accordion-3">
        <div class="card">
            <button type="button" class="btn btn-block btn-danger btn-xs" data-toggle="modal"
            data-target="#konfirmasiTerima-{{ $pesanans->id }}">Konfirmasi Pesanan Di Terima</button>
        <form action="{{ route('KonfirmasiTerimaPesanan') }}" method="POST">
            @csrf
            <div class="modal fade" id="konfirmasiTerima-{{ $pesanans->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h3 class="product-title" style="padding: 2% 5% 2% 5%; justify-content: center;display: flex;font-size: large;"><b>Konfirmasi Terima Pesanan ?</b></h3>
                                <h3 class="product-title" style="padding: 2% 5% 2% 5%;justify-content: center;display: flex;">Note : Pastikan Periksa Pesanan Anda Terlebih Dahulu</h3>
                            <input type="hidden" name="id" value="{{ $pesanans->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
                <a role="button" data-toggle="collapse" href="#tampil-{{ $pesanans->id }}" aria-expanded="true" aria-controls="collapse3-1" 
                    style="font-size: initial;">         
                <div class="card-header">
                    Kode Pemesanan : {{ $pesanans->id }} 
                </div>
                <div class="card-body">
                <h6 class="card-title">Status : {{ $pesanans->status_pesanan }}</h6>
                <p class="card-text">Pesanan di buat : {{ $pesanans->created_at->diffForHumans() }} ({{ $pesanans->created_at->toFormattedDateString()}})</p>
                </div>
            </a>
            </div>
            <div><h3 class="card-title">  </h3></div>
            <div id="tampil-{{ $pesanans->id }}" class="collapse" aria-labelledby="heading3-1" data-parent="#accordion-3">
                <div class="entry-item lifestyle shopping col-sm-12">
                    <div class="entry-body">
                        <table class="table table-striped table-bordered text-center">
                            <tr>
                                <td colspan="2"><strong>Pesanan Detail</strong>
                            </tr>
                            <tr>
                                <td>Pesanan</td>
                                <td>Tanggal : {{$pesanans->created_at}}<br>Status Pesanan : {{ $pesanans->status_pesanan }}</td>
                            </tr>
                            <tr>
                                <td>Nama Penerima</td>
                                <td>{{$pesanans->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{$pesanans->user->alamat}}, {{$pesanans->user->kota->nama}}, {{$pesanans->user->provinsi->nama}},
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$pesanans->user->email}}</td>
                            </tr>
                            <tr>
                                <td>Nomor Hp</td>
                                <td>{{$pesanans->user->nomor_hp}}</td>
                            </tr>
                            <tr>
                                @php
                                    $total = $pesanans->total_bayar+$pesanans->ongkos_kirim
                                @endphp
                                <td>Total Pemesanan</td>
                                <td>@currency($total) (Note : Sudah Termasuk Ongkos Kirm & Tidak Termasuk Biaya
                                    Transfer Admin)</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>{{$pesanans->metode_pembayaran}}</td>
                            </tr>
                            <tr>
                                <td>Berat Pesanan</td>
                                <td>{{$pesanans->total_berat}}(g)</td>
                            </tr>
                        </table>
                    </div>
                </div><!-- End .entry-item -->
    
                <div class="entry-item lifestyle shopping col-sm-12">
                    <div class="entry-body">
                        @foreach ($buktiTransfer as $buktiTransfers)
                        @if($pesanans->id == $buktiTransfers->pesanan_id)
                        <table class="table table-striped table-bordered text-center">
                            <tr>
                                <td colspan="2"><strong>Bukti Pembayaran</strong>
                            </tr>
                            <tr>
                                <td>Pengirim</td>
                                <td>{{$buktiTransfers->pesanan->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Bukti Transfer</td>
                                <td style="width: min-content;">
                                    <img src="{{ asset('inputan/buktiBayar') }}/{{ $buktiTransfers->bukti_bayar }}" alt="" width="150"></td>
                            </tr>
                            <tr>
                                <td>Status Verifikasi</td>
                                <td>
                                    @if ($buktiTransfers->status_verifikasi == 0)
                                    <button type="button"
                                        class="btn btn-block btn-danger btn-xs">Belum Di Verifikasi</button>
                                    @else
                                    <button type="button"
                                        class="btn btn-block btn-primary btn-xs">Sudah Di Verifikasi</button>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        @endif
                        @endforeach
                    </div>
                </div>
    
                <div class="entry-item lifestyle shopping col-sm-12">
                    <div class="entry-body">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <td colspan="5"><strong>Produk Pesanan</strong></td>
                                </tr>
                                <tr>
                                    <th><strong>Gambar</strong></th>
                                    <th><strong>Nama</strong></th>
                                    <th><strong>Harga</strong></th>
                                    <th><strong>Kuantitas</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produkDiPesan as $produkDiPesans)
                                @if($produkDiPesans->pesanan_id == $pesanans->id)
                                <tr>
                                    <td style="width: min-content;">
                                        <img src="{{ asset('inputan/produk/img/') }}/{{ $produkDiPesans->produk->gambarproduk1 }}" width="100">
                                    </td>
                                    <td>{{$produkDiPesans->produk->namaproduk}}</td>
                                    <td>@currency($produkDiPesans->produk->harga)</td>
                                    <td>{{$produkDiPesans->kuantitas}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End .collapse -->
    </div><!-- End .accordion -->
    @else
    @endif
    @endforeach
  </div>