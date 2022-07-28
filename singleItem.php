<?php
$pageTitle="Item page";
include 'init.php';
$userofpage=$_SESSION['name'];
if (isset( $_GET["itemId"])) {
    if(!empty($userofpage)){
        
        $AlldataOfUser= getdatareturndata('*', 'users', 'Username',$userofpage);
        $userId=$AlldataOfUser['UserId'];
    }
    $id=$_GET['itemId'];
    $item=items::retrieveItemById($id);
    $idCheck=checkItem('Item_ID ','items',$_GET['itemId']);
    if($idCheck==FALSE){
         if(isset($_POST['AddComment'])){
             echo 'start the program';
            $content=$_POST['content'];   
            //$Rating=$_POST['Rating'];

            print_r($content);
            echo $item['Item_ID'].'the item id   ';
            echo $userId.' the user id ';
            $comments=new comments($content,'',$item['Item_ID'],$userId);
            $comments->Addcomment();
                
            }
    echo '<main>        
    <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 mb-sm-40"><a class="gallery" href="assets/images/shop/product-7.jpg"><img src="assets/images/shop/product-7.jpg" alt="Single Product Image"/></a>
              <ul class="product-gallery">
              
                <li><a class="gallery" href="assets/images/shop/product-8.jpg"></a><img src="assets/images/shop/product-8.jpg" alt="Single Product"/></li>
                <li><a class="gallery" href="assets/images/shop/product-9.jpg"></a><img src="assets/images/shop/product-9.jpg" alt="Single Product"/></li>
                <li><a class="gallery" href="assets/images/shop/product-10.jpg"></a><img src="assets/images/shop/product-10.jpg" alt="Single Product"/></li>
              </ul>
            </div>
            <div class="col-sm-6">
              <div class="row">';
                echo'<div class="col-sm-12">
                  <h1 class="product-title font-alt">'.$item['Name'].'</h1>
                </div>
              </div>
              <div class="row mb-20">
                <div class="col-sm-12">
                <span><i class="fa fa-star star"></i></span>
                <span><i class="fa fa-star star"></i></span>
                <span><i class="fa fa-star star"></i></span>
                <span><i class="fa fa-star star"></i></span>
                <span><i class="fa fa-star star-off"></i></span>
                <a class="open-tab section-scroll" href="#reviews">-2customer reviews</a>
                </div>
              </div>
              <div class="row mb-20">
                <div class="col-sm-12">
                  <div class="price font-alt"><span class="amount">£'.$item['Price'].'</span></div>
                </div>
              </div>
              <div class="row mb-20">
                <div class="col-sm-12">
                  <div class="description">
                    <p>'.$item['Description'].'</p>
                  </div>
                </div>
              </div>
              <div class="row mb-20">
                <div class="col-sm-4 mb-sm-20">
                  <input class="form-control input-lg" type="number" name="" value="1" max="40" min="1" required="required"/>
                </div>
                <div class="col-sm-8"><a class="btn btn-lg btn-block btn-round btn-b" href="#">Add To Cart</a></div>
              </div>
              <div class="row mb-20">
                <div class="col-sm-12">
                  <div class="product_meta">
                    Categories:<a href="#">
                    Man, </a><a href="#">
                    Clothing, </a><a href="#">T-shirts</a>
                  </div>
                  <div class="product_meta">
                    Date:<span>'.$item['Add_Date'].'</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row mt-70">
            <div class="col-sm-12">
              <ul class="nav nav-tabs font-alt" role="tablist">
                <li class="active"><a href="#description" data-toggle="tab"><span class="icon-tools-2"></span>Description</a></li>
                <li><a href="#data-sheet" data-toggle="tab"><span class="icon-tools-2"></span>Data sheet</a></li>
                <li><a href="#reviews" data-toggle="tab"><span class="icon-tools-2"></span>Reviews (2)</a></li>
              </ul>
              <div class="tab-content">
                  
                <div class="tab-pane active" id="description">
                  <p>Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages.</p>
                  <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.</p>
                </div>
                <div class="tab-pane" id="data-sheet">
                  <table class="table table-striped ds-table table-responsive">
                    <tbody>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                      <tr>
                        <td>Compositions</td>
                        <td>'.$item['Composition'].'</td>
                      </tr>
                      <tr>
                        <td>Size</td>
                        <td>'.$item['Size'].'</td>
                      </tr>
                      <tr>
                        <td>Color</td>
                        <td>'.$item['Colors'].'</td>
                      </tr>
                      <tr>
                        <td>Brand</td>
                        <td>'.$item['Brand'].'</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="reviews">
                  <div class="comments reviews">';
                    $com= getcommentbyItemId($id);
                    if(!empty($com)){
                    foreach ($com as $commment){
                        $commnetAvatar= getdatareturndata('*', 'users','UserId',$commment['user_id']);
                        if(empty($commnetAvatar['Avatar'])){
                            $commnetAvatar['Avatar']=NUll;
                        }
                        echo'<div class="comment clearfix">
                                <div class="comment-avatar">
                                    <img src="uploads/avatar/'.$commnetAvatar['Avatar'].'" alt="avatar"/>
                                </div>
                                <div class="comment-content clearfix">
                                    <div class="comment-author font-alt"><a href="#">'.$commnetAvatar['Username'].'</a></div>
                                    <div class="comment-body">
                                    <p> '.$commment['content'].'</p>
                                </div>
                                <div class="comment-meta font-alt">'.$commment['comment_date'].'
                                    
                                </div>
                          </div>';
                        }
                     } else {
                         
                        }
                    echo'</div>
                  </div>';
                    if(!empty($_SESSION['name'])){
                  echo'<div class="comment-form mt-30">
                    <h4 class="comment-form-title font-alt">Add review</h4>
                        <form action="singleItem.php?itemId='.$id.'" method="post">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <select class="form-control">
                                  <option selected="true" name="Rating" disabled="">Rating</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">                          
                                    <input type="textarea" class="form-control" name="content" placeholder="Review " required>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <input class="btn btn-round btn-d" name="AddComment" type="submit" value="Submit Review"/>
                            </div>
                          </div>
                        </form>';
                    }
                  echo'</div>
                </div>
                  
              </div>
            </div>
          </div>
        </div>
    </section>
                
    <hr class="divider-w">
    <section class="module-small">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Related Products</h2>
            </div>
          </div>
          <div class="row multi-columns-row">';
                
                $RelatedProducts= items::selectAllItemsOfSameCategory($item['Cat_ID']);
                if(!empty($RelatedProducts)){
                    foreach ($RelatedProducts as $Related){
                    echo'<div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="shop-item">
                              <div class="shop-item-image"><img src="uploads/items/'.$Related['Image'].'" alt="Accessories Pack"/>
                                <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-basket">Add To Cart</span></a></div>
                              </div>
                              <h4 class="shop-item-title font-alt"><a href="#">'.$Related['Name'].'</a></h4>'.$Related['Price'].'
                            </div>
                        </div>';
                    }    
                }else {
                    echo '<div class="alert alert-info">no items in this item category</div>';  
                }
          echo'</div>
        </div>
    </section>  
    <hr class="divider-w">
    <section class="module">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt">Exclusive products</h2>
            <div class="module-subtitle font-serif">The languages only differ in their grammar, their pronunciation and their most common words.</div>
          </div>
        </div>
        <div class="row">
          <div class="owl-carousel text-center" data-items="5" data-pagination="false" data-navigation="false">';
          $Exclusiveproducts=getLatest('*', 'items', 'Item_ID','7');
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
</main>'; 
    } else {
        redirectToOtherPage('no sach id',1);
    }
} else {
    //redirectToOtherPage('don\'t has permission');
}
include 'template/footer.php';
?>