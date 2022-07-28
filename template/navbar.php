<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
      <!--<div class="page-loader">
        <div class="loader">Loading...</div>
      </div>-->
    <?php
    session_start();
    if(isset($_SESSION['name'])){
        echo '<nav class="navbar navbar-custom navbar-fixed-top " role="navigation"><!--navbar-transparent-->
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.html">Titan</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"> <a class="dropdown" href="index.php">Home</a> </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Headers</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gradient Overlay Header</a>
                    <ul class="dropdown-menu">
                      <li><a href="index_mp_fullscreen_gradient_overlay.html">Fulscreen</a></li>
                      <li><a href="index_mp_classic_gradient_overlay.html">Classic</a></li>
                    </ul>
                  </li>
                </ul>
                  
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pages</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Restaurant menu</a>
                    <ul class="dropdown-menu">
                      <li><a href="restaurant_menu1.html">Menu 2 Columns</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Portfolio</a>
                <ul class="dropdown-menu" role="menu">
                  
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                    <ul class="dropdown-menu">
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_masonry_boxed_col_2.html">2 Columns</a></li>
                        </ul>
                      </li>
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_masonry_full_width_col_2.html">2 Columns</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                    <ul class="dropdown-menu">
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Image</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_single_featured_image1.html">Style 1</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Blog</a></li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">My Profile</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="shop_single_product.html">logout</a></li>
                  <li><a href="shop_checkout.html">Checkout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>';
    }else{
        echo '<nav class="navbar navbar-custom navbar-fixed-top " role="navigation"><!--navbar-transparent-->
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.html">Titan</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"> <a class="dropdown" href="index.php">Home</a> </li>';
        
            $categoriess= category::selectAllCategory('', '1'); 
            $catin= category::selectAllCategory();
            foreach ($categoriess as $category){
              echo'<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">'.$category["Name"].'</a>
                <ul class="dropdown-menu">';
                foreach ($catin as $cat){
                      if($cat["parent"]==$category["ID"]){
                    echo'<li class="dropdown"><a href="#" data-toggle="dropdown">'.$cat["Name"].'</a></li>';
                      }
                }
                    echo'</ul>
              </li>';
            }
              echo'<li class="dropdown"><a  href="login.php">login/Sign In</a> </li>
            </ul>
          </div>
        </div>
      </nav>';
    }
    ?>
        
      
              
              