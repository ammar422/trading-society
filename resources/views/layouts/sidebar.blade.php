  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="{{ route('instructor.dashboard') }}">
              <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
          </a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('instructor.dashboard') }}"><img
                  src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
      </div>
      <ul class="nav">
          <li class="nav-item profile">
              <div class="profile-desc">
                  <div class="profile-pic">
                      <div class="count-indicator">
                          <img class="img-xs rounded-circle " src="{{ asset("assets/images/faces/face15.jpg") }}" alt="">
                          <span class="count bg-success"></span>
                      </div>
                      <div class="profile-name">
                          <h5 class="mb-0 font-weight-normal">name</h5>
                          <span>email</span>
                      </div>
                  </div>

              </div>
          </li>
          <li class="nav-item nav-category">
              <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
              <a class="nav-link" href="{{ route('course.create') }}">
                  <span class="menu-icon">
                      <i class="mdi mdi-speedometer"></i>
                  </span>
                  <span class="menu-title">Add New Course</span>
              </a>
          </li>
          <li class="nav-item menu-items">
              <a class="nav-link" href="index.html">
                  <span class="menu-icon">
                      <i class="mdi mdi-trophy-variant-outline"></i>
                  </span>
                  <span class="menu-title">Add New Level</span>
              </a>
          </li>
          <li class="nav-item menu-items">
              <a class="nav-link" href="index.html">
                  <span class="menu-icon">
                      <i class="mdi mdi-file-document"></i>
                  </span>
                  <span class="menu-title">Add New Deal Post</span>
              </a>
          </li>
      </ul>
  </nav>
  <!-- partial -->
