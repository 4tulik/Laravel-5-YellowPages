<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-Apteki.info :: Spis aptek z całej Polski.</title>


        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
                <link href="{{ asset('/css/bootstrap-theme.min.css') }}" rel="stylesheet">

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/flick/jquery-ui.min.css" rel="stylesheet"></li>
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Irish+Grover' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=La+Belle+Aurore' rel='stylesheet' type='text/css'>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
@yield('header')
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">e-apteki.info</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Strona główna</a></li>
            <li><a href="{{ url('/') }}"><i class="fa fa-plus"></i> Dodaj aptekę</a></li>
					 <li><a href="{{ url('/') }}"><i class="fa fa-list-ol"></i>
 Ranking aptek</a></li>

          </ul>

					<ul class="nav navbar-nav navbar-right">

						@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Zaloguj</a></li>
						<li><a href="{{ url('/auth/register') }}">Rejestracja</a></li>
						@else

                    <img src="@if(Auth::user()->avatar == '') https://ssl.gstatic.com/gb/images/silhouette_48.png @else {{ Auth::user()->avatar }} @endif" style="border-radius: 5px;" width="48" height="48" />

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-comments-o"></i>
 Moje komentarze</a></li>
 <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-database"></i>
  Dodane podmioty</a></li>
              <hr/>
								<li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out"></i>
 Wyloguj się</a></li>

							</ul>

							@endif
						</ul>
					</div>
				</div>
			</nav>
			@yield('content')
			<!-- Scripts -->
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
          <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <script src="http://localhost:8000/js/expanding.js"></script> <script src="http://localhost:8000/js/starrr.js"></script>

          <script type="text/javascript">
            $( document ).ready(function() {
               $('input:text').bind({
               });
               $('#query').autocomplete({
                  minLength :3,
                  autoFocus: true,
                  source: '{{ URL('/autocomplete')}}'
              })
           });
    $(function(){
      // initialize the autosize plugin on the review text area
      $('#new-review').autosize({append: "\n"});
      var reviewBox = $('#post-review-box');
      var newReview = $('#new-review');
      var openReviewBtn = $('#open-review-box');
      var closeReviewBtn = $('#close-review-box');
      var ratingsField = $('#ratings-hidden');
      openReviewBtn.click(function(e)
      {
        reviewBox.slideDown(400, function()
          {
            $('#new-review').trigger('autosize.resize');
            newReview.focus();
          });
        openReviewBtn.fadeOut(100);
        closeReviewBtn.show();
      });
      closeReviewBtn.click(function(e)
      {
        e.preventDefault();
        reviewBox.slideUp(300, function()
          {
            newReview.focus();
            openReviewBtn.fadeIn(200);
          });
        closeReviewBtn.hide();

      });
      // If there were validation errors we need to open the comment form programmatically
      @if($errors->first('comment') || $errors->first('rating'))
        openReviewBtn.click();
      @endif
      // Bind the change event for the star rating - store the rating value in a hidden field
      $('.starrr').on('starrr:change', function(e, value){
        ratingsField.val(value);
      });
    });
  </script>
</body>
</html>
