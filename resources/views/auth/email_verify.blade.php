<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
  <title>Email Confirmation - Global Admission</title>
  @include('partials.header')
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/pages/authentication.css')}}">
</head>

<body>
  <div class="page-loader">
    <div class="bg-primary"></div>
  </div>

  <!-- Content -->

  <div class="authentication-wrapper authentication-2 px-4" style="background-image: url('{{ URL::asset('assets_/img/bg/1.jpg')}}');" >
    <div class="authentication-inner py-5">

      <!-- Form -->
      <div class="card">
        <div class="p-4 p-sm-5">
        
          <h5 class="text-center text-muted font-weight-normal mb-4">
            <img src="{{asset('images/logo.png')}}" class="img-responsive text-center" width="70%">
          </h5>
          <div class="display-1 lnr lnr-checkmark-circle text-center text-success mb-4"></div>
          @if(isset($already))
            @if($already == 'yy')
            <p class="text-center text-big mb-4">Your e-mail is already <strong>verified</strong>. You can now login.</p>
            @else
            <p class="text-center text-big mb-4">Your email address has been successfully confirmed.</p>
            @endif
          @endif
          <a href="{{route('login')}}"><button type="button" class="btn btn-success btn-block">Proceed to your account</button>
          </a>
        </div>
      </div>
      <!-- / Form -->

    </div>
  </div>
</body>
</html>