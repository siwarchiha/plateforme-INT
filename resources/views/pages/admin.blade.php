@extends('formbuilder::layout')

@section('content')
<!-- start form -->
<div class="col-lg-12">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Ajouter un utilisateur</h5>

    <!-- General Form Elements -->
    <div id="nsuccess" class="mb-4 font-medium text-sm text-success"></div>
    <div id="nerror" class="mb-4 font-medium text-sm text-danger"></div>

    <form id="adminForm" method="POST">
    {{ csrf_field() }}
            <div class="row mb-3">
                <label for="name" class="col-sm-2  col-form-label">Nom d'utilisateur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" maxlength="30">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" pattern='^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$' id="email"  name="email">
                </div>
            </div>
            <!-- <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password"  name="password">
                </div>
            </div>  -->
            <div class="row mb-3">
                <label for="role" class="col-sm-2 col-form-label">Rôle</label>
                <div class="col-sm-10">
                    <select class="form-select mb-3" id='role' name='role' aria-label="Default select example">
                        <option selected disabled>Choisir un rôle</option>
                        <option value="1">Super admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Operateur</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3 hide" id="3">
                <label for="role" class="col-sm-2 col-form-label">Opérateur</label>
                <div class="col-sm-10">
                    <select class="form-select mb-3" id='nom_operateur' name='nom_operateur' aria-label="Default select example">
                        <option value="0" selected disabled>Choisir un opérateur</option>

                        <?php
                            $operateurs = App\Models\Operateur::latest()->get();
                        ?>

                        @if($operateurs->count() > 0)
                            @foreach ($operateurs as $operateur)
                                <option value="{{$operateur->id}}">{{$operateur->nom_operateur}}</option>
                            @endforeach
                        @endif
                        
                        <!-- <option value="1">Super admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Operateur</option> -->
                    </select>
                </div>
            </div>
            
            <!-- <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Checkbox</legend> 
                <legend class="col-form-label col-sm-2 pt-0"></legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            Check me out
                        </label>
                    </div>
                </div>
            </div> -->
            <p id="RegisterError" class="alert alert-danger d-none"></p>
            <button type="submit" class="btnAdd btn btn-primary" style="float: right;">Appliquer</button>
           
        </form>
    <!-- End General Form Elements -->

  </div>
</div>

</div>

<!-- end form-->

<!-- datatable -->
<div class="container mt-5">
    <h2 class="mb-4"></h2>
    <table class="table table-bordered yajra-datatable" id="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Opérateur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div> 

<script>
    $('#role').change(function () {
        var select=$(this).find(':selected').val();        
        $(".hide").hide();
        $('#' + select).show();

	    }).change();
</script>

<script>
    $(document).ready(function() {
      
        //App.init();
        $('#adminForm').submit(function(e){
        e.preventDefault();

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var nom_operateur = $('#nom_operateur').val();
        var role = $('#role').val();
        var token = $("input[name='_token']").val();

        var data = {
                name:name,
                email:email,
                password:password,
                nom_operateur:nom_operateur,
                role:role,
                _token:token
        };
        console.log(data);
        $.ajax({
            url:"{{ route('register') }}",
            type: 'POST',
            data:data,
            success: function(res){
                
                if(res.error){
                    // $('#error').text(res.error);
                    
                    console.log(res.error);
                    $('#RegisterError').text(res.error);
                    $('#RegisterError').removeClass('d-none');
                }
                if(res.success){
                    $('#table').DataTable().ajax.reload();
                    //$('#nerror').text('');
                    $('#nsuccess').text(res.success)

                   // $('#adminForm')[0].reset();
                   $('#RegisterError').removeClass('d-none');
  
                    
                    console.log(res);
                    $.ajax({
                        url: "{{route('password.email')}}",
                        method: "POST",
                        data:
                        {
                            email:email,_token:token
                        },
                        success: function (response) {
                            $("#divMessages").html("");
                            $("#divMessages").html(response);
                        }
                    });
                    
                  
                }

               
            }
          });
        });



    });
</script>
<script>
     $(document).ready(function(){
        $(".btnEdit").hide();

    });
</script>

@endsection

