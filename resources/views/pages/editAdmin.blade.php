@extends('formbuilder::layout')

@section('content')
<!-- start form -->
<div class="col-lg-12">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Modifier un utilisateur</h5>

    <!-- General Form Elements -->
    <div id="nsuccess" class="mb-4 font-medium text-sm text-success"></div>
    <div id="nerror" class="mb-4 font-medium text-sm text-danger"></div>

    <form id="editForm" action="{{ route('admin.update',  ['id'=>$admin->id])}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
            <div class="row mb-3">
                <label for="name" class="col-sm-2  col-form-label">Nom d'utilisateur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" maxlength="30">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" readonly class="form-control" pattern='^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$' value="{{ $admin->email }}" id="email"  name="email">
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
                    <select class="form-select mb-3" disabled="true" id='role' name='role' value="" aria-label="Default select example">
                        <option selected disabled>Choisir un rôle</option>
                        
                        @if ($admin->role == 1)
                            <option value="1" selected>Super Admin</option>                           
                        @elseif ($admin->role == 2)
                            <option value="2" selected>Admin</option>                          
                        @else
                            <option value="3" selected>Opérateur</option> 
                        @endif
                        <!-- <option value="2">Admin</option>
                        <option value="3">Operateur</option> -->
                    </select>
                </div>
            </div>
            
            <div class="row mb-3 hide">
                <label for="role" class="col-sm-2 col-form-label">Opérateur</label>
                <div class="col-sm-10">
                    <select class="form-select mb-3" value="{{ $admin->operateur_id }}" id='nom_operateur' name='nom_operateur' aria-label="Default select example">
                        <option value="0" selected disabled>Choisir un opérateur</option>

                        <?php
                            $operateurs = App\Models\Operateur::latest()->get();
                        ?>

                        @if($operateurs->count() > 0)
                            @foreach ($operateurs as $operateur)
                                <!-- <option value="{{$operateur->id}}">{{$operateur->nom_operateur}}</option> -->
                                <option value="{{$admin->operateur_id}}" selected>{{$operateur->nom_operateur}}</option>
                                
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
            
            <div class="col-lg-12 text-center">
                
                    <button type="submit" class="btnAdd btn btn-primary ml-2">Appliquer</button>
                    <button type="submit" class="btn btn-success btnSend ">Invitation par E-mail</button>
                
            </div>
        </form>
    <!-- End General Form Elements -->

  </div>
</div>

</div>

<!-- end form-->

<!-- datatable -->
<!-- <div class="container mt-5">
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
</div>  -->

<script>
    $('#role').change(function () {
        var select=$(this).find(':selected').val();        
        $(".hide").hide();
        $('#' + select).show();

	    }).change();

        if(document.getElementById('role').value == "3") {
            $('#role').change(function () {
                var select=$(this).find(':selected').val();        
                $(".hide").show();
                $('#' + select).hide();

            }).change();
        }
</script>

<script>
     $(document).ready(function(){
        $(".btnEdit").hide();
                // send email onclick 
        $(".btnSend").click(function(e){
            e.preventDefault();

            var email = $('#email').val();
        
            var token = $("input[name='_token']").val();

            $.ajax({
                url: "{{route('password.email')}}",
                method: "POST",
                data:
                {
                    email:email,_token:token
                },
                success: function (response) {
                    $("#nsuccess").html("Invitation envoyée avec succès");
                    $("#divMessages").html(response);
                }
            });
          //  $("#editContactModal").modal("hide");
         // location.reload();
        });
    });
</script>

@endsection

