<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{url('/')}}">{{ Auth::user()->name }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{url('/')}}">{{ Auth::user()->name }}</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Daftar Website</li>
        <li class="dropdown">
          <a href="{{url('/dashboard')}}" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
          <a href="{{url('/projects')}}" class="nav-link"><i class="fas fa-cog"></i><span>Projects</span></a>
          <a href="{{url('/tasks')}}" class="nav-link"><i class="fas fa-users"></i><span>Tasks</span></a>
        </li>
    </ul>

      </aside>
  </div>