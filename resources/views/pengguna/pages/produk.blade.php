@extends('pengguna/layouts/Home')
@section('name')
Beranda
@endsection

@section ('content')
<section class="features-area section_gap">
	<div class="container">
	</div>
</section>
	<section class="features-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Produk</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
								dolore
								magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					 @foreach ($produks as $produks)
					<!-- single product -->
					
					<div class="col-lg-3 col-md-6 produk_data">
						<div class="single-product">
							<img class="img-fluid" src="{{asset('inputan/produk/img/')}}/{{$produks->gambarproduk1}}" alt="">
							<div class="product-details">
								<h6>{{$produks->namaproduk}}</h6>
								<div class="price">
									<h6>@currency($produks->harga)</h6>
									<!-- 	<h6 class="l-through">$210.00</h6> -->
								</div>
								<div class="prd-bottom">
									<form>

										<input type="hidden" class="produk_id" name="produk_id" value="{{ $produks->id }}" hidden>
										<input type="hidden" class="kuantitas" name="kuantitas" value="1" hidden>
										<input type="hidden" class="berat_produk" name="berat_produk" value="{{ $produks->berat}}" hidden>
										<input type="hidden" class="harga_produk" name="harga_produk" value="{{ $produks->harga}}" hidden>

									
									<a class="tambahKeKeranjangBtn social-info">
										<span class="ti-bag"></span>
										<p class="hover-text" style="font-size: 10px">Add to Cart</p>
									</a>
									
									<a href="{{route('detailproduk',$produks->id)}}" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text" style="font-size: 10px">View Detail</p>
									</a>
								</div>
							</form>
							</div>
						</div>
					</div>
					@endforeach
		
				</div>
			</div>
		</div>
	</section>
@endsection