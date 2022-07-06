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
         


</script> 

                             
                        
                        
                              
                                <form action="" method="" id="form" class="d-inline-block">
                                    @csrf 
                                    <div id="fb-render"> </div>
                                    <!-- <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group" aria-label="First group">
                                <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary btn-sm" title="Back To My Submissions">
                                    <i class="fa fa-arrow-left"></i> 
                                </a>
                                </div>
                        </div> -->
                        <div>

                                    <button type="button" id="btn" class="btn btn-danger btn-sm rounded-0 confirm-form" onclick="send()" title="Delete this submission?">
                                        <i class=""></i> Submit 
                                    </button>
    </div>
                                </form> 
                           
                    </h5>
                    
                    <script>
        var formeo = new FormeoRenderer({
		renderContainer: '#fb-render',
		  svgSprite: 'https://draggable.github.io/formeo/assets/img/formeo-sprite.svg',
		  dataType: 'json',
		});
 formeo.render(opt);
</script> 
                </div>

           
            </div>
        </div>

        
    </div>
</div>
@endsection

<script>
function send()
{
var btn=document.getElementById('form');
/*btn.addEventListener('click', function(e){
   console.log(e);
});*/
console.log(opt);

}
</script>