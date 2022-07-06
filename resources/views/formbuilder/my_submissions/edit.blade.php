@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-0">
              <form action="{{ route('form.update') }}" method="POST" id="submitForm" enctype="multipart/form-data">
              @csrf 
                 <div class="card-header">

                    <h5 class="card-title">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="name" class="col-form-label">Form Name</label>
                              <!--      <label for="name" class="col-form-label">{{ $submission->name}}</label> -->

                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $submission->name}}" required autofocus placeholder="{{ $submission->name}}" readonly="true">

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visibility" class="col-form-label">Form Visibility</label>

                                    <select name="visibility" id="visibility" class="form-control" required="required">
                                        <option value="">Select Form Visibility</option>
                                        @foreach(jazmy\FormBuilder\Models\Form::$visibility_options as $option)
                                            <option value="{{ $option['id'] }}"   <?php if ($submission->visibility ==  $option['id']) echo "selected='selected'";?> >{{ $option['name'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('visibility'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('visibility') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fiche" class="col-form-label">Fiche Visibility</label>

                                    <select name="fiche" id="fiche" class="form-control"  disabled="true">
                                        
                                        @foreach($fiches as $fiche)
                                            <option value="{{ $fiche->id}}"   <?php if ($submission->id ==  $fiche->id) echo "selected='selected'";?> >{{ $fiche->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('fiches'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('visibility') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-4" style="display: none;" id="allows_edit_DIV">
                                <div class="form-group">
                                    <label for="allows_edit" class="col-form-label">
                                        Allow Submission Edit
                                    </label>

                                    <select name="allows_edit" id="allows_edit" class="form-control" required="required">
                                        <option value="0">NO (submissions are final)</option>
                                        <option value="1">YES (allow users to edit their submissions)</option>
                                    </select>

                                    @if ($errors->has('allows_edit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('allows_edit') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

       
                    </div>

                        

                  <!--      <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary float-md-right btn-sm" title="Back To My Submissions">
                            <i class="fa fa-arrow-left"></i> 
                        </a> -->
                    </h5>
                 </div>

                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div id="fb-render"></div>
                        <script src="{{ asset('assetstemp/js/formeo.min.js')}}"></script> 
                            <script>

                             opt = <?php echo ($submission->formJson); ?>;


                            </script> 
                            
                                   
                    </div>

                    <div class="card-footer">
                   <!-- <button type="submit" class="btn btn-primary confirm-form" data-form="submitForm" data-message="Submit update to your entry for '{{ $submission->name }}'?">
                            <i class="fa fa-submit"></i> Submit Form
                        </button> -->
                    </div>
                </form>
                <script>
                                var id_form=  <?php echo ($submission->id); ?>;
                                var fiche=  <?php echo ($id); ?>;
                                    var formeo = new FormeoEditor({
                                    editorContainer: '#fb-render',
                                    events: {
                                    onSave: function(e) {
                                    console.log(e.formData);
                                    
                                    var name = $("input[name='name']").val();
                                    var token = $("input[name='_token']").val();
                                    var visibility = $("select[name='visibility']").val();
                                    var formJson = JSON.stringify(e.formData); 
                                    //var id_form=id_form;
                                    var data = {id:e.formData.id, 
                                        id_form:id_form,
                                        formJson:formJson,
                                         name:name, 
                                         visibility:visibility,_token:token};
                                    console.log(data);
                                    console.log(fiche);

                                    $.ajax({
                                        url:"{{route('form.update')}}",
                                        type: 'POST',
                                        data:data,
                                        success: function(res){
                                            if(res.error){
                                            }
                                            if(res.success){
                                                window.location.assign ("/form-builder/forms/"+ fiche);
                                                //window.location.reload (""); -> refrech the page
                                                //window.confirm(name+ " a été mis a jour avec succés")
                                            }
                                        }
                                        })

                                     }},
                                    svgSprite: 'https://draggable.github.io/formeo/assets/img/formeo-sprite.svg',
                                    dataType: 'json'
                                    },opt);
                                    </script>
            </div>
        </div>
    </div>
</div>
@endsection


