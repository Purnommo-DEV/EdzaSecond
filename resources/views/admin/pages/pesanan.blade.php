@extends('admin/layouts/Admin')
@section('name')
produk
@endsection

@section ('content')
<div class="container-fluid">
    <div class="row mt-5 ml-3 mb-5">
        <h2 class="font-weight-bold text-primary">Pesanan Pelanggan</h2>
    </div>

    {{-- awal form --}}
    <div class="card shadow mb-4">
        <div class="card-body ">
            <div class="table-responsive mt-2">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            @php
                                $total_bayar = 0;
                            @endphp
                            @foreach ($pesanan as $pesanans)
                            <td>{{$pesanans->user->name}}</td>
                            @php
                                $total_bayar = $pesanans->total_bayar+$pesanans->ongkos_kirim
                            @endphp
                            <td>@currency($total_bayar)</td>
                            <td>{{$pesanans->status_pesanan}}</td>
                            <td><a href="{{ route('PesananDetail',$pesanans->id) }}">Detail</a></td>

                        </div>
            </tr>
            </tbody>
            @endforeach
            </table>
        </div>
    </div>
</div>

{{-- akhir form --}}

</div>
<script>
    $(document).ready(function () {
        $('.mdb-select').materialSelect();
    });

</script>
@endsection
