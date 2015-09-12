@if(isset($wojewodztwa))
          <div class="col-md-3">
            <div class="well">
              <div class="row">
@foreach ($wojewodztwa as $wojewodztwo)
  @if($ilosc[$wojewodztwo->woj])
  <div class="col-md-9">
    <a href="/woj/{{ $wojewodztwo->woj}}">{{ $wojewodztwo->nazwa }}</a>
  </div>
  <div class="col-md-3" style="color: #A8A8A8">
    {{ $ilosc[$wojewodztwo->woj] }}
  </div>
  @endif
@endforeach
 </div>
  </div>

@endif
