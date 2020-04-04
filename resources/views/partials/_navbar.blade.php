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
						<a href="#" class="logo ml-4">
							<img src="{{ asset('assets/img/logo.png') }}" height="32px"><h3 style="font-size: 0.5rem; !important">School Revenue</h3>
						</a>
					</div>
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
						<ul class="header-actions">
							<li class="dropdown">
								<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
									<img class="avatar" src="{{ asset('assets/img/avatar2.png') }}" alt="User Thumb" />
								<span class="user-name"></span>
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
									<a href="{" class="btn btn-primary">Logout</a>
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
						<img src="{{ asset('assets/img/avatar2.png') }}" class="profile-thumb" alt="User Thumb">
						<h6 class="profile-name"></h6>
						<br>
						<a href="#">
							<i class="icon-email"></i>
							<span></span>
						</a>
					
					</div>
					<!-- END .user-profile -->
					<!-- BEGIN .side-nav -->
					<nav class="side-nav">
						<!-- BEGIN: side-nav-content -->
						<ul class="unifyMenu" id="unifyMenu">
							<li class="active selected">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-laptop_windows"></i>
									</span>
									<span class="nav-title">Dashboards</span>
								</a>
								<ul aria-expanded="true" class="collapse in">
									<li>
										<a href="index-2.html" class="current-page">Dashboard</a>
									</li>
									<li>
										<a href="dashboard2.html">CRM</a>
									</li>
									<li>
										<a href="dashboard3.html">Analytics</a>
									</li>
									<li>
										<a href="dashboard4.html">Ecommerce</a>
									</li>
									<li>
										<a href="quick-dashboard.html">Quick Dashboard</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="widgets.html">
									<span class="has-icon">
										<i class="icon-flash-outline"></i>
									</span>
									<span class="nav-title">Graph Widgets</span>
								</a>
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-adjust2"></i>
									</span>
									<span class="nav-title">Cool Features</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="filters.html">Content Filter</a>
									</li>
									<li>
										<a href="datepickers.html">Datepickers</a>
									</li>
									<li>
										<a href="map-skins.html">Gmap Skins</a>
									</li>
									<li>
										<a href="vector-maps.html">Vector Maps</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-tabs-outline"></i>
									</span>
									<span class="nav-title">Pages</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="profile.html">Profile</a>
									</li>
									<li>
										<a href="calendar.html">Calendar</a>
									</li>
									<li>
										<a href="gallery.html">Gallery</a>
									</li>
									<li>
										<a href="invoice.html">Invoice</a>
									</li>
									<li>
										<a href="timeline.html">Timeline</a>
									</li>
									<li>
										<a href="pricing.html">Pricing</a>
									</li>
									<li>
										<a href="faq.html">Faq's</a>
									</li>
								</ul>
							</li>
							<li class="menu-header">
								-- Layout Options
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-layers"></i>
									</span>
									<span class="nav-title">Layouts</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="custom-drag.html">Drag &amp; Drop</a>
									</li>
									<li>
										<a href="layout.html">Default Layout</a>
									</li>
									<li>
										<a href="layout-range-date-header.html">Layout Date Range</a>
									</li>
									<li>
										<a href="fixed-sidebar.html">Fixed Sidebar</a>
									</li>
									<li>
										<a href="layout-logo-left.html">Logo on Left</a>
									</li>
									<li>
										<a href="dark-header.html">Dark Header</a>
									</li>
									<li>
										<a href="dark-sidebar.html">Dark Sidebar</a>
									</li>
									<li>
										<a href="rtl.html">RTL Layout</a>
									</li>
									<li>
										<a href="boxed.html">Boxed Layout</a>
									</li>
									<li>
										<a href="boxed-rtl.html">Boxed RTL Layout</a>
									</li>
									<li>
										<a href="boxed-slim-sidebar.html">Boxed Slim Sidebar</a>
									</li>
									<li>
										<a href="boxed-slim-rtl.html">Boxed Slim RTL</a>
									</li>
									<li>
										<a href="slim-sidebar.html">Slim Sidebar</a>
									</li>
									<li>
										<a href="slim-sidebar-rtl.html">Slim Sidebar RTL</a>
									</li>
									<li>
										<a href="offcanvas.html">Offcanvas Layout</a>
									</li>
									<li>
										<a href="offcanvas-rtl.html">Offcanvas RTL Layout</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="comments.html">
									<span class="has-icon">
										<i class="icon-chat_bubble_outline"></i>
									</span>
									<span class="nav-title">Comments</span>
								</a>
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-chart-area-outline"></i>
									</span>
									<span class="nav-title">Graphs</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="c3-graphs.html">C3 Graphs</a>
									</li>
									<li>
										<a href="flot.html">Flot Graphs</a>
									</li>
									<li>
										<a href="morris.html">Morris Graphs</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-center_focus_strong"></i>
									</span>
									<span class="nav-title">Forms</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="form-inputs.html">Form Inputs</a>
									</li>
									<li>
										<a href="input-groups.html">Inputs Groups</a>
									</li>
									<li>
										<a href="checkbox-radio.html">Checkbox &amp; Radio</a>
									</li>
								</ul>
							</li>
							<li class="menu-header">
								-- UI Elements
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-beaker"></i>
									</span>
									<span class="nav-title">UI Elements</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="general-elements.html">General Elements</a>
									</li>
									<li>
										<a href="buttons.html">Buttons</a>
									</li>
									<li>
										<a href="tabs.html">Tabs</a>
									</li>
									<li>
										<a href="modals.html">Modals</a>
									</li>
									<li>
										<a href="accordion.html">Accordion</a>
									</li>
									<li>
										<a href="labels-badges.html">Labels &amp; Badges</a>
									</li>
									<li>
										<a href="notifications.html">Notifications</a>
									</li>
									<li>
										<a href="carousel.html">Carousels</a>
									</li>
									<li>
										<a href="list-items.html">List Items</a>
									</li>
									<li>
										<a href="cards.html">Cards</a>
									</li>
									<li>
										<a href="navbars.html">Navbars</a>
									</li>
									<li>
										<a href="popovers-tooltips.html">Popovers &amp; Tooltips</a>
									</li>
									<li>
										<a href="typography.html">Typography</a>
									</li>
									<li>
										<a href="icons.html">Icons</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="tables.html">
									<span class="has-icon">
										<i class="icon-border_outer"></i>
									</span>
									<span class="nav-title">Tables</span>
								</a>
							</li>
							<li>
								<a href="datatables.html">
									<span class="has-icon">
										<i class="icon-border_all"></i>
									</span>
									<span class="nav-title">Data Tables</span>
								</a>
							</li>
							<li class="menu-header">
								-- Side Heading
							</li>
							<li>
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="icon-lock_outline"></i>
									</span>
									<span class="nav-title">Authentication</span>
								</a>
								<ul aria-expanded="false" class="collapse">
									<li>
										<a href="login.html">Login</a>
									</li>
									<li>
										<a href="signup.html">Signup</a>
									</li>
									<li>
										<a href="forgot-pwd.html">Forgot Password</a>
									</li>
									<li>
										<a href="locked-screen.html">Locked Screen</a>
									</li>
									<li>
										<a href="error404.html">Error 404</a>
									</li>
									<li>
										<a href="error505.html">Error 505</a>
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