
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
										@if($user->user_role == 4)
										<li>
												<a href="{{ route('students.profile') }}">
												<div class="icon">
													<i class="icon-account_circle"></i>
												</div>
												<p>Profile</p>
											</a>
										</li>
										@endif
										@if($user->user_role < 4)

										<li>
											<a href="{{ route('settings.change_password') }}">
												<div class="icon red">
													<i class="icon-cog3"></i>
												</div>
												<p>Settings</p>
											</a>
										</li>
										@endif

										{{-- <li>
											<a href="">
												<div class="icon yellow">
													<i class="icon-schedule"></i>
												</div>
												<p>Activity</p>
											</a>
										</li> --}}
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
			<aside class="app-side is-open" id="app-side">
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

							<li class="{{ Route::currentRouteNamed('superadmins.index', 'students.dashboard', 'settings.change_password') ? 'active selected' : '' }}">
							@if($user->user_role > 3)
								<a href="{{ route('students.dashboard') }}">
							@else
								<a href="{{ route('superadmins.index') }}">
							@endif
									<span class="has-icon">
										<i class="icon-laptop_windows"></i>
									</span>
									<span class="nav-title">Dashboard</span>
								</a>
							</li>

							@if($user->user_role < 4)
							{{-- Only SuperAdmins, Admins and HR can see these sidebar options--}}
							<li class="{{ Route::currentRouteNamed('') ? 'active selected' : '' }}"">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-pie-chart"></i>
									</span>
									<span class="nav-title">Advance Report</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a href="#" class="has-arrow" aria-expanded="false">
											<span class="nav-title">Activity Report</span>
										</a>
										<ul aria-expanded="false" class="collapse" style="height: 0px;">
											<li>
												<a class="#" href= "/expense-report">Expense Report</a>
											</li>
											<li>
												<a class="#" href= "/income-report">Income Report</a>
											</li>
											<li>
												<a class="#" href= "/staff-report">Staff Report</a>
											</li>
											<li>
												<a class="#" href= "/student-report">Student Report</a>
											</li>
										</ul>	
									</li>
									<li>
										<a class="#" href= "/financial-report" >Financial Report</a>
									</li>
									<li>
										<a class="#" href= "/summary-report" >Summary Report</a>
									</li>
								</ul>
							</li>

							<li class="{{ Route::currentRouteNamed('banks.index', 'banks.create', 'banks.edit') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-library"></i>
									</span>
									<span class="nav-title">Bank Details</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a class="{{ Route::currentRouteNamed('banks.create') ? 'current-page' : '' }}" href="{{ route('banks.create') }}">Add</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('banks.index') ? 'current-page' : '' }}" href="{{ route('banks.index') }}">List</a>
									</li>
								</ul>
							</li>

							<li class="{{ Route::currentRouteNamed('fee-categories.index', 'fee-categories.create', 'fee-categories.edit', 'categories.index', 'categories.create', 'categories.edit', 'expense-categories.index', 'expense-categories.create', 'expense-categories.edit', 'payment-categories.index', 'payment-categories.create', 'payment-categories.edit') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-tree"></i>
									</span>
									<span class="nav-title">Category</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a class="{{ Route::currentRouteNamed('expense-categories.index', 'expense-categories.create', 'expense-categories.edit') ? 'current-page' : '' }}" href="{{ route('expense-categories.index') }}">Expense Category</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('categories.index') ? 'current-page' : '' }}" href="{{ route('categories.index') }}">Non-Academic Staff</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('payment-categories.index', 'payment-categories.create', 'payment-categories.edit') ? 'current-page' : '' }}" href="{{ route('payment-categories.index') }}">Payment Category</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('fee-categories.index') ? 'current-page' : '' }}" href="{{ route('fee-categories.index') }}">Student Fee Category</a>
									</li>
								</ul>
							</li>

							<li class="{{ Route::currentRouteNamed('colleges.index', 'colleges.create', 'colleges.edit') ? 'active selected' : '' }}">
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

							<li class="{{ Route::currentRouteNamed('courses.index', 'courses.create', 'courses.edit') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-library_books"></i>
									</span>
									<span class="nav-title">Courses</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a class="{{ Route::currentRouteNamed('courses.create') ? 'current-page' : '' }}" href="{{ route('courses.create') }}">Add</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('courses.index') ? 'current-page' : '' }}" href="{{ route('courses.index') }}">List</a>
									</li>
								</ul>
							</li>

							<li class="{{ Route::currentRouteNamed('departments.index', 'departments.create', 'departments.edit') ? 'active selected' : '' }}">
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
										<a class="{{ Route::currentRouteNamed('departments.index') ? 'current-page' : '' }}" href="{{ route('departments.index') }}">List</a>
									</li>
								</ul>
							</li>
							<li class="{{ Route::currentRouteNamed('expenses.index', 'expenses.create', 'expenses.edit', 'expenses.show') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-calculator"></i>
									</span>
									<span class="nav-title">Expense</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									
									<li>
										<a class="{{ Route::currentRouteNamed('expenses.index', 'expenses.show', 'expenses.edit') ? 'current-page' : '' }}" href="{{ route('expenses.index') }}">All Expenses List</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('expenses.create') ? 'current-page' : '' }}" href="{{ route('expenses.create') }}">Create Expense</a>
									</li>
									
									
								</ul>
							</li>
							<li class="{{ Route::currentRouteNamed('payment-gateways.index', 'payment-gateways.create', 'payment-gateways.edit', 'payments.index', 'payments.create', 'payments.academic_list', 'payments.academic_show', 'payments.non_academic_list', 'payments.non_academic_show', 'payments.student_list') ? 'active selected' : '' }}"">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-credit-card"></i>
									</span>
									<span class="nav-title">Payments</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a class="{{ Route::currentRouteNamed('payment-gateways.index', 'payment-gateways.create', 'payment-gateways.edit') ? 'current-page' : '' }}" href="{{ route('payment-gateways.index') }}">Payment Gateway</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('payments.academic_list', 'payments.academic_show') ? 'current-page' : '' }}" href="{{ route('payments.academic_list') }}">Payments List: Aca. Staff</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('payments.non_academic_list', 'payments.non_academic_show') ? 'current-page' : '' }}" href="{{ route('payments.non_academic_list') }}">Payments List: Non-Aca. Staff</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('payments.student_list') ? 'current-page' : '' }}" href="{{ route('payments.student_list') }}">Payments List: Students</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('payments.create') ? 'current-page' : '' }}" href="{{ route('payments.create') }}">Pay Staffs</a>
									</li>
								</ul>
							</li>


							<li class="{{ Route::currentRouteNamed('admins.index', 'admins.create', 'admins.show', 'admins.edit', 'human-resource.index', 'human-resource.create', 'human-resource.show', 'human-resource.edit','superadmins.list', 'superadmins.show', 'students.index', 'students.create', 'students.edit', 'students.show', 'academics.index', 'academics.create', 'academics.show', 'academics.edit', 'nonacademics.index', 'nonacademics.create', 'nonacademics.show', 'nonacademics.edit') ? 'active selected' : '' }}">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-users"></i>
									</span>
									<span class="nav-title">Users</span>
								</a>
								<ul aria-expanded="false" class="collapse">	
									<li>
										<a class="{{ Route::currentRouteNamed('academics.index', 'academics.create', 'academics.show', 'academics.edit') ? 'current-page' : '' }}" href="{{ route('academics.index') }}">Academic Staffs</a>
									</li>
									@if($user->user_role == 1)								
									<li>
										<a class="{{ Route::currentRouteNamed('admins.index', 'admins.create', 'admins.show', 'admins.edit') ? 'current-page' : '' }}" href="{{ route('admins.index') }}">Administrators</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('human-resource.index', 'human-resource.create', 'human-resource.show', 'human-resource.edit') ? 'current-page' : '' }}" href="{{ route('human-resource.index') }}">Human Resources</a>
									</li>
									@endif									
									<li>
										<a class="{{ Route::currentRouteNamed('nonacademics.index', 'nonacademics.create', 'nonacademics.show', 'nonacademics.edit') ? 'current-page' : '' }}" href="{{ route('nonacademics.index') }}">Non-Academic Staffs</a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('students.index', 'students.create', 'students.edit', 'students.show') ? 'current-page' : '' }}" href="{{ route('students.index') }}">Students</a>
									</li>
									@if($user->user_role == 1)								
									<li class="{{ Route::currentRouteNamed('superadmins.list') ? 'active selected' : '' }}">
										<a class="{{ Route::currentRouteNamed('superadmins.list', 'superadmins.show') ? 'current-page' : '' }}" href="{{ route('superadmins.list') }}">Super Admins</a>
									</li>
									@endif
								</ul>
							</li>

							
							{{-- Student sidebar view--}}
							@else
							<li class="{{ Route::currentRouteNamed('students.update_profile_view', 'students.profile') ? 'active selected' : '' }}"">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-user"></i>
									</span>
									<span class="nav-title">User</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
									<a class="{{ Route::currentRouteNamed('settings.change_password') ? 'current-page' : '' }}" href="{{ route('settings.change_password') }}">Change Password </a>
									</li>
									<li>
										<a class="{{ Route::currentRouteNamed('students.update_profile_view') ? 'current-page' : '' }}" href="{{ route('students.update_profile_view') }}">Edit Profile </a>
									</li>
								
								</ul>
							</li>

							<li class="{{ Route::currentRouteNamed('students.payment', 'students.payment_history') ? 'active selected' : '' }}"">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-credit-card"></i>
									</span>
									<span class="nav-title">Payments</span>
								</a>
								<ul aria-expanded="false" class="collapse" style="height: 0px;">
									<li>
										<a class="{{ Route::currentRouteNamed('students.payment') ? 'current-page' : '' }}" href="{{ route('students.payment') }}">Make Payment</a>
									</li>
									<li>
									<a class="{{ Route::currentRouteNamed('students.payment_history') ? 'current-page' : '' }}" href="{{ route('students.payment_history') }}">Payment History</a>
									</li>
								</ul>
							</li>

							@endif
							
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

