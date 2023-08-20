<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Site Title -->
	<title>Edza Second Store</title>
	<!--
		CSS
		============================================= -->
	@include('pengguna.includes.style')
</head>

<body>

	@include('sweetalert::alert')

	@include('pengguna.includes.navbar')

	@yield('content')
	<!-- End related-product Area -->

	@include('pengguna.includes.footer')
<!-- 	@include('pengguna.includes.script') -->

</body>

	{{-- <script src="{{asset('frontend/js/jquery.min.js')}}"></script> --}}
	<script src="{{asset('frontend/js/vendor/jquery-2.2.4.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="{{asset('frontend/js/vendor/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.sticky.js')}}"></script>
	<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
	<script src="{{asset('frontend/js/countdown.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
	<script src="{{ asset('frontend/js/sweetalert/sweetalert.min.js') }}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{asset('frontend/js/gmaps.min.js')}}"></script>
	<script src="{{asset('frontend/js/main.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	@yield('script')
	<script>
		tampilProdukKeranjang()
		$.ajaxSetup
		({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			}
		});

		function tampilProdukKeranjang() {
			$.ajax({
				method: "GET",
				url: "/totalProdukDlmKeranjang",
				success: function (response) {
					$('.total-produkKeranjang').html('');
					$('.total-produkKeranjang').html(response.totalProdukKeranjang);
				}
			});
		}
	</script>
	<script>
		$(document).ready(function () {
		$(".tambahKeKeranjangBtn").click(function(e){
	 
			e.preventDefault();
	
			var produk_id = $("#produk_id").val();
			var berat_produk = $("#berat_produk").val();
			var harga_produk = $("#harga_produk").val();
			var kuantitas =  $("#kuantitas").val();
	
			$.ajax({
				method: "POST",
				url:"/tambahKeKeranjang",
				data:{produk_id:produk_id, berat_produk:berat_produk, harga_produk:harga_produk, kuantitas:kuantitas},
				success:function(data){
				alert(data.success);
				tampilProdukKeranjang();
				}
			});
			});
		});
	</script>
	<script>
        $(document).ready(function () {
        $(".tambahKeKeranjangBtn").click(function (e) {
            e.preventDefault();
            var produk_id = $(this)
                .closest(".produk_data")
                .find(".produk_id")
                .val();
            var kuantitas = $(this)
                .closest(".produk_data")
                .find(".kuantitas")
                .val();
            var berat_produk = $(this)
                .closest(".produk_data")
                .find(".berat_produk")
                .val();
            var harga_produk = $(this)
                .closest(".produk_data")
                .find(".harga_produk")
                .val();
            $.ajax({
                method: "POST",
                url: "/tambahKeKeranjang",
                data: {
                    produk_id: produk_id,
                    berat_produk:berat_produk,
                    harga_produk:harga_produk,
                    kuantitas: kuantitas
                },
                success: function (response) {
                    alert(response.status);
                    tampilProdukKeranjang()
                }
            });
        });
    });
</script>
</html>