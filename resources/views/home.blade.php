@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 style="color:#269ABC; font-family: 'Irish Grover', cursive; font-size: 92px; text-align: center; line-height: 110px; }
			">
			e-Apteki.info</h2>
			<h3 style=" text-align: center; font-family: 'La Belle Aurore', cursive; font-size: 24px; margin-bottom: 20px; font-weight: normal; }
			">Spis aptek z całej Polski</h3>

			<div class="col-md-6 col-md-offset-3">
				<h2 text-align="center" style="text-align: center">Wyszukaj aptekę w twojej okolicy</h2>
				<div id="custom-search-input">
					<div class="input-group col-md-12">
						<form action="/search" method="POST" role="form">
													<span class="input-group-btn">

							<input name="_token" value="{{ csrf_token() }}"  type="hidden">
							<input  type="text" class="form-control input-lg" id="query" name="query" placeholder="Miejscowość, nazwa, ulica" />
								<button type="submit" class="btn btn-info btn-lg">
									<i class="fa fa-search"></i>
							</button>
							</span>
						</div>


					</form>

				</div>
			</div><br>
			<br>
			<br>
			<br>
			<br>
			<br>

			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- YellowPagesResponsive_test -->
			<ins class="adsbygoogle"
			style="display:block"
			data-ad-client="ca-pub-6932466647344894"
			data-ad-slot="2593384156"
			data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			<br />

				<br />

				<div class="container">
					<div class="row">
						<div class="col-md-13">
							@include('partials/left_menu/wojewodztwa')
							@include('partials/left_menu/powiaty')
							@include('partials/left_menu/gminy')
						</div>
						<div class="col-md-9">
							@include('partials/item_table')
							@if(isset($podmioty))
							{!! $podmioty->render() !!}
							@endif
							@include('podmioty/review')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
