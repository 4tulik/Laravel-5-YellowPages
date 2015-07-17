@if(isset($wojewodztwa))
@foreach ($wojewodztwa as $wojewodztwo)
  @if($ilosc[$wojewodztwo->id])
  <div class="col-md-9">
    <a href="/woj/{{ $wojewodztwo->id  }}">{{ $wojewodztwo->wojewodztwo_nazwa }}</a>
  </div>
  <div class="col-md-3">
    {{ $ilosc[$wojewodztwo->id] }}
  </div>
  @endif
@endforeach
@endif
