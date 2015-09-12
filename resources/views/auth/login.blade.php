@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Logowanie</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


					<div class="container">

						<div class="col-md-12 col-md-offset-1">

							<div class="omb_login">
								<h3 class="omb_authTitle"><a href="{{ url('/auth/register') }}" style="text-align:right">Zarejestruj się</a> lub zaloguj się za pomocą:</h3>
								<div class="row omb_row-sm-offset- omb_socialButtons">
									<div class="col-xs-4 col-sm-3">
										<a href="/facebook/authorize" class="btn btn-lg btn-block omb_btn-facebook">
											<i class="fa fa-facebook"></i>
											<span class="hidden-xs">Facebook</span>
										</a>
									</div>

									<div class="col-xs-4 col-sm-3">
										<a href="/google/authorize" class="btn btn-lg btn-block omb_btn-google">
											<i class="fa fa-google-plus"></i>
											<span class="hidden-xs">Google+</span>
										</a>
									</div>
								</div>

								<div class="row omb_row-sm-offset-2 omb_loginOr">
									<div class="col-xs-12 col-sm-6">
										<hr class="omb_hrOr">
										<span class="omb_spanOr">albo</span>
									</div>
								</div>
								<div class="row omb_row-sm-offset-2">
									<div class="col-xs-12 col-sm-6">
											<form class="omb_loginForm" role="form" method="POST" action="{{ url('/auth/login') }}">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Adres E-Mail">
												</div>
												<span class="help-block"></span>

												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
													<input  type="password" class="form-control" name="password" placeholder="Hasło">
												</div>
												<br/>
												<button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-3">
											<label class="checkbox">
												<input type="checkbox" value="remember">Zapamiętaj mnie
											</label>
										</div>
										<div class="col-xs-12 col-sm-3">
											<p class="omb_forgotPwd">
												<a class="btn btn-link" href="{{ url('/password/email') }}">Zapomniałeś hasła?</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>




					</div>
				</div>
			</div>
		</div>
	</div>

		@endsection
