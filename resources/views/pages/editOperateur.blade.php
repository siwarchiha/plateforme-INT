@extends('formbuilder::layout')

@section('content')

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter un opérateur</h5>

              <!-- General Form Elements -->
              
              <div id="nsuccess" class="mb-4 font-medium text-sm text-success"></div>
              <div id="nerror" class="mb-4 font-medium text-sm text-danger"></div>

              <form id="editForm" action="{{ route('operateur.update',  ['id'=>$operateur->id])}}" method="POST" >
              {{ csrf_field() }}	
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Opérateur</label>
                  <div class="col-sm-10">
                    <input  type="text" id="nom_operateur" name="nom_operateur" value="{{ $operateur->nom_operateur }}" class="form-control" placeholder="Nom de l'opérateur">
                  </div>
                </div>
                <p id="opError" class="alert alert-danger d-none"></p>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" style="float: right;">Appliquer</button>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

<!-- operators datatable -->
<!-- <div class="container mt-5">
    <h2 class="mb-4"></h2>
    <table class="table table-bordered" id="tableOperateur">
        <thead>
            <tr>
                <th>id</th>
                <th>Nom de l'opérateur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>  -->
<script>
    $(document).ready(function() {

        $('#operateurForm').submit(function(e){
        e.preventDefault();

        var nom_operateur = $('#nom_operateur').val();
  
        var token = $("input[name='_token']").val();

        var data = {nom_operateur:nom_operateur,
                    _token:token};
        console.log(data);
        $.ajax({
            url:"{{route('operateur.create')}}",
            type: 'POST',
            data:data,
            success: function(res){
                $('#tableOperateur').DataTable().ajax.reload();
                if(res.error){
                    // $('#error').text(res.error);
                    console.log(res.error)
                    $('#opError').text(res.error);
                    $('#opError').removeClass('d-none');
                }
                if(res.success){
                  //$('#tableOperateur').DataTable().ajax.reload();
                    //window.location.href = "/";
                    //$('#opError').text('');
                    $('#nsuccess').text(res.success)
                    //location.reload();
                    console.log(res)
                    var frm = document.getElementsByName('operateurForm')[0];
                    //frm.submit(); // Submit the form
                    frm.reset();  // Reset all form data
                   // return false; // Prevent page refresh

                  
                }
                console.log(res)
            }
            })
        });

    });
</script>

@endsection
