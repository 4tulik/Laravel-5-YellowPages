
<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nazwa</th>
			<th>Kod-Pocztowy</th>
			<th>Adres</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($podmioty))
		@foreach ($podmioty as $podmiot)
		<tr>
			<td>{{ $podmiot->podmiot_id }}</td>
			<td>{{ $podmiot->nazwa }}</td>
			<td>{{ $podmiot->pna }}</td>
			@if($podmiot->ulica_nazwa == NULL )
			<td>{{ 'gmi. ' . $podmiot->gmina_id }}</td>
			@elseif($podmiot->ulica_nazwa == NULL && $podmiot->miejscowosc == NULL )
			<td>{{ 'msc. ' . $podmiot->miejscowosc }}</td>
			@else
			<td>{{ $podmiot->ulica_cecha }} {{$podmiot->ulica_nazwa}}</td>
			@endif
		</tr>
		@endforeach
		@endif
	</tbody>
</table>
