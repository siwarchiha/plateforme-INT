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
    <style>
        .g-recaptcha {
            transform:scale(0.77);
            transform-origin:0 0;
        }
    </style>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="{{asset('assetstemp/img/logo_intt.png')}}" width="100%" alt="logo">
                  <!-- <span class="d-none d-lg-block">INTT</span> -->
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Se connecter</h5>
                    <!-- <p class="text-center small">Entrez votre nom d'utilisateur et votre mot de passe pour vous connecter</p> -->
                  </div>

                  
                    <p id="loginError" class="alert alert-danger d-none"></p>
                    <p id="loginSuccess" class="alert alert-success d-none"></p>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form id='loginForm' class="row g-3" >
                  @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" id="email" class="form-control"  required>
                        <div class="invalid-feedback">Entrez votre nom d'utilisateur.</div>
                      </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="password" id="password" class="form-control"  required>
                      <div class="invalid-feedback">Entrez votre mot de passe!</div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-12">
                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <a class="small" href="{{route('password.request')}}">Mot de passe oublié</a>
                    </div>

                    <div class="form-group mt-1 mb-1" >
                        {!! NoCaptcha::display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                            @endif
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">S'identifier</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Vous n'avez pas de compte?<a href=""> S'inscrire</a></p>
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

<script src="{{ asset('assetstemp/js/main.js')}}"></script>

{!! NoCaptcha::renderJs('fr', false, 'recaptchaCallback') !!}
<script type="text/javascript">
    var onloadCallback = function() {
    alert("grecaptcha is ready!");
    };
</script>

<script>
        $('#loginForm').submit(function(e){

            e.preventDefault();
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();
            var token = $("input[name='_token']").val();
            var recaptcha = $("#g-recaptcha-response").val();

        //var data = {email:email, password:password, _token:token};
        var data = {email:email, password:password,recaptcha:recaptcha, _token:token};
            $.ajax({
                url:"{{route('login')}}",
                type:'POST',
                data:data,
                    success:function(response){
                        //console.log(data);
                        if(response.error){
                            console.log(response.error);
                            console.log(response.data);
                        $('#loginError').text(response.error);
                        $('#loginError').removeClass('d-none');
                        }
                        if(response.success){

                                location.href = "/form-builder/forms";
                         
                                //location.href = "/dashboard";
                        /*
                            if(response.data.role ===2){
                                location.href = "/admin/autorisations";
                            }
                            else {
                                location.href = "/espace/admin";
                            } 
                        */
                        // $('#loginError').removeClass('d-none');
                        // $('#loginSuccess').text(loginBtn);
                        // $('#loginSuccess').removeClass('d-none');
                        
                        }               
                    },
                    error:function(){
                        
                    }
                })
            });
    </script>
</body>

</html>