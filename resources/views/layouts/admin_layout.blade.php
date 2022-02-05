<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8" />
	<title>{{ isset($title) ? $title : 'Планування ремонтів' }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- App favicon -->
	<link rel="shortcut icon" href="/admin/assets/images/favicon.ico">

	<!-- App css -->
	<link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="//cdn.jsdelivr.net/npm/@mdi/font@6.4.95/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
	<link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
	<link href="/admin/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
	<!-- Begin page -->
	<div class="wrapper">
		<!-- ========== Left Sidebar Start ========== -->
		<div class="leftside-menu">

			<!-- LOGO -->
			<a href="/subdivisions" class="logo text-center logo-light">
				<span class="logo-lg">
					<img src="/admin/assets/images/logo.png" alt="" height="16">
				</span>
				<span class="logo-sm">
					<img src="/admin/assets/images/logo_sm.png" alt="" height="16">
				</span>
			</a>

			<!-- LOGO -->
			<a href="/subdivisions" class="logo text-center logo-dark">
				<span class="logo-lg">
					<img src="/admin/assets/images/logo-dark.png" alt="" height="16">
				</span>
				<span class="logo-sm">
					<img src="/admin/assets/images/logo_sm_dark.png" alt="" height="16">
				</span>
			</a>

			<!-- SidebarContainer -->
			<div class="h-100" id="leftside-menu-container" data-simplebar>

				<!--- Sidebar -->
				<ul class="side-nav">

					{{-- <li class="side-nav-title side-nav-item">Меню</li> --}}

					{{-- <li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
							<i class="mdi mdi-desktop-mac-dashboard"></i>
							<span class="badge bg-success float-end">4</span>
							<span> Статистика </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarDashboards">
							<ul class="side-nav-second-level">
								<li>
									<a href="dashboard">Analytics</a>
								</li>
								<li>
									<a href="dashboard-crm.html">CRM</a>
								</li>
								<li>
									<a href="index.html">Ecommerce</a>
								</li>
								<li>
									<a href="dashboard-projects.html">Projects</a>
								</li>
							</ul>
						</div>
					</li> --}}

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarСatalog" aria-expanded="false" aria-controls="sidebarСatalog" class="side-nav-link">
							<i class="mdi mdi-database"></i>
							<span> Довідники </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarСatalog">
							<ul class="side-nav-second-level">
								<li class="side-nav-item">
									<a href="/subdivisions">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Підрозділи </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/complete_renovation_objects">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Об'єкти </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/specific_renovation_objects">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Об'єкти ремонтів </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/materials">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Матеріальні ресурси </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/workers">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Людські ресурси </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/technics">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Технічні ресурси </span>
									</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarPrice" aria-expanded="false" aria-controls="sidebarPrice" class="side-nav-link">
							<i class="mdi mdi-currency-usd"></i>
							<span> Ціни </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarPrice">
							<ul class="side-nav-second-level">
								<li class="side-nav-item">
									<a href="/materials_prices">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Ціни на матеріали </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/workers_prices">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Ціни на робітників </span>
									</a>
								</li>
								<li class="side-nav-item">
									<a href="/technics_prices">
										{{-- <i class="mdi mdi-format-list-bulleted"></i> --}}
										<span> Ціни на техніку </span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="side-nav-item">
						<a href="/ciphers" class="side-nav-link">
							<i class="mdi mdi-format-list-bulleted"></i>
							<span> Шифри ремонту </span>
						</a>
					</li>
					<li class="side-nav-item">
						<a href="/schedules" class="side-nav-link">
							<i class="mdi mdi-format-list-bulleted"></i>
							<span> Графіки ремонтів </span>
						</a>
					</li>

					{{-- <li class="side-nav-title side-nav-item">Apps</li>

					<li class="side-nav-item">
						<a href="apps-calendar.html" class="side-nav-link">
							<i class="uil-calender"></i>
							<span> Calendar </span>
						</a>
					</li>

					<li class="side-nav-item">
						<a href="apps-chat.html" class="side-nav-link">
							<i class="uil-comments-alt"></i>
							<span> Chat </span>
						</a>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
							<i class="uil-store"></i>
							<span> Ecommerce </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarEcommerce">
							<ul class="side-nav-second-level">
								<li>
									<a href="apps-ecommerce-products.html">Products</a>
								</li>
								<li>
									<a href="apps-ecommerce-products-details.html">Products Details</a>
								</li>
								<li>
									<a href="apps-ecommerce-orders.html">Orders</a>
								</li>
								<li>
									<a href="apps-ecommerce-orders-details.html">Order Details</a>
								</li>
								<li>
									<a href="apps-ecommerce-customers.html">Customers</a>
								</li>
								<li>
									<a href="apps-ecommerce-shopping-cart.html">Shopping Cart</a>
								</li>
								<li>
									<a href="apps-ecommerce-checkout.html">Checkout</a>
								</li>
								<li>
									<a href="apps-ecommerce-sellers.html">Sellers</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
							<i class="uil-envelope"></i>
							<span> Email </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarEmail">
							<ul class="side-nav-second-level">
								<li>
									<a href="apps-email-inbox.html">Inbox</a>
								</li>
								<li>
									<a href="apps-email-read.html">Read Email</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
							<i class="uil-briefcase"></i>
							<span> Projects </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarProjects">
							<ul class="side-nav-second-level">
								<li>
									<a href="apps-projects-list.html">List</a>
								</li>
								<li>
									<a href="apps-projects-details.html">Details</a>
								</li>
								<li>
									<a href="apps-projects-gantt.html">Gantt <span class="badge rounded-pill badge-light-lighten font-10 float-end">New</span></a>
								</li>
								<li>
									<a href="apps-projects-add.html">Create Project <span class="badge rounded-pill badge-success-lighten font-10 float-end">New</span></a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a href="apps-social-feed.html" class="side-nav-link">
							<i class="uil-rss"></i>
							<span> Social Feed </span>
						</a>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks" class="side-nav-link">
							<i class="uil-clipboard-alt"></i>
							<span> Tasks </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarTasks">
							<ul class="side-nav-second-level">
								<li>
									<a href="apps-tasks.html">List</a>
								</li>
								<li>
									<a href="apps-tasks-details.html">Details</a>
								</li>
								<li>
									<a href="apps-kanban.html">Kanban Board</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a href="apps-file-manager.html" class="side-nav-link">
							<i class="uil-folder-plus"></i>
							<span> File Manager </span>
						</a>
					</li> --}}

					{{-- <li class="side-nav-title side-nav-item">Custom</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
							<i class="uil-copy-alt"></i>
							<span> Pages </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarPages">
							<ul class="side-nav-second-level">
								<li>
									<a href="pages-profile.html">Profile</a>
								</li>
								<li>
									<a href="pages-profile-2.html">Profile 2</a>
								</li>
								<li>
									<a href="pages-invoice.html">Invoice</a>
								</li>
								<li>
									<a href="pages-faq.html">FAQ</a>
								</li>
								<li>
									<a href="pages-pricing.html">Pricing</a>
								</li>
								<li>
									<a href="pages-maintenance.html">Maintenance</a>
								</li>
								<li class="side-nav-item">
									<a data-bs-toggle="collapse" href="pages-starter.html#sidebarPagesAuth" aria-expanded="false" aria-controls="sidebarPagesAuth">
										<span> Authentication </span>
										<span class="menu-arrow"></span>
									</a>
									<div class="collapse" id="sidebarPagesAuth">
										<ul class="side-nav-third-level">
											<li>
												<a href="pages-login.html">Login</a>
											</li>
											<li>
												<a href="pages-login-2.html">Login 2</a>
											</li>
											<li>
												<a href="pages-register.html">Register</a>
											</li>
											<li>
												<a href="pages-register-2.html">Register 2</a>
											</li>
											<li>
												<a href="pages-logout.html">Logout</a>
											</li>
											<li>
												<a href="pages-logout-2.html">Logout 2</a>
											</li>
											<li>
												<a href="pages-recoverpw.html">Recover Password</a>
											</li>
											<li>
												<a href="pages-recoverpw-2.html">Recover Password 2</a>
											</li>
											<li>
												<a href="pages-lock-screen.html">Lock Screen</a>
											</li>
											<li>
												<a href="pages-lock-screen-2.html">Lock Screen 2</a>
											</li>
											<li>
												<a href="pages-confirm-mail.html">Confirm Mail</a>
											</li>
											<li>
												<a href="pages-confirm-mail-2.html">Confirm Mail 2</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="side-nav-item">
									<a data-bs-toggle="collapse" href="pages-starter.html#sidebarPagesError" aria-expanded="false" aria-controls="sidebarPagesError">
										<span> Error </span>
										<span class="menu-arrow"></span>
									</a>
									<div class="collapse" id="sidebarPagesError">
										<ul class="side-nav-third-level">
											<li>
												<a href="pages-404.html">Error 404</a>
											</li>
											<li>
												<a href="pages-404-alt.html">Error 404-alt</a>
											</li>
											<li>
												<a href="pages-500.html">Error 500</a>
											</li>
										</ul>
									</div>
								</li>
								<li>
									<a href="pages-starter.html">Starter Page</a>
								</li>
								<li>
									<a href="pages-preloader.html">With Preloader</a>
								</li>
								<li>
									<a href="pages-timeline.html">Timeline</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a href="landing.html" target="_blank" class="side-nav-link">
							<i class="uil-globe"></i>
							<span class="badge bg-secondary text-light float-end">New</span>
							<span> Landing </span>
						</a>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
							<i class="uil-window"></i>
							<span> Layouts </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarLayouts">
							<ul class="side-nav-second-level">
								<li>
									<a href="layouts-horizontal.html">Horizontal</a>
								</li>
								<li>
									<a href="layouts-detached.html">Detached</a>
								</li>
							</ul>
						</div>
					</li> --}}

					{{-- <li class="side-nav-title side-nav-item mt-1">Components</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI" class="side-nav-link">
							<i class="uil-box"></i>
							<span> Base UI </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarBaseUI">
							<ul class="side-nav-second-level">
								<li>
									<a href="ui-accordions.html">Accordions</a>
								</li>
								<li>
									<a href="ui-alerts.html">Alerts</a>
								</li>
								<li>
									<a href="ui-avatars.html">Avatars</a>
								</li>
								<li>
									<a href="ui-badges.html">Badges</a>
								</li>
								<li>
									<a href="ui-breadcrumb.html">Breadcrumb</a>
								</li>
								<li>
									<a href="ui-buttons.html">Buttons</a>
								</li>
								<li>
									<a href="ui-cards.html">Cards</a>
								</li>
								<li>
									<a href="ui-carousel.html">Carousel</a>
								</li>
								<li>
									<a href="ui-dropdowns.html">Dropdowns</a>
								</li>
								<li>
									<a href="ui-embed-video.html">Embed Video</a>
								</li>
								<li>
									<a href="ui-grid.html">Grid</a>
								</li>
								<li>
									<a href="ui-list-group.html">List Group</a>
								</li>
								<li>
									<a href="ui-modals.html">Modals</a>
								</li>
								<li>
									<a href="ui-notifications.html">Notifications</a>
								</li>
								<li>
									<a href="ui-offcanvas.html">Offcanvas</a>
								</li>
								<li>
									<a href="ui-placeholders.html">Placeholders</a>
								</li>
								<li>
									<a href="ui-pagination.html">Pagination</a>
								</li>
								<li>
									<a href="ui-popovers.html">Popovers</a>
								</li>
								<li>
									<a href="ui-progress.html">Progress</a>
								</li>
								<li>
									<a href="ui-ribbons.html">Ribbons</a>
								</li>
								<li>
									<a href="ui-spinners.html">Spinners</a>
								</li>
								<li>
									<a href="ui-tabs.html">Tabs</a>
								</li>
								<li>
									<a href="ui-tooltips.html">Tooltips</a>
								</li>
								<li>
									<a href="ui-typography.html">Typography</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
							<i class="uil-package"></i>
							<span> Extended UI </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarExtendedUI">
							<ul class="side-nav-second-level">
								<li>
									<a href="extended-dragula.html">Dragula</a>
								</li>
								<li>
									<a href="extended-range-slider.html">Range Slider</a>
								</li>
								<li>
									<a href="extended-ratings.html">Ratings</a>
								</li>
								<li>
									<a href="extended-scrollbar.html">Scrollbar</a>
								</li>
								<li>
									<a href="extended-scrollspy.html">Scrollspy</a>
								</li>
								<li>
									<a href="extended-treeview.html">Treeview</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a href="widgets.html" class="side-nav-link">
							<i class="uil-layer-group"></i>
							<span> Widgets </span>
						</a>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons" class="side-nav-link">
							<i class="uil-streering"></i>
							<span> Icons </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarIcons">
							<ul class="side-nav-second-level">
								<li>
									<a href="icons-dripicons.html">Dripicons</a>
								</li>
								<li>
									<a href="icons-mdi.html">Material Design</a>
								</li>
								<li>
									<a href="icons-unicons.html">Unicons</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarForms" aria-expanded="false" aria-controls="sidebarForms" class="side-nav-link">
							<i class="uil-document-layout-center"></i>
							<span> Forms </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarForms">
							<ul class="side-nav-second-level">
								<li>
									<a href="form-elements.html">Basic Elements</a>
								</li>
								<li>
									<a href="form-advanced.html">Form Advanced</a>
								</li>
								<li>
									<a href="form-validation.html">Validation</a>
								</li>
								<li>
									<a href="form-wizard.html">Wizard</a>
								</li>
								<li>
									<a href="form-fileuploads.html">File Uploads</a>
								</li>
								<li>
									<a href="form-editors.html">Editors</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarCharts" aria-expanded="false" aria-controls="sidebarCharts" class="side-nav-link">
							<i class="uil-chart"></i>
							<span> Charts </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarCharts">
							<ul class="side-nav-second-level">
								<li class="side-nav-item">
									<a data-bs-toggle="collapse" href="pages-starter.html#sidebarApexCharts" aria-expanded="false" aria-controls="sidebarApexCharts">
										<span> Apex Charts </span>
										<span class="menu-arrow"></span>
									</a>
									<div class="collapse" id="sidebarApexCharts">
										<ul class="side-nav-third-level">
											<li>
												<a href="charts-apex-area.html">Area</a>
											</li>
											<li>
												<a href="charts-apex-bar.html">Bar</a>
											</li>
											<li>
												<a href="charts-apex-bubble.html">Bubble</a>
											</li>
											<li>
												<a href="charts-apex-candlestick.html">Candlestick</a>
											</li>
											<li>
												<a href="charts-apex-column.html">Column</a>
											</li>
											<li>
												<a href="charts-apex-heatmap.html">Heatmap</a>
											</li>
											<li>
												<a href="charts-apex-line.html">Line</a>
											</li>
											<li>
												<a href="charts-apex-mixed.html">Mixed</a>
											</li>
											<li>
												<a href="charts-apex-pie.html">Pie</a>
											</li>
											<li>
												<a href="charts-apex-radar.html">Radar</a>
											</li>
											<li>
												<a href="charts-apex-radialbar.html">RadialBar</a>
											</li>
											<li>
												<a href="charts-apex-scatter.html">Scatter</a>
											</li>
											<li>
												<a href="charts-apex-sparklines.html">Sparklines</a>
											</li>
										</ul>
									</div>
								</li>
								<li>
									<a href="charts-brite.html">Britecharts</a>
								</li>
								<li>
									<a href="charts-chartjs.html">Chartjs</a>
								</li>
								<li>
									<a href="charts-sparkline.html">Sparklines</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarTables" aria-expanded="false" aria-controls="sidebarTables" class="side-nav-link">
							<i class="uil-table"></i>
							<span> Tables </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarTables">
							<ul class="side-nav-second-level">
								<li>
									<a href="tables-basic.html">Basic Tables</a>
								</li>
								<li>
									<a href="tables-datatable.html">Data Tables</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarMaps" aria-expanded="false" aria-controls="sidebarMaps" class="side-nav-link">
							<i class="uil-location-point"></i>
							<span> Maps </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarMaps">
							<ul class="side-nav-second-level">
								<li>
									<a href="maps-google.html">Google Maps</a>
								</li>
								<li>
									<a href="maps-vector.html">Vector Maps</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="pages-starter.html#sidebarMultiLevel" aria-expanded="false" aria-controls="sidebarMultiLevel" class="side-nav-link">
							<i class="uil-folder-plus"></i>
							<span> Multi Level </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarMultiLevel">
							<ul class="side-nav-second-level">
								<li class="side-nav-item">
									<a data-bs-toggle="collapse" href="pages-starter.html#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
										<span> Second Level </span>
										<span class="menu-arrow"></span>
									</a>
									<div class="collapse" id="sidebarSecondLevel">
										<ul class="side-nav-third-level">
											<li>
												<a href="javascript: void(0);">Item 1</a>
											</li>
											<li>
												<a href="javascript: void(0);">Item 2</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="side-nav-item">
									<a data-bs-toggle="collapse" href="pages-starter.html#sidebarThirdLevel" aria-expanded="false" aria-controls="sidebarThirdLevel">
										<span> Third Level </span>
										<span class="menu-arrow"></span>
									</a>
									<div class="collapse" id="sidebarThirdLevel">
										<ul class="side-nav-third-level">
											<li>
												<a href="javascript: void(0);">Item 1</a>
											</li>
											<li class="side-nav-item">
												<a data-bs-toggle="collapse" href="pages-starter.html#sidebarFourthLevel" aria-expanded="false" aria-controls="sidebarFourthLevel">
													<span> Item 2 </span>
													<span class="menu-arrow"></span>
												</a>
												<div class="collapse" id="sidebarFourthLevel">
													<ul class="side-nav-forth-level">
														<li>
															<a href="javascript: void(0);">Item 2.1</a>
														</li>
														<li>
															<a href="javascript: void(0);">Item 2.2</a>
														</li>
													</ul>
												</div>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</li> --}}
				</ul>

				<!-- Help Box -->
				{{-- <div class="help-box text-white text-center">
					<a href="javascript: void(0);" class="float-end close-btn text-white">
						<i class="mdi mdi-close"></i>
					</a>
					<img src="/admin/assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
					<h5 class="mt-3">Unlimited Access</h5>
					<p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
					<a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
				</div> --}}
				<!-- end Help Box -->
				<!-- End Sidebar -->

				<div class="clearfix"></div>

			</div>
			<!-- End SidebarContainer -->

		</div>
		<!-- ========== Left Sidebar End ========== -->

		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="content-page">
			<div class="content">
				<!-- Start Topbar -->
				<div class="navbar-custom">
					<ul class="list-unstyled topbar-menu float-end mb-0">
						<li class="dropdown notification-list d-lg-none">
							<a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="pages-starter.html#" role="button" aria-haspopup="false" aria-expanded="false">
								<i class="dripicons-search noti-icon"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
								<form class="p-3">
									<input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
								</form>
							</div>
						</li>
						<li class="dropdown notification-list topbar-dropdown">
							<a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="pages-starter.html#" role="button" aria-haspopup="false" aria-expanded="false">
								<img src="/admin/assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="12">
								<span class="align-middle d-none d-sm-inline-block">English</span> <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<img src="/admin/assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<img src="/admin/assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12">
									<span class="align-middle">Italian</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<img src="/admin/assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12">
									<span class="align-middle">Spanish</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<img src="/admin/assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12">
									<span class="align-middle">Russian</span>
								</a>

							</div>
						</li>

						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="pages-starter.html#" role="button" aria-haspopup="false" aria-expanded="false">
								<i class="dripicons-bell noti-icon"></i>
								<span class="noti-icon-badge"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

								<!-- item-->
								<div class="dropdown-item noti-title">
									<h5 class="m-0">
										<span class="float-end">
											<a href="javascript: void(0);" class="text-dark">
												<small>Clear All</small>
											</a>
										</span>Notification
									</h5>
								</div>

								<div style="max-height: 230px;" data-simplebar>
									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<div class="notify-icon bg-primary">
											<i class="mdi mdi-comment-account-outline"></i>
										</div>
										<p class="notify-details">Caleb Flakelar commented on Admin
											<small class="text-muted">1 min ago</small>
										</p>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<div class="notify-icon bg-info">
											<i class="mdi mdi-account-plus"></i>
										</div>
										<p class="notify-details">New user registered.
											<small class="text-muted">5 hours ago</small>
										</p>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<div class="notify-icon">
											<img src="/admin/assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
										</div>
										<p class="notify-details">Cristina Pride</p>
										<p class="text-muted mb-0 user-msg">
											<small>Hi, How are you? What about our next meeting</small>
										</p>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<div class="notify-icon bg-primary">
											<i class="mdi mdi-comment-account-outline"></i>
										</div>
										<p class="notify-details">Caleb Flakelar commented on Admin
											<small class="text-muted">4 days ago</small>
										</p>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<div class="notify-icon">
											<img src="/admin/assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
										</div>
										<p class="notify-details">Karen Robinson</p>
										<p class="text-muted mb-0 user-msg">
											<small>Wow ! this admin looks good and awesome design</small>
										</p>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<div class="notify-icon bg-info">
											<i class="mdi mdi-heart"></i>
										</div>
										<p class="notify-details">Carlos Crouch liked
											<b>Admin</b>
											<small class="text-muted">13 days ago</small>
										</p>
									</a>
								</div>

								<!-- All-->
								<a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
									View All
								</a>

							</div>
						</li>

						<li class="dropdown notification-list d-none d-sm-inline-block">
							<a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="pages-starter.html#" role="button" aria-haspopup="false" aria-expanded="false">
								<i class="dripicons-view-apps noti-icon"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

								<div class="p-2">
									<div class="row g-0">
										<div class="col">
											<a class="dropdown-icon-item" href="pages-starter.html#">
												<img src="/admin/assets/images/brands/slack.png" alt="slack">
												<span>Slack</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="pages-starter.html#">
												<img src="/admin/assets/images/brands/github.png" alt="Github">
												<span>GitHub</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="pages-starter.html#">
												<img src="/admin/assets/images/brands/dribbble.png" alt="dribbble">
												<span>Dribbble</span>
											</a>
										</div>
									</div>

									<div class="row g-0">
										<div class="col">
											<a class="dropdown-icon-item" href="pages-starter.html#">
												<img src="/admin/assets/images/brands/bitbucket.png" alt="bitbucket">
												<span>Bitbucket</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="pages-starter.html#">
												<img src="/admin/assets/images/brands/dropbox.png" alt="dropbox">
												<span>Dropbox</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="pages-starter.html#">
												<img src="/admin/assets/images/brands/g-suite.png" alt="G Suite">
												<span>G Suite</span>
											</a>
										</div>
									</div> <!-- end row-->
								</div>

							</div>
						</li>

						<li class="notification-list">
							<a class="nav-link end-bar-toggle" href="javascript: void(0);">
								<i class="dripicons-gear noti-icon"></i>
							</a>
						</li>

						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="pages-starter.html#" role="button" aria-haspopup="false" aria-expanded="false">
								<span class="account-user-avatar">
									<img src="/admin/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
								</span>
								<span>
									<span class="account-user-name">
										@auth
											{{ Auth::user()->name . ' ' . Auth::user()->surname }}
										@endauth
										@guest
											NAME SURNAME
										@endguest
									</span>
									<span class="account-position">Founder</span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
								<!-- item-->
								<div class=" dropdown-header noti-title">
									<h6 class="text-overflow m-0">Ласкаво просимо!</h6>
								</div>

								<!-- item-->
								<a href="/profile" class="dropdown-item notify-item">
									<i class="mdi mdi-account-circle me-1"></i>
									<span>Профіль</span>
								</a>

								<!-- item-->
								<a href="/setting" class="dropdown-item notify-item">
									<i class="mdi mdi-account-edit me-1"></i>
									<span>Налаштування</span>
								</a>

								<!-- item-->
								<a href="/support" class="dropdown-item notify-item">
									<i class="mdi mdi-lifebuoy me-1"></i>
									<span>Підтримка</span>
								</a>

								<!-- item-->
								<a href="/lock_screen" class="dropdown-item notify-item">
									<i class="mdi mdi-lock-outline me-1"></i>
									<span>Екран блокування</span>
								</a>

								<!-- item-->
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<a href="/logout" class="dropdown-item notify-item" onclick="event.preventDefault();
																																				this.closest('form').submit();">
										<i class="mdi mdi-logout me-1"></i>
										<span>Вийти</span>
									</a>
								</form>
							</div>
						</li>
					</ul>
					<button class="button-menu-mobile open-left">
						<i class="mdi mdi-menu"></i>
					</button>
					<div class="app-search dropdown d-none d-lg-block">
						<form>
							<div class="input-group">
								<input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search" disabled>
								<span class="mdi mdi-magnify search-icon"></span>
								<button class="input-group-text btn-primary" type="submit" disabled>Search</button>
							</div>
						</form>

						<div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
							<!-- item-->
							<div class="dropdown-header noti-title">
								<h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
							</div>

							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<i class="uil-notes font-16 me-1"></i>
								<span>Analytics Report</span>
							</a>

							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<i class="uil-life-ring font-16 me-1"></i>
								<span>How can I help you?</span>
							</a>

							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<i class="uil-cog font-16 me-1"></i>
								<span>User profile settings</span>
							</a>

							<!-- item-->
							<div class="dropdown-header noti-title">
								<h6 class="text-overflow mb-2 text-uppercase">Users</h6>
							</div>

							<div class="notification-list">
								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<div class="d-flex">
										<img class="d-flex me-2 rounded-circle" src="/admin/assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
										<div class="w-100">
											<h5 class="m-0 font-14">Erwin Brown</h5>
											<span class="font-12 mb-0">UI Designer</span>
										</div>
									</div>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<div class="d-flex">
										<img class="d-flex me-2 rounded-circle" src="/admin/assets/images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
										<div class="w-100">
											<h5 class="m-0 font-14">Jacob Deo</h5>
											<span class="font-12 mb-0">Developer</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End Topbar -->

				<!-- Start Content-->
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								@isset($breadcrumb)
									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="/subdivisions">Головна</a></li>
											@foreach ($breadcrumb as $key => $item)
												<li class="breadcrumb-item {{ $key }}">
													@if ($key === 'active')
														{{ $item }}
													@else
														<a href="javascript: void(0);">{{ $item }}</a>
													@endif
												</li>
												<!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> -->
												<!-- <li class="breadcrumb-item active">Starter</li> -->
											@endforeach
										</ol>
									</div>
								@endisset
								<h4 class="page-title">{{ isset($title_page) ? $title_page : 'Starter' }}</h4>
							</div>
						</div>
					</div>
					@if (session('message'))
						<div class="row">
							<div class="col-12">
								<div class="alert alert-dismissible bg-{{ session('type') }} text-white fade show" role="alert">
									<i class="mdi mdi-information-outline"></i> {{ session('message') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							</div>
						</div>
					@endif
					<!-- end page title -->
					@include($content)
				</div> <!-- container -->

			</div> <!-- content -->

			<!-- Footer Start -->
			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<script>
							 document.write(new Date().getFullYear())
							</script> © Hyper - Coderthemes.com
						</div>
						<div class="col-md-6">
							<div class="text-md-end footer-links d-none d-md-block">
								<a href="javascript: void(0);">About</a>
								<a href="javascript: void(0);">Support</a>
								<a href="javascript: void(0);">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer -->

		</div>

		<!-- ============================================================== -->
		<!-- End Page content -->
		<!-- ============================================================== -->


	</div>
	<!-- END wrapper -->


	<!-- Right Sidebar -->
	<div class="end-bar">

		<div class="rightbar-title">
			<a href="javascript:void(0);" class="end-bar-toggle float-end">
				<i class="dripicons-cross noti-icon"></i>
			</a>
			<h5 class="m-0">Settings</h5>
		</div>

		<div class="rightbar-content h-100" data-simplebar>

			<div class="p-3">
				<div class="alert alert-warning" role="alert">
					<strong>Customize </strong> the overall color scheme, sidebar menu, etc.
				</div>

				<!-- Settings -->
				<h5 class="mt-3">Color Scheme</h5>
				<hr class="mt-1" />

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked>
					<label class="form-check-label" for="light-mode-check">Light Mode</label>
				</div>

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
					<label class="form-check-label" for="dark-mode-check">Dark Mode</label>
				</div>


				<!-- Width -->
				<h5 class="mt-4">Width</h5>
				<hr class="mt-1" />
				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked>
					<label class="form-check-label" for="fluid-check">Fluid</label>
				</div>

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
					<label class="form-check-label" for="boxed-check">Boxed</label>
				</div>


				<!-- Left Sidebar-->
				<h5 class="mt-4">Left Sidebar</h5>
				<hr class="mt-1" />
				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
					<label class="form-check-label" for="default-check">Default</label>
				</div>

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked>
					<label class="form-check-label" for="light-check">Light</label>
				</div>

				<div class="form-check form-switch mb-3">
					<input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
					<label class="form-check-label" for="dark-check">Dark</label>
				</div>

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked>
					<label class="form-check-label" for="fixed-check">Fixed</label>
				</div>

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
					<label class="form-check-label" for="condensed-check">Condensed</label>
				</div>

				<div class="form-check form-switch mb-1">
					<input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
					<label class="form-check-label" for="scrollable-check">Scrollable</label>
				</div>

				<div class="d-grid mt-4">
					<button class="btn btn-primary" id="resetBtn">Reset to Default</button>

					<a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
				</div>
			</div> <!-- end padding-->

		</div>
	</div>

	<div class="rightbar-overlay"></div>
	<!-- /End-bar -->


	<!-- bundle -->
	<script src="/admin/assets/js/vendor.min.js"></script>
	<script src="/admin/assets/js/app.min.js"></script>

	@isset($script_js)
		<script src="/js/pages/{{ $script_js }}"></script>
	@endisset

</body>

</html>