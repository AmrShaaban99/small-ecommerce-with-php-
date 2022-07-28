<?php
ob_start();
include 'init.php';
$pageTitle="My Profile";

    if(isset($_SESSION['name'])){
        $sessionUser=$_SESSION['name'];
        echo '<main>
        <section class="module bg-dark-60 about-page-header" data-background="assets/images/about_bg.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">About</h2>
                <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>
              </div>
            </div>
          </div>
        </section>
        <section class="mt-30 information">
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">My Information</div>
                    <div class="panel-body">';
                       $members= member::retrieveMemeberById($sessionUser);
                       echo'<ul class="list-unstyled"';
                        echo '<li>
                                 <i class="fa fa-unlock-alt fa-fw"></i>
                                 <span >Name</span>: '.$members['Username']
                            .'</li>
                             <li>
                                 <i class="fa fa-envelope-o fa-fw"></i>
                                 <span>Email</span>: '.$members['Email']
                            .'</li>
                             <li>
                                 <i class="fa fa-user fa-fw"></i>
                                 <span>Full Name </span>: '.$members['Fullname']
                           .'</li>
                                <li>
                                 <i class="fa fa-calendar fa-fw"></i>
                                 <span>Register Date </span>: '.$members['Date']
                            .'</li>
                               <li>
                                 <i class="fa fa-tags fa-fw"></i>
                                 <span>Fav Category </span>: '.$members['Date']
                            .'</li>';
              echo '</div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">My Ads</div>
                    <div class="panel-body">
                        <div class="row">';
                        $items=items::retrieveItemById($sessionUser);
                        if(!empty($items)&& is_array($items)){
                            foreach ($items as $item){
                            echo'<div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-3" onclick="wow fadeInUp">
                                    <div class="team-item">
                                        <div class="team-image"><img src="template/images/1.jpg" alt="Member Photo"/>
                                             <div class="team-detail">
                                                 <h5 class="font-alt">'.$item['Name'].'</h5>
                                                 <p class="font-serif">'.$item['Description'].'</p>
                                                 <div class="team-social">
                                                   <a href="#"><i class="fa fa-facebook"></i></a>
                                                   <a href="#"><i class="fa fa-twitter"></i></a>
                                                   <a href="#"><i class="fa fa-dribbble"></i></a>
                                                   <a href="#"><i class="fa fa-skype"></i></a>
                                                 </div>
                                             </div>
                                        </div>
                                        <div class="team-descr font-alt">
                                            <div class="team-name">'.$item['Name'].'</div>
                                            <div class="team-role">'.$item['Price'].'</div>
                                        </div>
                                    </div>
                                </div>
                                     ';
                                 }    
                             } else {
                                 echo '<div class="alert alert-info">no items</div>';
                                 }
                    echo'
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">Latest Comments</div>
                    <div class="panel-body">';
                        $com= comments::retrieveCommentById($sessionUser);
                        if(is_array($com)){
                            foreach ($com as $comment){
                                echo ''.$comment['content'].'</br>';  
                            }
                        } else {
                            echo '<div class="alert alert-info">no comments</div>';
                        }
                    echo'</div>
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
                      <div class="widget-posts-image"><a href="#"><img src="template/images/rp-1.jpg" alt="Post Thumbnail"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                        <div class="widget-posts-meta">23 january</div>
                      </div>
                    </li>
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="#"><img src="template/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
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
    </main>';
        } else {
            redirectToOtherPage('you don\'t have account',1);
        }
?>  

<?php
include'template/footer.php';
ob_end_flush();
?>      
      