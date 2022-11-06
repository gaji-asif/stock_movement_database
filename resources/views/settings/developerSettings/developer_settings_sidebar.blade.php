<div class="sidenavs-10 sidenav sidenav-vertical d-inline-flex bg-white">
	<ul class="sidenav-inner" style="margin-left: 0px !important;">
		
		<!-- <li class="sidenav-divider mt-0"></li> -->
		<li class="sidenav-item open">

          <a href="javascript:void(0)" class="sidenav-link sidenav-toggle  {{ (request()->is('assign/*')) ? 'menu_parent_bg' : '' }} {{ (request()->is('timezone')) ? 'menu_parent_bg' : '' }} {{ (request()->is('assign_student/*')) ? 'menu_parent_bg' : '' }} {{ (request()->is('assign')) ? 'menu_parent_bg' : '' }}">
            <i class="sidenav-icon ion"><img src="{{asset('images/icon_4.png')}}"></i>
            <div class="menu_li_heading">Basic Settings</div>
          </a>
          <ul class="sidenav-menu sidenav_menu_custom">
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('assign')}}" class="sidenav-link {{ (request()->is('assign/*')) ? 'actives' : '' }} {{ (request()->is('assign_student/*')) ? 'actives' : '' }} {{ (request()->is('assign')) ? 'actives' : '' }} ">
                <div>Assign Students To Admission Officer</div>
              </a>
            </li>
           <!--  <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('category')}}" class="sidenav-link {{ (request()->is('category')) ? 'actives' : '' }}">
                <div>Category</div>
              </a>
            </li>
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('priorityss')}}" class="sidenav-link {{ (request()->is('priority')) ? 'actives' : '' }}  {{ (request()->is('priority/create')) ? 'actives' : '' }}">
                <div>Priority</div>
              </a>
            </li>
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('statuss')}}" class="sidenav-link {{ (request()->is('status')) ? 'actives' : '' }}  {{ (request()->is('status/create')) ? 'actives' : '' }}">
                <div>Status</div>
              </a>
            </li>
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('timezone.index')}}" class="sidenav-link {{ (request()->is('timezone')) ? 'actives' : ''}}">
                <div>Timezone</div>
              </a>
            </li>
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('notice.index')}}" class="sidenav-link {{ (request()->is('notice')) ? 'actives' : ''}}">
                <div>Notice</div>
              </a>
            </li>  -->
          </ul>
        </li>

		<li class="sidenav-item open">
			<a href="javascript:void(0)" class="sidenav-link sidenav-toggle  {{ (request()->is('settings-users')) || (request()->is('settings-facility-types')) || (request()->is('settings-template'))  ? 'menu_parent_bg' : '' }} {{ (request()->is('settings-teams')) ? 'menu_parent_bg' : '' }}">
				<i class="sidenav-icon ion"><img src="{{asset('images/icon_2.png')}}"></i>
				<div class="menu_li_heading">User Settings</div>
			</a>

			<ul class="sidenav-menu sidenav_menu_custom">
				<li class="sidenav-item mb-1">
					<a href="{{route('settings-users.index')}}" class="sidenav-link {{ (request()->is('settings-users')) ? 'actives' : ''}}">
						<div>Users</div>
					</a>
				</li>
        @if(Session::get('role') == '0')
          <li class="sidenav-item mb-1">
            <a href="{{route('settings-facility-types.index')}}" class="sidenav-link {{ (request()->is('settings-facility-types')) ? 'actives' : ''}}">
              <div>Facility Types</div>
            </a>
          </li>
          <li class="sidenav-item mb-1">
            <a href="{{route('settings-template.index')}}" class="sidenav-link {{ (request()->is('settings-template')) ? 'actives' : ''}}">
              <div>Templete</div>
            </a>
          </li>
        @endif
        
			</ul>
		</li>

    </ul>
</div>
