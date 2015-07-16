<div class="col-md-3">
	<div class="well">
		<div class="row">
			@foreach($miejscowosci as $miejscowosc)
			<div class="col-md-9">
				<a href="">{{ $miejscowosc->miejscowosc }}</a>
			</div>
			<div class="col-md-3">
			</div>
			@endforeach
		</div>

		@if(isset($wojewodztwa))
		@foreach ($wojewodztwa as $wojewodztwo)
		@if($ilosc[$wojewodztwo->id])
		<div class="row">
			<div class="col-md-9">
				<a href="/woj/{{ $wojewodztwo->id  }}">{{ $wojewodztwo->wojewodztwo_nazwa }}</a>
			</div>
			<div class="col-md-3  text-muted"	>
				{{ $ilosc[$wojewodztwo->id] }}
			</div>
		</div>
		@endif
		@endforeach
		@endif

		@if(isset($powiaty))
		@foreach ($powiaty as $powiat)
		<div class="row">
			<div class="col-md-9">
				<a href="/woj/{{ $wojewodztwo->id }}/pow/{{ $powiat->id}}">{{ $powiat->powiat_nazwa }}</a>
			</div>
			<div class="col-md-3">
				{{ $ilosc[$powiat->id]}}
			</div>
		</div>
		@endforeach
		@endif
		@if(isset($gminy))
		@foreach ($gminy as $gmina)
		<div class="row">
			<div class="col-md-9">
				<a href="/pow/{{ $gmina->powiat_id }}/gmi/{{ $gmina->id}}">{{ $gmina->gmina_nazwa }}</a>
			</div>
			<div class="col-md-3">
				{{ $ilosc[$gmina->id]}}
			</div>
		</div>
		@endforeach
		@endif
		@if(isset($ulice))
		@foreach ($ulice as $ulica)
		<div class="row">
			<div class="col-md-9">
				<a href="/gmi/{{ $ulica->gmina_id}}">{{ $ulica->ulica_nazwa_1 }}</a>
			</div>
			<div class="col-md-3">
				{{ $ilosc[$ulica->id]}}
			</div>
		</div>
		@endforeach
		@endif

	</div>
</div>
