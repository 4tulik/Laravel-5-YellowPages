               @if(isset($podmioty))
        <div class=" col-md-12 ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th class="text-center">Ocena</th>
                    </tr>
                </thead>
                <tbody>
			   @foreach ($podmioty as $podmiot)
					<tr>
                        <td class="col-md-7 col-md-offset-1">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body" style="padding: 10px">
                                <h4 class="media-heading"><a href="/podmiot/{{ $podmiot->nazwa_slug }}">{{ $podmiot->nazwa }}</a></h4>
								<span>{{ $podmiot->ulica_typ }} {{ $podmiot->ulica_nazwa}} </span><span class="text-success"><strong></strong></span>
                                <h5 class="media-heading">{{ $podmiot->pna }} <a href="#">{{ $podmiot->miejscowosc }}</a></h5>
                                <h6 class="media-heading">
                                <i class="fa fa-caret-square-o-right"></i> NIP:</i> {{ $podmiot->nip }} |
                                <i class="fa fa-caret-square-o-right"></i> Regon: {{$podmiot->regon }}
                                | <strong><i class="fa fa-phone"></i> Nr telefonu: {{ $podmiot->nr_telefonu }} </strong>
                                </h6>

                            </div>
                        </div></td>
                        <td class="col-sm-2 col-md-2" style="text-align: center">
                        Ilość opinii: {{ $podmiot->rating_count }}
                            <div class="row lead">
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $podmiot->rating_cache) ? '' : '-empty'}}"></span>
                    @endfor
                    </div>
                    Średnia ocena: {{ $podmiot->rating_cache }} <br/>
                    <a href="/podmiot/{{ $podmiot->nazwa_slug }}#reviews-anchor">Dodaj opinię</a>


                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endif

