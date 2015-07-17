@if(isset($powiaty))
@foreach ($powiaty as $powiat)
  @if($ilosc[$powiat->id])
  <div class="col-md-9">
    <a href="/woj/{{ $wojewodztwo->id }}/pow/{{ $powiat->id}}">{{ $powiat->powiat_nazwa }}</a>
  </div>
  <div class="col-md-3">
    {{ $ilosc[$powiat->id]}}
  </div>
  @endif
@endforeach
@endif
