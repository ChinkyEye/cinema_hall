<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image pt-1">
        @php 
        $auth_name = Auth::user()->name.' '.Auth::user()->last_name; 
        preg_match_all('/(?<=\s|^)[a-z]/i', $auth_name, $matches); 
        @endphp
        <span class="border border-light rounded-circle py-1 {{count($matches[0]) == 1 ? 'px-2' : 'px-'.(3-count($matches[0]))}} bg-success text-light text-capitalize elevation-3">{{strtoupper(implode('', $matches[0]))}}</span>
      </div>
      <div class="info">
        <a href="{{route('user.home')}}" class="d-block">{{Auth::user()->name.' '.Auth::user()->middle_name.' '.Auth::user()->last_name}}</a>
      </div>
    </div>
    <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
          <a href="{{ route('user.movie.index')}}" class="nav-link {{ (request()->is('user/task*')) ? 'active' : '' }}">
            <i class="fas fa-film"  aria-hidden="true"></i>
            <p>Movies</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>