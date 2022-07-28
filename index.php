<?php
$pageTitle="Home page";
include 'init.php';
?>  
<section class=" home-fade home-full-height" id="home">
        <div class="hero-slider">
          <ul class="slides">
            <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;template/images/slider1.png&quot;);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-1">This is Titan</div>
                  <div class="font-alt mb-30 titan-title-size-4"> Summer 2017</div>
                  <div class="font-alt mb-40 titan-title-size-1">Your online fashion destination</div><a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                </div>
              </div>
            </li>
            <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;template/images/slider3.png&quot;);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-1"> This is Titan</div>
                  <div class="font-alt mb-40 titan-title-size-4">Exclusive products</div><a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </section>
      <section class="module-small">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Latest in clothing</h2>
            </div>
          </div>
          <div class="row multi-columns-row">
              <?php   
              $items=getLatest('*', 'items','Item_ID', '8','1');
              foreach ($items as $item){
                echo'<div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="shop-item">
                      <div class="shop-item-image"><img src="uploads/items/'.$item['Image'].'" alt="Accessories Pack"/>
                      <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-basket">Add To Cart</span></a></div>
                    </div>
                    <h4 class="shop-item-title font-alt"><a href="singleItem.php?itemId='.$item['Item_ID'].'">'.$item['Name'].'</a></h4>'.$item['Price'].'
                  </div>
                </div>';
              }
             ?>       
          </div>
          <div class="row mt-30">
            <div class="col-sm-12 align-center"><a class="btn btn-b btn-round" href="#">See all products</a></div>
          </div>
        </div>
      </section>

      <section class="module module-video bg-dark-30" data-background="">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt mb-0">Be inspired. Get ahead of trends.</h2>
            </div>
          </div>
        </div>
        <div class="video-player" data-property="{videoURL:'https://www.youtube.com/watch?v=EMy5krGcoOU', containment:'.module-video', startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>
      </section>
      <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Exclusive products</h2>
              <div class="module-subtitle font-serif">The languages only differ in their grammar, their pronunciation and their most common words.</div>
            </div>
          </div>
          <div class="row">
            <div class="owl-carousel text-center" data-items="5" data-pagination="false" data-navigation="false">
                <?php
                $Exclusiveproducts=getLatest('*', 'items','Item_ID','7','1');
                if(!empty($Exclusiveproducts)){
                    foreach ($Exclusiveproducts as $Exclusive){
                      echo'<div class="owl-item">
                          <div class="col-sm-12">
                            <div class="ex-product"><a href="#"><img src="uploads/items/'.$Exclusive['Image'].'" alt="Leather belt"/></a>
                              <h4 class="shop-item-title font-alt"><a href="#">'.$Exclusive['Name'].'</a></h4>'.$Exclusive['Price'].'
                            </div>
                          </div>
                        </div>';    
                        }
                  }else{

                  }?>
            </div>
          </div>
        </div>
      </section>
      <hr class="divider-w">
      <section class="module" id="news">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Our News</h2>
            </div>
          </div>
          <div class="row multi-columns-row post-columns wo-border">
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-40">
                <div class="post-header font-alt">
                  <h2 class="post-title"><a href="#">Receipt of the new collection</a></h2>
                </div>
                <div class="post-entry">
                  <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="post-more"><a class="more-link" href="#">Read more</a></div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-40">
                <div class="post-header font-alt">
                  <h2 class="post-title"><a href="#">Sale of summer season</a></h2>
                </div>
                <div class="post-entry">
                  <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="post-more"><a class="more-link" href="#">Read more</a></div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-40">
                <div class="post-header font-alt">
                  <h2 class="post-title"><a href="#">New lookbook</a></h2>
                </div>
                <div class="post-entry">
                  <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="post-more"><a class="more-link" href="#">Read more</a></div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-40">
                <div class="post-header font-alt">
                  <h2 class="post-title"><a href="#">Receipt of the new collection</a></h2>
                </div>
                <div class="post-entry">
                  <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="post-more"><a class="more-link" href="#">Read more</a></div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-40">
                <div class="post-header font-alt">
                  <h2 class="post-title"><a href="#">Sale of summer season</a></h2>
                </div>
                <div class="post-entry">
                  <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="post-more"><a class="more-link" href="#">Read more</a></div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-40">
                <div class="post-header font-alt">
                  <h2 class="post-title"><a href="#">New lookbook</a></h2>
                </div>
                <div class="post-entry">
                  <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="post-more"><a class="more-link" href="#">Read more</a></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <hr class="divider-w">
      <section class="module-small">
        <div class="container">
          <div class="row client">
            <div class="owl-carousel text-center" data-items="6" data-pagination="false" data-navigation="false">
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-1.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-2.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-3.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-4.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-5.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-1.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-2.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-3.png" alt="Client Logo"/></div>
                </div>
              </div>
              <div class="owl-item">
                <div class="col-sm-12">
                  <div class="client-logo"><img src="assets/images/client-logo-dark-4.png" alt="Client Logo"/></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="module-small bg-dark">
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="widget">
                <h5 class="widget-title font-alt">About Titan</h5>
                <p>The languages only differ in their grammar, their pronunciation and their most common words.</p>
                <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                <p>Email:<a href="#">somecompany@example.com</a></p>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="widget">
                <h5 class="widget-title font-alt">Recent Comments</h5>
                <ul class="icon-list">
                  <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                  <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                  <li>Andy on <a href="#">Eco bag Mockup</a></li>
                  <li>Jack on <a href="#">Bottle Mockup</a></li>
                  <li>Mark on <a href="#">Our trip to the Alps</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="widget">
                <h5 class="widget-title font-alt">Blog Categories</h5>
                <ul class="icon-list">
                  <li><a href="#">Photography - 7</a></li>
                  <li><a href="#">Web Design - 3</a></li>
                  <li><a href="#">Illustration - 12</a></li>
                  <li><a href="#">Marketing - 1</a></li>
                  <li><a href="#">Wordpress - 16</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="widget">
                <h5 class="widget-title font-alt">Popular Posts</h5>
                <ul class="widget-posts">
                  <li class="clearfix">
                    <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg" alt="Post Thumbnail"/></a></div>
                    <div class="widget-posts-body">
                      <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                      <div class="widget-posts-meta">23 january</div>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
                    <div class="widget-posts-body">
                      <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                      <div class="widget-posts-meta">15 February</div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
include 'template/footer.php';
?>      
        
        