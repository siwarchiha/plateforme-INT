<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - INTT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assetstemp2/assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('assetstemp2/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assetstemp2/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assetstemp2/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assetstemp2/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assetstemp2/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('assetstemp2/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('assetstemp2/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assetstemp2/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assetstemp2/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <main>
    <div class="">

      <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"> 
        <!-- <section class="container-xxl position-relative bg-white d-flex p-0"> -->
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="{{asset('assetstemp/img/logo_intt.png')}}" width="100%" alt="logo">
                  <!-- <span class="d-none d-lg-block">INTT</span> -->
                </a>
              </div><!-- End Logo -->
                
              <div class="card">

              <div class="card-header">Récupération de mot de passe</div>
 
              <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('réinitialiser') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>

              <!-- <div class="credits">
                   Designed by <a href="#">Dataera</a>
              </div> -->

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assetstemp2/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assetstemp2/assets/js/main.js')}}"></script>


</body>

</html>