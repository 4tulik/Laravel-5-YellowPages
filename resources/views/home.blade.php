@extends('app')
@section('content')
<div class="container">
	<div class="row">

		@if(isset($powiat_wojewodztwo))
		<div class="col-md-12">
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-default"href="/woj/{{ $powiat_wojewodztwo->id }}">Powróć do woj. {{$powiat_wojewodztwo->wojewodztwo_nazwa}}</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-default"href="/woj/{{ $powiat_wojewodztwo->id }}/pow/{{ $powiat->id}}">Jestes tu powiat -  {{ $powiat->powiat_nazwa }}</a>
				</button>
			</div>
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Przejdż do gminy
					<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						@if(isset($gminy))
						@foreach ($gminy as $gmina)
						<li role ="presentation"><a role="menuitem" tabindex="-1" href="/pow/{{ $gmina->powiat_id }}/gmi/{{ $gmina->id}}">{{ $gmina->gmina_nazwa }}</a></li>
						@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
		@elseif(isset($wojewodztwo))
		<div class="col-md-12">
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-default"href="/">Powróć do województw</a>
				</div>

				<div class="btn-group" role="group">
					<a type="button" class="btn btn-default"href="/woj/{{ $wojewodztwo->id}}"> Jesteś tutaj - województwo {{ $wojewodztwo->wojewodztwo_nazwa }}</a>
				</button>
			</div>
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Przejdż do powiatu
					<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						@if(isset($powiaty))
						@foreach ($powiaty as $powiat)
						<li role="presentation"><a role="menuitem" tabindex="-1" href="/woj/{{ $wojewodztwo->id }}/pow/{{ $powiat->id }}">{{ $powiat->powiat_nazwa }}</a></li>
						@endforeach
						@endif
					</ul>
				</div>
			</div>
			@endif
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-3">

					<div class="well">
						<div class="row">
							@include('partials/left_menu/wojewodztwa')
							@include('partials/left_menu/powiaty')
							@include('partials/left_menu/gminy')

						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">Home</div>
						@include('partials/item_table')
					</div>
				</div>
				@if(isset($podmioty))
				{!! $podmioty->render() !!}
				@endif
				@if(isset($podmioty))
				{!! $podmioty->render() !!}
				@endif
			</div>
		</div>
	</div>
	@if(isset($podmioty))
	{!! $podmioty->render() !!}
	@endif

</div>
</div>
</div>
</div>
@endsection
