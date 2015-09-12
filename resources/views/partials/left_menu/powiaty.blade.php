@if(isset($miasta))
<div class="col-md-3">
  <div class="well">
    <div class="row">
     @foreach ($miasta as $miasto)
     <div class="col-md-9">
       <a href="/woj/{{ $miasto->woj }}/pow/{{ $miasto->pow}}">{{ $miasto->nazwa }}</a>
     </div>
     <div class="col-md-3" style="color: #A8A8A8">
      {{ $ilosc[$miasto->pow]}}

    </div>
    @endforeach
      </div>
</div>

    @endif

@if(isset($powiaty))

<div class="well">
  <div class="row">
   @foreach ($powiaty as $powiat)
   @if($ilosc[$powiat->pow])
   <div class="col-md-9">
     <a href="/woj/{{ $powiat->woj }}/pow/{{ $powiat->pow}}">{{ $powiat->nazwa }}</a>
   </div>
   <div class="col-md-3" style="color: #A8A8A8">
     {{ $ilosc[$powiat->pow]}}
   </div>
   @endif
   @endforeach
    </div>
   @endif


