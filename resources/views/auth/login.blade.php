
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Halaman Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="shortcut icon" href="img/images.png">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/images.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							@if(session('errors'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								Something it's wrong:
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							@if (Session::has('success'))
							<div class="alert alert-success">
								{{ Session::get('success') }}
							</div>
							@endif
							@if (Session::has('error'))
							<div class="alert alert-danger">
								{{ Session::get('error') }}
							</div>
							@endif
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="{{ route('login') }}">
								@csrf
								<div class="form-group">
									<label for="email">Alamat E-Mail</label>
									<input id="email" type="email" class="form-control" name="email" value="{{old('email')}}">
									@error('email')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="password">Kata Sandi
										<a href="{{route('password.request')}}" class="float-right">
											Lupa Kata Sandi ?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<span class="text-danger">@error('password'){{$message}}@enderror</span>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Belum Punya Akun <a href="{{ route('register') }}">Registrasi Sekarang</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; Website Pendakian Gunung Prau (Via Kalilembu) 
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
	<!-- Alert timeout -->
<script>
  window.setTimeout(function(){
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
    });
  }, 3000);
</script> 
<!-- EndAlert timeout -->
</body>
</html>
