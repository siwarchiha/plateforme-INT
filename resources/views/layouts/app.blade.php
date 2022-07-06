<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ config('app.name', 'Formbuilder') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{asset('assetstemp2/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assetstemp2/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assetstemp2/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assetstemp2/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assetstemp2/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assetstemp2/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assetstemp2/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assetstemp2/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assetstemp2/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assetstemp2/assets/css/style.css')}}" rel="stylesheet">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>

      <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->

    <!-- Libraries Stylesheet -->
    <!-- <link href="{{ asset('assetstemp/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assetstemp/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assetstemp/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assetstemp/css/formeo.min.css')}}">


    <!-- Template Stylesheet -->
    <!-- <link href="{{ asset('assetstemp/css/style.css')}}" rel="stylesheet"> -->

     <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- J'ai ajouté ce script parceque le dropdown menu doesn't open -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script> 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @stack('styles')

    <link href="{{ asset('assetstemp2/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assetstemp2/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
<style>
  #ErrorName{
    color:red;

  }
  #ErrorVisibility{
    color:red;

  }
  #ErrorFiche{
    color:red;

  }
  #ErrorForm{
    color:red;
  }
</style>

  <!-- ======= Header ======= -->
  @include('partials.navbar') 


  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('partials.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    <!-- <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div> -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">

          </div>
        </div>
        @yield('content')
        
        <script src="{{ asset('assetstemp/js/formeo.min.js')}}"></script>
  
    <script>
    
    var formeo = new FormeoEditor({
  editorContainer: "#fb-editor",
  events: {
    onSave: function(e) {
      $('#ErrorName').empty();
      $('#ErrorVisibility').empty();
      $('#ErrorFiche').empty();
      $('#ErrorForm').empty();
        console.log(e.formData);
                                    var name = $("input[name='name']").val();
                                    var token = $("input[name='_token']").val();
                                    var visibility = $("select[name='visibility']").val();
                                    var fiche = $("select[name='fiche']").val();
                                    var formJson = JSON.stringify(e.formData); 
                                    var id = e.formData.id;
                                    var rows=e.formData.rows;
                                    var data = { id:id,
                                        formJson:formJson,
                                        name:name,
                                        visibility:visibility,
                                        id_fiche:fiche,
                                        rows:rows,
                                        _token:token
                                         ,};
                                    console.log(data);
                                    

                                    $.ajax({
                                        url:"{{route('form.create')}}",
                                        type: 'POST',
                                        data:data,
                                        success: function(res){
                                          if(res.ErrorName){
                                             // console.log(res.ErrorName);
                                             //$('#ErrorName').class("fas fa-exclamation");
                                              $('#ErrorName').text(res.ErrorName);
                                              $('#ErrorName').removeClass('d-none');

                                            }
                                            if(res.ErrorVisibility){
                                              //console.log("error");
                                              $('#ErrorVisibility').text(res.ErrorVisibility);
                                              $('#ErrorVisibility').removeClass('d-none');

                                            }

                                            if(res.ErrorFiche){
                                              //console.log("error");
                                              $('#ErrorFiche').text(res.ErrorFiche);
                                              $('#ErrorFiche').removeClass('d-none');

                                            }
                                            if(res.ErrorForm){
                                              //console.log("error");
                                              $('#ErrorForm').text(res.ErrorForm);
                                              $('#ErrorForm').removeClass('d-none');

                                            }
                                            if(res.success){
                                                //window.location (name + " a été enregister dans la bd avec succée");
                                                $('#createSuccess').text(res.success);
                                                $('#createSuccess').removeClass('d-none');
                                            }
                                        }
                                        })
    }
  },
  svgSprite: "https://draggable.github.io/formeo/assets/img/formeo-sprite.svg"
});

 
</script>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('partials.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> 

  <script src="{{asset('assetstemp2/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assetstemp2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assetstemp2/assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assetstemp2/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assetstemp2/assets/vendor/quill/quill.min.js')}}"></script>

  <script src="{{asset('assetstemp2/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assetstemp2/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assetstemp2/assets/js/main.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {

    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'nom_operateur', name: 'nom_operateur'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });

</script>

<script type="text/javascript">
  $(function () {
    table.destroy();

    var table = $('#tableOperateur').DataTable({
   
        processing: true,
        serverSide: true,
        ajax: "{{ route('operateurs.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nom_operateur', name: 'nom_operateur'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });

  var table = $('#tableOperateur').DataTable({
   
   processing: true,
   serverSide: true,
   ajax: "{{ route('operateurs.list') }}",
   columns: [
       {data: 'id', name: 'id'},
       {data: 'nom_operateur', name: 'nom_operateur'},
       {
           data: 'action', 
           name: 'action', 
           orderable: true, 
           searchable: true
       },
   ]
});

</script>

<!-- <script>
    $(document).ready(function() {
        App.init();
    });
</script>    -->
</body>
</html> 