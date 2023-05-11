<?php $session = session(); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('/webAssets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SEEK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/webAssets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=session()->get('fname');?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/dashboard" class="nav-link <?= $nav=='dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('country') }}" class="nav-link <?= $nav=='country' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Country
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('language') }}" class="nav-link <?= $nav=='language' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Language
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('religion') }}" class="nav-link <?= $nav=='religion' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Religion
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category') }}" class="nav-link <?= $nav=='category' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Profile Category
              </p>
            </a>
          </li>

          <li class="nav-item <?= ($nav=='question' || $nav=='information') ? 'menu-is-opening menu-open' : '' ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Category Question
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: <?= ($nav=='question' || $nav=='information') ? 'block' : 'none' ?>;" >
            <li class="nav-item">
            <a href="{{ route('question') }}" class="nav-link <?= $nav=='question' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Questions
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('information') }}" class="nav-link <?= $nav=='information' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>Questions Information</p>
            </a>
          </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('answer') }}" class="nav-link <?= $nav=='answer' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Category Answers
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>