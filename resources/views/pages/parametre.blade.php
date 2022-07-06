@extends('formbuilder::layout')

@section('content')
    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Paramètres</button>
                </li>


              </ul>
              <div class="tab-content pt-2">


                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{route('parametres', ['id'=>$parametres->id])}}" method="POST" class="section contact" enctype="multipart/form-data">
                  @csrf
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Logo Upload</label>
                      <div class="col-md-8 col-lg-9">
                        <?php
                            $parametres = App\Models\Parametre::first();
                        ?>
                        <img src="{{asset('storage/parametre/'.$parametres->logo)}}" alt="Profile">
                        <div class="pt-2">
                            <!-- -->
                            <!-- <label for="inputNumber" class="col-sm-2 col-form-label">Logo Upload</label> -->
                            <input class="form-control"type="file" id="logo" name="logo" accept=".jpg, .jpeg, .png, .gif" class="dropify" data-default-file="{{asset('storage/parametre/'.$parametres->logo)}}"/>  
                                                  
                            <!-- -->


                            
                          <!-- <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  @endsection

 
