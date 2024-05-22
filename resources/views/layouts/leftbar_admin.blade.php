<div class="sidebar-wrapper" data-layout="stroke-svg">
  <div class="logo-wrapper">   <a href="index.html">     <h1 style="display: inline; color: white; ">LGFP</h1>   </a>
    <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a></div>
  <nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="sidebar-menu">
      <ul class="sidebar-links" id="simple-bar">
        <li class="back-btn"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a>
          <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
        </li>
        <li class="pin-title sidebar-main-title">
          <div> 
            <h6>Pinned</h6>
          </div>
        </li>
        <li class="sidebar-main-title">
          <div>
            <h6 class="lan-1">General</h6>
          </div>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="/dashboard">
            <svg class="stroke-icon">
              <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
            </svg>
            <svg class="fill-icon">
              
            </svg><span  class="lan-3" >Tableau de Bord  </span></a>
         
        </li>
        
        <li class="sidebar-main-title">
          <div>
            <h6 >GESTION</h6>
          </div>
        </li>
     
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
          <svg class="stroke-icon">
            <use href="../assets/svg/icon-sprite.svg#stroke-project"></use>
            
          </svg>
          <svg class="fill-icon">
            <use href="../assets/svg/icon-sprite.svg#fill-project"></use>
          </svg><span>Joueur </span></a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('joueurs.create') }}">Créer un joueur</a></li>
          <li><a href="{{ route('joueurs.index') }}">Liste des joueurs</a></li>
        </ul>
      </li>

      <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
        <svg class="stroke-icon">
          <use href="../assets/svg/icon-sprite.svg#fill-board"></use>
        </svg>
        <svg class="fill-icon">
       
          <use href="../assets/svg/icon-sprite.svg#fill-board"></use>
        </svg><span>Equipe </span></a>
      <ul class="sidebar-submenu">
        <li><a href="{{ route('equipe.create') }}">Créer une équipe</a></li>
        <li><a href="{{ route('equipe.index') }}">Liste des équipes</a></li>
      </ul>
    </li>

    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
      <svg class="stroke-icon">
        <use href="../assets/svg/icon-sprite.svg#stroke-ecommerce"></use>
      </svg>
      <svg class="fill-icon">
        <use href="../assets/svg/icon-sprite.svg#fill-ecommerce"></use>
      </svg><span>Saison </span></a>
    <ul class="sidebar-submenu">
      <li><a href="{{ route('saisons.create') }}">Créer une saison</a></li>
      <li><a href="{{ route('saison.index') }}">Liste des saisons</a></li>
    </ul>
  </li>

  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
    <svg class="stroke-icon">
      <use href="../assets/svg/icon-sprite.svg#stroke-social"> </use>
    </svg>
    <svg class="fill-icon">
      <use href="../assets/svg/icon-sprite.svg#fill-social"> </use>
    </svg><span>Match</span></a>
  <ul class="sidebar-submenu">
    <li><a href="{{ route('game.create') }}">Créer un match</a></li>
    <li><a href="{{ route('game.index') }}">Liste des matchs</a></li>
  </ul>
</li>

<li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
  <svg class="stroke-icon">
    <use href="../assets/svg/icon-sprite.svg#stroke-landing-page"></use>
  </svg>
  <svg class="fill-icon">
    <use href="../assets/svg/icon-sprite.svg#stroke-landing-page"></use>
  </svg><span>Stade </span></a>
<ul class="sidebar-submenu">
  <li><a href="{{ route('stade.create') }}">Créer un stade</a></li>
  <li><a href="{{ route('stade.index') }}">Liste des stades</a></li>
</ul>
</li>

<li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
  <svg class="stroke-icon">
    <use href="../assets/svg/icon-sprite.svg#stroke-ui-kits"></use>
  </svg>
  <svg class="fill-icon">
    <use href="../assets/svg/icon-sprite.svg#fill-ui-kits"></use>
  </svg><span>Activité </span></a>
<ul class="sidebar-submenu">
  <li><a href="{{ route('activite.create') }}">Créer un activité</a></li>
  <li><a href="{{ route('activite.index') }}">Liste des activités</a></li>
</ul>
</li>

<li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
  <svg class="stroke-icon">
    <use href="../assets/svg/icon-sprite.svg#stroke-button"></use>
    
  </svg>
  <svg class="fill-icon">
    <use href="../assets/svg/icon-sprite.svg#fill-button"></use>
  </svg><span>Transferts </span></a>
<ul class="sidebar-submenu">
  <li><a href="{{ route('joueurs.create') }}">Créer un joueur</a></li>
  <li><a href="{{ route('joueurs.index') }}">Liste des joueurs</a></li>
</ul>
</li>

        <li class="sidebar-main-title">
          <div>
            <h6>Privilèges</h6>
          </div>
        </li>

        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
          <svg class="stroke-icon">
            <use href="../assets/svg/icon-sprite.svg#stroke-user"></use>
            
          </svg>
          <svg class="fill-icon">
            <use href="../assets/svg/icon-sprite.svg#fill-user"></use>
          </svg><span>Utilisateurs </span></a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('admin.create') }}">Créer un Gérant d'équipe</a></li>
          <li><a href="{{ route('admin.index') }}">Liste des utilisateurs</a></li>
          <li><a href="{{ route('admin.transferts') }}">transferts</a></li>
        </ul>
      </li>
       
       
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</div>