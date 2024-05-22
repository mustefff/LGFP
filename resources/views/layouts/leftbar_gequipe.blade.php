<div class="sidebar-wrapper" data-layout="stroke-svg">
  <div class="logo-wrapper">   <a href="index.html">     <h1 style="display: inline; color: white; ">LGFP</h1>   </a>
    <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
  <nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="sidebar-menu">
      <ul class="sidebar-links" id="simple-bar">
        <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo-icon.png')}}" alt=""></a>
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
        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="/gequipe">
            <svg class="stroke-icon">
              <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
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
            <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-project')}}"></use>
            
          </svg>
          <svg class="fill-icon">
            <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-project')}}"></use>
          </svg><span>Joueur </span></a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('mjoueurs.index') }}">Ajouter details des joueurs</a></li>
          <li><a href="{{ route('mjoueurs.getAllInfo') }}">Liste des joueurs</a></li>
        </ul>
      </li>

      <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
        <svg class="stroke-icon">
          <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-board')}}"></use>
        </svg>
        <svg class="fill-icon">
       
          <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-board')}}"></use>
        </svg><span>Transfert </span></a>
      <ul class="sidebar-submenu">
        <li><a href="{{ route('mjoueurs.showTransfertForm') }}">Effectuer un transfert</a></li>
        <li><a href="{{ route('mjoueurs.receivedTransferts') }}">Nouvelles propositions</a></li>
        <li><a href="{{ route('mjoueurs.sentTransferts') }}">Transferts en attente</a></li>

      </ul>
    </li>
   
    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
      <svg class="stroke-icon">
        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-ecommerce')}}"></use>
      </svg>
      <svg class="fill-icon">
        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-ecommerce')}}"></use>
      </svg><span>L'équipe</span></a>
    <ul class="sidebar-submenu">
      <li><a href="">Performances </a></li>
      <li><a href="">Ajouter details</a></li>
    </ul>
  </li>

  







       
        
       
       
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</div>