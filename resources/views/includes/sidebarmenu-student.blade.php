<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
  
        <li class="nav-item">
            <router-link :to="{ name: 'student-dashboard'}" class="nav-link " >
                <i class="nav-icon fas fa-tachometer-alt icon-vividorange"></i>
                    <p>
                    Dashboard
                    </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{ name: 'admin-users'}" class="nav-link">
              <i class="fas fa-id-card nav-icon icon-strongblue"></i>
              <p>Profile</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'student-myenroll'}" class="nav-link">
              <i class="fas fa-calendar-check nav-icon icon-green"></i>
              <p>Enroll Now</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'admin-studentlist'}" class="nav-link">
              <i class="fas fa-calendar-alt nav-icon icon-cyan"></i>
              <p>Class Schedule</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'admin-studentlist'}" class="nav-link">
              <i class="fab fa-stack-exchange nav-icon icon-pink"></i>
              <p>My Grades</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'admin-studentlist'}" class="nav-link">
              <i class="fas fa-wallet nav-icon icon-yellow"></i>
              <p>My Accounts</p>
            </router-link>
          </li>
        

        
            <li class="nav-item">

                
                    <a class="nav-link" href="{{ route('student.logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                  <i class="nav-icon fas fa-power-off icon-red"></i>
                                  <p>
                                      {{ __('Logout') }}
                                  </p>
                        </a>
               

                    

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                </li>
                
                You are Logged In as a <strong>{{Auth::user()->usertype}}</strong>
            
                
        </ul>
      </nav>