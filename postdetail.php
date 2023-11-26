<?php
include_once('app/helper/Helper.php');
$help = new Helper();
?> 
<section>
   <div class="bg_in">
      <div class="wrapper_all_main">
         <div class="wrapper_all_main_right">
            <div class="breadcrumbs">
               <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <a itemprop="item" href="<?php echo BASE_URL ?>">
                     <span itemprop="name">Trang chủ</span></a>
                     <meta itemprop="position" content="1" />
                  </li>
                  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <span itemprop="item">
                     <strong itemprop="name">
                        <?php echo $this->title;  ?>
                     </strong>
                     </span>
                     <meta itemprop="position" content="2" />
                  </li>
               </ol>
            </div>
            <!--breadcrumbs-->
            <div class="content_page">
               <div class="box-title">
                  <div class="title-bar">
                     <h1><?php echo $this->title  ?></h1>
                  </div>
               </div>
               <div class="content_text">
                  <?php
                    foreach($postbyid as $key => $p){
                        echo $p['sum'];
                        echo $p['content'];
                    }
                   ?>
               </div>
               <div class="clear"></div>
            </div>
            <h4>Các tin khác</h4>
            <ul class="tinlienquan">
                <?php
                foreach($getpost_limit as $key => $post){ 
                ?>
                <li><a href="<?php echo BASE_URL ?>/p/details/<?php echo $post['postId'] ?>/<?php echo $help->makeUrl($post['title']) ?>"><?php echo $post['title'] ?></a></li>
              <?php
              } 
              ?>
            </ul>
         </div>
       

         <!--end:left-->
         <div class="clear"></div>
      </div>
      <div class="clear"></div>
   </div>
</section>
<!---End bg_in----->
<!--end:body-->