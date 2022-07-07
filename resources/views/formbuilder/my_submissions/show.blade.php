@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                    Affichage de  soumission pour le formulaire
                        <strong>{{ $submission->name }}</strong>
                        
                       <script src="{{ asset('assetstemp/js/formeo.min.js')}}"></script> 
                        <script>

         opt = <?php echo ($submission->formJson); ?>;
         console.log(opt.id); 
         


</script> 

                             
                        
                        
                              
                                <form action="" method="POST" id="form" class="d-inline-block">
                                    @csrf 
                                    <div id="fb-render"> </div>
                                    <div>
                                        <button type="submit" id="btn" class="btn btn-danger btn-sm rounded-0 confirm-form save-form" onclick="send()" >
                                            <i class=""></i> Submit 
                                        </button>
                                   </div>
                                </form>                                                
                    <script>
                        btn=document.querySelector('#btn').addEventListener('click', onUpdate);
                    </script>
                    <script>
                         formeo = new FormeoRenderer({
                         renderContainer: '#fb-render',
                         svgSprite: 'https://draggable.github.io/formeo/assets/img/formeo-sprite.svg',
                         dataType: 'json',
                         });
                        formeo.render(opt); 
                        //  const formeo = new Formeo({
                        //  renderContainer: '#fb-render',
                        // svgSprite: 'https://draggable.github.io/formeo/assets/img/formeo-sprite.svg',
                        //  dataType: 'json',
                        //  });
                        // console.log(f);
                      
                         
                </script> 
              </h5>
        
            </div>

           
            </div>
        </div>

        
    </div>
</div>
<div id="test" ></div>
@endsection

<script>
function send()
{
   
    var token = $("input[name='_token']").val();
    
    $.ajax({
                                        url:"{{route('form.submission')}}",
                                        type: 'POST',
                                        data:{ id:opt.id
                                        formJson:opt,
                                        _token:token,},
                                        success: function(res){
                                            if(res.error){
                                               
                                            }
                                            if(res.success){
                                                //window.location (name + " a été enregister dans la bd avec succée");
                                            console.log(res.success);
                                            }
                                        }
                                    });

}
</script>