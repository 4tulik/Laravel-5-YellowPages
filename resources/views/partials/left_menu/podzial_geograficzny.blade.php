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
