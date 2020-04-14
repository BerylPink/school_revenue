
	<!-- BEGIN .app-wrap -->
	<div class="app-wrap">
		<!-- BEGIN .app-heading -->
		<header class="app-header">
			<div class="container-fluid">
				<div class="row gutters">
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
						<a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
							<i class="icon-menu5"></i>
						</a>
						<a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
							<i class="icon-chevron-thin-left"></i>
						</a>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-4">
						<a href="#" class="logo ml-4 mt-3">
							{{-- <img src="{{ asset('assets/img/logo.png') }}" height="32px"> --}}
							<h3 style="font-size: 1.4rem; !important">School Revenue</h3>
						</a>
					</div>
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
						<ul class="header-actions">
							<li class="dropdown">
								<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
									@if($user->profile_avatar != 'default_avatar.png')
										<img class="avatar" src="{{ asset('uploads/'.$user->profile_avatar) }}" alt="User Thumb" />
									@else
										<img class="avatar" src="{{ asset('assets/img/default_avatar.png') }}" alt="User Thumb" />
									@endif
									
								<span class="user-name">{{ $user->firstname.' '.$user->lastname }}</span>
									<i class="icon-chevron-small-down"></i>
								</a>
								<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
									<ul class="user-settings-list">
										<li>
											<a href="#">
												<div class="icon">
													<i class="icon-account_circle"></i>
												</div>
												<p>Profile</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="icon red">
													<i class="icon-cog3"></i>
												</div>
												<p>Settings</p>
											</a>
										</li>
										<li>
											<a href="filters.html">
												<div class="icon yellow">
													<i class="icon-schedule"></i>
												</div>
												<p>Activity</p>
											</a>
										</li>
									</ul>
									<div class="logout-btn">
									<a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<!-- END: .app-heading -->
		<!-- BEGIN .app-container -->
		<div class="app-container">
			<!-- BEGIN .app-side -->
			<aside class="app-side fixed is-open" id="app-side">
				<!-- BEGIN .side-content -->
				<div class="side-content ">
					<!-- BEGIN .user-profile -->
					<div class="user-profile">
						 @if($user->profile_avatar != 'default_avatar.png')
							<img class="profile-thumb" src="{{ asset('uploads/'.$user->profile_avatar) }}" alt="User Thumb" />
						@else
							<img class="profile-thumb" src="{{ asset('assets/img/default_avatar.png') }}" alt="User Thumb" />
						@endif
					<h6 class="profile-name">{{ $user->firstname.' '.$user->lastname }}</h6>
						<br>
						<a href="#">
							<i class="icon-email"></i><br>
						<span>{{ $user->email }}</span>
						</a>
					
					</div>
					<!-- END .user-profile -->
					<!-- BEGIN .side-nav -->
					<nav class="side-nav">
						<!-- BEGIN: side-nav-content -->
						<ul class="unifyMenu" id="unifyMenu">

							<li class="{{ Route::currentRouteNamed('superadmins.index') ? 'active selected' : '' }}">
							<a href="{{ route('superadmins.index') }}">
									<span class="has-icon">
										<i class="icon-laptop_windows"></i>
									</span>
									<span class="nav-title">Dashboard</span>
								</a>
							</li>
					
							<li class="{{ Route::currentRouteNamed('admins.index', 'admins.create', 'admins.show', 'admins.edit', 'human-resource.index', 'human-resource.create', 'human-resource.show', 'human-resource.edit','superadmins.list', 'superadmins.show') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-users"></i>
									</span>
									<span class="nav-title">Users</span>
								</a>
								<ul aria-expanded="false" class="collapse">	
									@if($user->user_role == 1)								
									<li>
									<a class="{{ Route::currentRouteNamed('admins.index') ? 'current-page' : '' }}" href="{{ route('admins.index') }}">Admin</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('human-resource.index', 'human-resource.create', 'human-resource.show', 'human-resource.edit') ? 'current-page' : '' }}" href="{{ route('human-resource.index') }}">Human Resource</a>
									</li>
									@endif
									<li>
										<a href="">Academic Staff</a>
									</li>
									<li>
										<a href="">Non-Academic Staffs</a>
									</li>
									<li>
										<a href="">Student</a>
									</li>
									@if($user->user_role == 1)								
									<li class="{{ Route::currentRouteNamed('superadmins.list') ? 'active selected' : '' }}">
									<a class="{{ Route::currentRouteNamed('superadmins.list', 'superadmins.show') ? 'current-page' : '' }}" href="{{ route('superadmins.list') }}">Super Admin</a>
									</li>
									@endif
								</ul>
							</li>
							<li class="{{ Route::currentRouteNamed('colleges.index', 'colleges.create') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-office"></i>
									</span>
									<span class="nav-title">Colleges</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a class="{{ Route::currentRouteNamed('colleges.create') ? 'current-page' : '' }}" href="{{ route('colleges.create') }}">Add</a>
									</li>
									<li>
									<a class="{{ Route::currentRouteNamed('colleges.index') ? 'current-page' : '' }}" href="{{ route('colleges.index') }}">List</a>
									</li>
								</ul>
							</li>
							<li class="{{ Route::currentRouteNamed('departments.index', 'departments.create') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-books"></i>
									</span>
									<span class="nav-title">Departments</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
									<a class="{{ Route::currentRouteNamed('departments.create') ? 'current-page' : '' }}" href="{{ route('departments.create') }}">Add</a>
									</li>
									<li>
										<a href="">List</a>
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-credit-card"></i>
									</span>
									<span class="nav-title">Payments</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a href="">List</a>
									</li>
									<li>
										<a href="">Option 1</a>
									</li>
									<li>
										<a href="">Option 2</a>
									</li>
								</ul>
							</li>
						</ul>
						<!-- END: side-nav-content -->
					</nav>
					<!-- END: .side-nav -->
				</div>
				<!-- END: .side-content -->
			</aside>
			<!-- END: .app-side -->

			<!-- BEGIN .app-main -->
			<div class="app-main">
					@yield('content')
			</div>
			<!-- END: .app-main -->
		</div>
		<!-- END: .app-container -->

