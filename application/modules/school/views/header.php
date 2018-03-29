<!-- Header Area Start -->
<header class="header-area section">
    <!-- Header Top -->
    <div class="header-top section">
        <div class="container">
            <div class="row">
                <!-- Header Top Left -->
                <div class="header-top-left text-left col-sm-6">
                    <p>Have any question? +968 547856 254</p>
                </div>
                <!-- Header Top Right -->
                <div class="header-top-right text-right col-sm-6">
                    <!--ul>
                        <li><a href="#">Log In</a></li>
                        <li><a href="#">Register</a></li>
                    </ul-->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom -->
    <div class="header-bottom bg-white sticker section sticker">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                       <!-- Header Logo -->
                    <div class="header-logo float-left">
                        <a href="/"><img src="/assets/school/img/logo/logo.png" alt="logo"></a>
                    </div>
                    <!-- Header Buttons -->
                    <div class="header-buttons float-right">
                        <div class="header-search float-left">
                            <button class="search-toggle"><i class="zmdi zmdi-search"></i></button>
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search here..." name="search" />
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>                                
                            </div>
                        </div>
                    </div>
                    <!-- Main Menu -->
                    <div class="main-menu float-right hidden-xs">
                        <nav>
							<ul>
								 <?php
								$items = buildTree($categories);
								showHomeMenu($items, $parents);
								?>
							</ul>	
                        </nav>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>   
</header>
<!-- End of Header Area -->