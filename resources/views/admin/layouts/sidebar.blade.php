  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset("adminlte/dist/img/logoheuvel.png") }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin Heuvel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset("adminlte/dist/img/user2-160x160.jpg") }}" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ auth()->user()->name }}</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
               @if (auth()->user()->role == 'admin')
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <p>
                              All Data
                          </p>
                      </a>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Data Master
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('karyawan.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Data Karyawan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('tunjangan.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Data Tunjangan</p>
                              </a>
                          </li>
                      </ul>
                  </li>


                  <li class="nav-item">
                      <a href="{{ route('kehadiran.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Data Kehadiran
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('hutang.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-money-bill"></i>
                          <p>
                              Data Hutang
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('gaji.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-money-check"></i>
                          <p>
                              Data Gaji
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('angsuran.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-money-bill"></i>
                          <p>
                              Data Angsuran
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <p>
                              Menu
                          </p>
                      </a>
                  <li class="nav-item">
                      <a href="{{ route('admin.logout') }}" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
              @else
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ route('kehadiran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data Kehadiran
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ route('hutang.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Data Hutang
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ route('gaji.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>
                                Data Gaji
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ route('angsuran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Data Angsuran
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Menu
                            </p>
                        </a>
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
              @endif
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>