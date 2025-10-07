	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="./">
						<img src="{{ asset($settings->site_logo ??'frontend/images/logo.svg')}}" alt="Logo">
					</a>
					<!-- Logo End -->

					<!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="">Home</a></li>

                                <li class="nav-item"><a class="nav-link" href="">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="">Services</a></li>
                                <li class="nav-item"><a class="nav-link" href="">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="">Contact Us</a></li>
                            </ul>
                        </div>

					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
