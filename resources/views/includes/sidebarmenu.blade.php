<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
        <li class="nav-item">
            <router-link :to="{ name: 'admin-dashboard'}" class="nav-link " >
                <i class="nav-icon fas fa-tachometer-alt icon-yellow"></i>
                    <p>
                    Dashboard
                    </p>
            </router-link>
        </li>
        {{-- @can('isSuperAdmin') --}}
        <li class="nav-item">
          <router-link :to="{ name: 'admin-users'}" class="nav-link">
            <i class="fas fa-users nav-icon icon-indigo"></i>
            <p>Staff User Accounts</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-instructors'}" class="nav-link">
            <i class="fas fa-chalkboard-teacher nav-icon icon-pink"></i>
            <p>Instructor User Accounts</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-studentlist'}" class="nav-link">
            <i class="fas fa-address-card nav-icon icon-vividorange"></i>
            <p>Student User Accounts</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-studentinfo'}" class="nav-link">
            <i class="fas fa-address-card nav-icon icon-indigo"></i>
            <p>Student Personal Information</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-managenroll'}" class="nav-link">
            <i class="fas fa-archive nav-icon icon-cyan"></i>
            <p>Manage Enrollment</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-manageprogram'}" class="nav-link">
            <i class="fas fa-tasks nav-icon icon-green"></i>
            <p>Manage Program</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-managecourses'}" class="nav-link">
            <i class="fas fa-clipboard-list nav-icon icon-blue"></i>
            <p>Manage Courses</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-managecurriculum'}" class="nav-link">
            <i class="fas fa-table nav-icon icon-teal"></i>
            <p>Manage Curriculum</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-manageassesstment'}" class="nav-link">
            <i class="fas fa-file-invoice nav-icon icon-teal"></i>
            <p>Manage Assesstment</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-managepayment'}" class="nav-link">
            <i class="fas fa-receipt nav-icon icon-teal"></i>
            <p>Manage Payment</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'admin-settings'}" class="nav-link">
            <i class="fas fa-cogs nav-icon icon-white"></i>
            <p>Other Settings</p>
          </router-link>
        </li>
          {{-- <li class="nav-item">
            <router-link to="/developer" class="nav-link">
                <i class="nav-icon fas fa-cogs icon-pink"></i>
                    <p>
                    Developer
                    </p>
            </router-link>
          </li> --}}
        {{-- @endcan --}}

        
            <li class="nav-item">

                @if ((Auth::user()->usertype) == 'superadmin')
                    <a class="nav-link" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                              <i class="nav-icon fas fa-power-off icon-red"></i>
                              <p>
                                  {{ __('Logout') }}
                              </p>
                    </a>
                @elseif ((Auth::user()->usertype)== 'student')
                    <a class="nav-link" href="{{ route('student.logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                  <i class="nav-icon fas fa-power-off icon-red"></i>
                                  <p>
                                      {{ __('Logout') }}
                                  </p>
                        </a>
                @endif

                    

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                </li>
                @if ((Auth::user()->usertype) !== 'superadmin' && 
                (Auth::user()->usertype) !== 'registrar' && 
                (Auth::user()->usertype) !== 'cashier' && 
                (Auth::user()->usertype) !== 'assestment' &&
                (Auth::user()->usertype) !== 'student')
                
                {{Auth::user()->usertype}}
                @else
                You are Logged In as a <strong>{{Auth::user()->usertype}}</strong>
                @endif
                
        </ul>
      </nav>