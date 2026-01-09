<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<header id="header" data-plugin-options="{'stickyScrollUp': true, 'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': false, 'stickyStartAt': 100, 'stickyHeaderContainerHeight': 100}">
			<div class="header-body border-top-0 box-shadow-none">
				<div class="container-fluid px-3 px-lg-5 p-static">
					<div class="row align-items-center py-3">
						<div class="col-6 col-lg-2 col-xxl-3 me-auto me-lg-0">
							<div class="header-logo" data-clone-element-to="#offCanvasLogo">
								<a href="index.php">
									<img alt="Porto" src="img/logos/verticalLogo.svg" data-img-suffix-primary
										class="img-fluid w-75">

								</a>
							</div>
						</div>
						<div class="col-6 col-lg-10 col-xxl-9 desk-header justify-content-lg-center">
							<div class="header-nav header-nav-links justify-content-lg-center">
								<div
									class="header-nav-main header-nav-main-text-capitalize header-nav-main-arrows header-nav-main-effect-2">
									<nav class="collapse">
										<ul class="nav nav-pills" id="mainNav">
											<li>
												<a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
													Home
												</a>
											</li>
											<li>
												<a href="about_compseqr360.php" class="nav-link <?php echo $current_page == 'about_compseqr360.php' ? 'active' : ''; ?>">About Compseqr360</a>
											</li>
											<li class="dropdown <?php echo in_array($current_page, ['proedox.php', 'caan.php', 'caas.php', 'caap.php']) ? 'active' : ''; ?>" >
												<a href="#" class="nav-link dropdown-toggle">Products</a>
												<ul class="dropdown-menu">
													<!-- <li><a href="about_compseqr360.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2">About
															Compseqr360
														</a>
													</li> -->
													<li><a href="proedox.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2 <?php echo $current_page == 'proedox.php' ? 'active' : ''; ?>">ProEDox
															(Document Management System)</a>
													</li>
													<li><a href="caan.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2 <?php echo $current_page == 'caan.php' ? 'active' : ''; ?>">CaaN
															(Compliance as an Application)</a>
													</li>
													<li><a href="caas.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2 <?php echo $current_page == 'caas.php' ? 'active' : ''; ?>">CaaS
															(Compliance as a Service)</a></li>
													<li><a href="caap.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2 <?php echo $current_page == 'caap.php' ? 'active' : ''; ?>">CaaP
															(Compliance as a Partner)</a></li>
													<!-- <li><a href="proedox.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2">Payroll
															Management</a></li>
													<li><a href="proedox.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2">Global
															Accounting</a></li>
													<li><a href="proedox.php"
															class="dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2">Admin
															Services</a></li> -->
												</ul>
											</li>
											<li>
												<a class="nav-link <?php echo $current_page == 'team.php' ? 'active' : ''; ?>" href="team.php">
													Our Team
												</a>
											</li>
											<li>
												<a class="nav-link <?php echo $current_page == 'contact.php' ? 'active' : ''; ?>" href="contact.php">
													Contact
												</a>
											</li>
											<li> 
												<a class="nav-link <?php echo $current_page == 'looking-for-partner.php' ? 'active' : ''; ?>" href="looking-for-partner.php">
													Looking for a Partner
												</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
						<div class="col-6 col-lg-2 col-xxl-3 d-lg-block">
							<div class="d-flex justify-content-end align-items-center">
								<button class="btn header-btn-collapse-nav rounded-pill" data-bs-toggle="offcanvas"
									href="#offcanvasMain" role="button" aria-controls="offcanvasMain">
									<i class="fas fa-bars"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasMain"
			aria-labelledby="offcanvasMain">
			<div class="offcanvas-header">
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="mb-4" id="offCanvasLogo"></div>
				<nav class="offcanvas-nav w-100" id="offCanvasNav"></nav>
			</div>
</div>