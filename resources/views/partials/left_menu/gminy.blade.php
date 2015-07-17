@if(isset($gminy))
@foreach ($gminy as $gmina)
@if($ilosc[$gmina->id])
<div class="col-md-9">
  <a href="/pow/{{ $gmina->powiat_id }}/gmi/{{ $gmina->id}}">{{ $gmina->gmina_nazwa }}</a>
</div>
<div class="col-md-3">
  {{ $ilosc[$gmina->id]}}
</div>
@endif
@endforeach
@endif
