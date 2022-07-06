<!-- NEW Sidebar-->

<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="/dashboard">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  @if (auth()->check() && auth()->user()->role ===1 || auth()->user()->role ===2 )
  <li class="nav-item">
    <a class="nav-link collapsed" href="/admins">
    <i class="bi bi-person"></i>
      <span>Gestion des utilisateurs</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="/operateurs">
    <i class="bi bi-person-plus"></i>
      <span>Gestion des opérateurs</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="/form-builder/fiches">
    <i class="bi bi-pencil-square"></i>
      <span>Fiches</span>
    </a>
  </li>  
  <li class="nav-item">
    <a class="nav-link collapsed" href="/form-builder/forms/create">
    <i class="bi bi-plus-square"></i>
      <span>Création de Formulaire</span>
    </a>
  </li>  
  <li class="nav-item">
    <a class="nav-link collapsed" href="/form-builder/my-submissions">
    <i class="bi bi-send"></i>
      <span>Soumissions</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('parametres.page')}}">
    <i class="bi bi-gear"></i>
      <span>Paramêtres</span>
    </a>
  </li>
  <!-- End Dashboard Nav -->
  @elseif (auth()->check() && auth()->user()->role ===3)

  <li class="nav-item">
    <a class="nav-link collapsed" href="/form-builder/forms">
    <i class="bi bi-pencil-square"></i>
      <span>Formulaires</span>
    </a>
  </li>  
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="/form-builder/forms/create">
    <i class="bi bi-plus-square"></i>
      <span>Création de Formulaire</span>
    </a>
  </li>   -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="/form-builder/my-submissions">
    <i class="bi bi-send"></i>
      <span>Soumissions</span>
    </a>
  </li>
  @endif

</ul>

</aside>