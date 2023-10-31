		<div class="ec-left-sidebar ec-bg-sidebar">
			<div id="sidebar" class="sidebar ec-sidebar-footer">

				<div class="ec-brand">
					<a href="dashboard.php" title="Equipride">
						<img class="ec-brand-icon" src="images/EEE.png" alt="" />
						<span class="ec-brand-name text-truncate">Equipride</span>
					</a>
				</div>

				<!-- begin sidebar scrollbar -->
				<div class="ec-navigation" data-simplebar>
					<!-- sidebar menu -->
					<ul class="nav sidebar-inner" id="sidebar-menu">
						<!-- Dashboard -->
						<li class="active">
							<a class="sidenav-item-link" href="dashboard.php">
								<i class="mdi mdi-view-dashboard-outline"></i>
								<span class="nav-text">Dashboard</span>
							</a>
							<hr>
						</li>
						<!-- Users -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="setting.php">
								<i class="mdi mdi-wrench"></i>
								<span class="nav-text">Home Setting</span> 
							</a>
							<hr>
						</li>
						<!-- Vendors -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-account-group-outline"></i>
								<span class="nav-text">Dealer</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="view_dealer.php">
											<span class="nav-text">Dealer Grid</span>
										</a>
									</li>

									<li class="">
										<a class="sidenav-item-link" href="view_order.php">
											<span class="nav-text">Dealer Orders</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<!-- Users -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="view_user.php">
								<i class="mdi mdi-account-group"></i>
								<span class="nav-text">Users</span> 
							</a>
						</li>

						<!-- Users -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="view_guest.php">
								<i class="mdi mdi-account-supervisor"></i>
								<span class="nav-text">Guest</span> 
							</a>
							<hr>
						</li>

						<!-- Category -->
						<li>
							<a class="sidenav-item-link" href="view_category.php">
								<i class="mdi mdi-dns-outline"></i>
								<span class="nav-text">Categories</span>
							</a>
						</li>
						<!-- color -->
						<li>
							<a class="sidenav-item-link" href="view_color.php">
								<i class="mdi mdi-palette-swatch"></i>
								<span class="nav-text">Color</span>
							</a>
						</li>
						<!-- size -->
						<li>
							<a class="sidenav-item-link" href="view_size.php">
								<i class="mdi mdi-resize"></i>
								<span class="nav-text">Size Chart</span>
							</a>
						</li>
						<!-- Products -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="view_product.php">
								<i class="mdi mdi-palette-advanced"></i>
								<span class="nav-text">Products</span> 
							</a>
						</li>

						<!-- History -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="history.php">
								<i class="mdi mdi-bank-transfer"></i>
								<span class="nav-text">Order History</span> 
							</a>
						</li>
						<!-- Orders -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-garage"></i>
								<span class="nav-text">Stock Management</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="view_stock.php">
											<span class="nav-text">stock</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="utilizion.php">
											<span class="nav-text">Stock Utilization</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<!-- clearance -->
						<li>
							<a class="sidenav-item-link" href="view_clearance.php">
								<i class="mdi mdi-sale"></i>
								<span class="nav-text">Clearance</span>
							</a>
						</li>

						<!-- Tradeshow -->
						<li>
							<a class="sidenav-item-link" href="view_tradeshows.php">
								<i class="mdi mdi-camera-burst"></i>
								<span class="nav-text">Tradeshow</span>
							</a>
							<hr>
						</li>

						<!-- Comming Soon -->
						<li>
							<a class="sidenav-item-link" href="comming_soon.php">
								<i class="mdi mdi-camera-burst"></i>
								<span class="nav-text">Coming Soon</span>
							</a>
							<hr>
						</li>
						<!-- Authentication -->
						<!-- <li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-login"></i>
								<span class="nav-text">Authentication</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="authentication" data-parent="#sidebar-menu">
									<li class="">
										<a href="sign-in.html">
											<span class="nav-text">Sign In</span>
										</a>
									</li>
									<li class="">
										<a href="sign-up.html">
											<span class="nav-text">Sign Up</span>
										</a>
									</li>
								</ul>
							</div>
						</li> -->

						<!-- Icons -->
						<!-- <li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-diamond-stone"></i>
								<span class="nav-text">Icons</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="icons" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="material-icon.html">
											<span class="nav-text">Material Icon</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="font-awsome-icons.html">
											<span class="nav-text">Font Awsome Icon</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="flag-icon.html">
											<span class="nav-text">Flag Icon</span>
										</a>
									</li>
								</ul>
							</div>
						</li> -->

						<!-- Other Pages -->
						<!-- <li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-image-filter-none"></i>
								<span class="nav-text">Other Pages</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="otherpages" data-parent="#sidebar-menu">
									<li class="has-sub">
										<a href="404.html">404 Page</a>
									</li>
								</ul>
							</div>
						</li> -->
					</ul>
				</div>
			</div>
		</div>