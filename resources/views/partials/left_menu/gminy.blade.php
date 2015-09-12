          <div class="col-md-3">

@if(isset($miasta_gminy))
            <div class="well">
              <div class="row">
	@foreach ($miasta_gminy as $miasto)
	@if($iloscMiasta[$miasto->pow])
	  <div class="col-md-9">
	    <a href="/woj/{{ $miasto->woj }}/pow/{{ $miasto->pow}}">{{ $miasto->nazwa }}</a>
	  </div>
	  <div class="col-md-3" style="color: #A8A8A8">
          {{ $iloscMiasta[$miasto->pow]}}

	  </div>
	  @endif
	@endforeach
		</div>
	</div>
	@endif




@if(isset($gminy))
            <div class="well">
              <div class="row">
@foreach ($gminy as $gmina)
@if($iloscGminy[$gmina->gmi])
<div class="col-md-9">
  <a href="/woj/{{ $gmina->woj }}/pow/{{ $gmina->pow }}/gmi/{{ $gmina->gmi}}">{{ $gmina->nazwa }}</a>
</div>
<div class="col-md-3" style="color: #A8A8A8">
  {{ $iloscGminy[$gmina->gmi]}}
</div>
@endif
@endforeach
</div>
</div>
@else
</div>
</div>
@endif
