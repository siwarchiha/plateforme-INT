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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Aperçu</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editer le profil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link {{ $active_class ?? ''}}" data-bs-toggle="tab" data-bs-target="#profile-change-password">Changer le mot de passe</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Détails du profil</h5>
                @if ( auth()->check() )
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom d'utilisateur</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                  </div>

                   <div class="row">
                    <div class="col-lg-3 col-md-4 label">Opérateur</div>
                      <?php 
                         
                          $data = App\Models\Operateur::where('id',Auth::user()->operateur_id)->get();
                          
                      ?>
                                          
                    <div class="col-lg-9 col-md-8">
                      @foreach ($data as $d)
                          {{ $d->nom_operateur }}
                      @endforeach

                      @auth
                        @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                            @php
                                echo 'Aucun'
                            @endphp
                        @endif
                      @endauth
                    </div>
                    
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                  </div>
                @endif

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="editForm" action="{{ route('user.update',  ['id'=>Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom d'utilisateur</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" maxlength="30" placeholder="username">
                      </div>
                    </div>

                    
                    @auth
                        @if(Auth::user()->role == 3)
          
                        <div class="row mb-3">
                          <label for="Nom_operateur" class="col-md-4 col-lg-3 col-form-label">Opérateur</label>
                          <div class="col-md-8 col-lg-9">
                          
                            <!-- <input type="text" class="form-control" value="{{ Auth::user()->nom_operateur }}" id='nom_operateur' name='nom_operateur' placeholder="Nom de l'opérateur"> -->
                            <select class="form-select mb-3" value="{{ Auth::user()->operateur_id }}" id='nom_operateur' name='nom_operateur' aria-label="Default select example">
                              <option value="0" selected disabled>Choisir un opérateur</option>

                              <?php
                                  $operateurs = App\Models\Operateur::latest()->get();
                              ?>

                              @if($operateurs->count() > 0)
                                  @foreach ($operateurs as $operateur)
                                      <!-- <option value="{{$operateur->id}}">{{$operateur->nom_operateur}}</option> -->
                                      <option value="{{Auth::user()->operateur_id}}" selected>{{$operateur->nom_operateur}}</option>
                                      
                                  @endforeach
                              @endif
                          
                          </div>
                        </div>

                      @endif
                    @endauth

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input readonly type="email" class="form-control" pattern='^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$' value="{{ Auth::user()->email }}" id="email" name="email" placeholder="name@example.com">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade {{ $active_class ?? ''}} pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="{{ route('change.password') }}">
                  @csrf
                    @foreach ($errors->all() as $error)
                      <p class="text-danger">{{ $error }}</p>
                    @endforeach 

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
                      <div class="col-md-8 col-lg-9">
                        <!-- <input name="password" type="password" class="form-control" id="currentPassword"> -->
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">

                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <!-- <input name="newpassword" type="password" class="form-control" id="newPassword"> -->
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">

                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ré-entrez le nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <!-- <input name="renewpassword" type="password" class="form-control" id="renewPassword"> -->
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">

                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  @endsection

 
