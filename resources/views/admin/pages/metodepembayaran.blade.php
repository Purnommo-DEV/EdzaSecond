@extends('admin/layouts/Admin')
@section('name')
Metode Pembayaran
@endsection

@section ('content')
<div class="container-fluid">
    <div class="row mt-5 ml-3 mb-5">
        <h2 class="font-weight-bold text-primary">Halaman Metode Pembayaran</h2>
    </div>

    {{-- awal form --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            
            <a href="#" class="btn btn-warning btn-icon-split float-right" data-toggle="modal" data-target="#tambah">
                <span class="icon  font-weight-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                      </svg>

                </span>
                <span class="text">Tambah Metode Pembayaran</span>
            </a>
            {{-- modalnye --}}
            <div class="modal fade animated--grow-in" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Tambah Metode Pembayaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="user" action="{{ route('TambahMetode') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <Label class="font-weight-bold">Metode Pembayaran</Label>
                                <input type="text" class="form-control form-control-user" id="namakat"
                                    placeholder="Nama Kategori" name="namametode">
                            </div>
                            {{-- <div class="col-sm-12">
                              <label class="form-label" for="customFile">Unggah Gambar</label>
                                <input type="file" class="form-control" name="gambarmetode" id="customFile"/>
                            </div> --}}
                              <div class="col-sm-12 mb-3 mb-sm-0">
                                <Label class="font-weight-bold">Nama Pemilik Rekening</Label>
                                <input type="text" class="form-control form-control-user" id="namapemilik"
                                    placeholder="Nama Pemilik Rekening" name="namapemilik">
                            </div>
                              <div class="col-sm-12 mb-3 mb-sm-0">
                                <Label class="font-weight-bold">No Rekening</Label>
                                <input type="text" class="form-control form-control-user" id="norekening"
                                    placeholder="No Rekening" name="norekening">
                            </div>
                        </div>
                   
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                  </div>
                </div>
        </div>
            {{-- akhirmodalnye --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama metode Pembayaran</th>
                            <th>Nama Pemilik Rekening</th>
                            <th>No Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
              
                    <tbody>
                      @foreach ($metodes as $metodes)
                        <tr>
                            <td>{{$metodes->namametode}}</td>
                            <td>{{$metodes->namapemilik}}</td>
                            <td>{{$metodes->norekening}}</td>
                            
                            <td>   <a href="#" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit-{{$metodes->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                  </svg>
                            </a>
                           
                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#hapus-{{$metodes->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                  </svg>
                            </a>
                          {{-- modalnye --}}
           
                <div class="modal fade animated--grow-in" id="hapus-{{$metodes->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">hapus Barang</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <h2 class="font-weight-bold">Apakah Kamu Yakin</h2>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <form action="{{ route('metodes.destroy', $metodes->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn-danger  delete" type="submit" value="submit">
                          Ya</button>
                        </form>
                        </div>
                      </div>
                    </div>
            </div>

            {{-- akhirmodalnye --}}
                        </td>

                      </tr>

                      <div class="modal fade animated--grow-in" id="edit-{{$metodes->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('UbahMetode', $metodes->id)}}" method="POST" enctype="multipart/form-data"  class="user">
                                  @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <Label class="font-weight-bold">Nama Kategori</Label>
                                            <input type="text" name="namametode" class="form-control form-control-user" id="namametode"
                                                placeholder="Nama Kategori" value="{{$metodes->namametode}}">
                                        </div>
                                        {{-- <div class="col-sm-12">
                                          <label class="form-label" for="customFile">Unggah Gambar</label>
                                          <input type="file" class="form-control" name="gambarmetode" id="customFile"/>
                                        </div> --}}
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                        <Label class="font-weight-bold">Nama Pemilik Rekening</Label>
                                        <input type="text" class="form-control form-control-user" id="namapemilik"
                                            placeholder="Nama Pemilik Rekening" name="namapemilik" value="{{$metodes->namapemilik}}">
                                        </div>
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <Label class="font-weight-bold">No Rekening</Label>
                                            <input type="text" class="form-control form-control-user" id="norekening"
                                                placeholder="No Rekening" name="norekening" value="{{$metodes->norekening}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                           
                          </div>
                        </div>
                     </div>
                      @endforeach
                       
                    </tbody>
                </table>
                  {{-- modalnye edit --}}
            
            {{-- akhirmodalnye --}}
            </div>
        </div>
    </div>

   {{-- akhir form --}}

</div>
<script>
    $(document).ready(function() {
    $('.mdb-select').materialSelect();
    });
</script>
@endsection