
	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link" href="{{route('Beranda')}}">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('HalamanProduk') }}">Produk</a></li>
							@if (Auth::user() == NULL)
							<li class="nav-item submenu dropdown">
								<a href="{{ route('Login') }}" class="nav-link">Login</a>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="{{ route('Register') }}" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
								aria-expanded="false">Register</a>
							</li>
							@elseif (Auth::user()->peran == "Pelanggan")
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="{{ route('Keranjang') }}" class="cart"><span class="ti-bag total-produkKeranjang"></span></a></li>
							<li class="nav-item">
								<a href="{{route('Profil')}}"><span class="lnr lnr-user"> {{ Auth::user()->name }}</span></a>
							</li>
							<li class="nav-item">
								<a title="Keluar" href="{{route('UserLogOut')}}" 
								onclick="event.preventDefault(); 
								document.getElementById('logout-form').submit();"><span class="lnr">Keluar</span></a>
							</li>
								<form id="logout-form" action="{{route('UserLogOut')}}" method="post">
									@csrf
								</form>
								{{-- <li class="nav-item">
									<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
								</li> --}}
							</ul>
							@elseif (Auth::user()->peran == "Admin")
							<li class="nav-item active"><a class="nav-link" href="{{ route('produk') }}">Halaman Admin</a></li>
							@endif
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->