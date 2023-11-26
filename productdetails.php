 <?php

  include_once('app/helper/Helper.php');

  $help = new Helper();

?> 

 <section>

         <div class="bg_in">

            <div class="wrapper_all_main">

               <div class="wrapper_all_main_right no-padding-left" style="width:100%;">

                 

                  <div class="breadcrumbs">

                     <ol itemscope itemtype="http://schema.org/BreadcrumbList">

                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                           <a itemprop="item" href="<?php echo BASE_URL ?>">

                           <span itemprop="name">Trang chủ</span></a>

                           <meta itemprop="position" content="1" />

                        </li>

                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                           <a itemprop="item" href="<?php echo BASE_URL ?>/t/category/<?php echo $this->idcat  ?>/<?php echo $help->makeUrl($this->catname) ?>">

                           <span itemprop="name"><?php echo $this->catname ?></span></a>

                           <meta itemprop="position" content="2" />

                        </li>

                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                           <span itemprop="item">

                           <strong itemprop="name">

                           <?php echo $this->title ?>

                           </strong>

                           </span>

                           <meta itemprop="position" content="3" />

                        </li>

                     </ol>

                  </div>

                  <div class="content_page">

                    <?php

                    foreach($productdetailhome as $key => $box1){

                     ?>

                      <input type="hidden" name="hidden_name" id="name<?php echo $box1['productId']  ?>" value="<?php echo $box1['productName']  ?>" />

                      <input type="hidden" name="hidden_name" id="image<?php echo $box1['productId']  ?>" value="<?php echo $box1['image']  ?>" />

                       <input type="hidden" name="hidden_price" id="price<?php echo $box1['productId']  ?>" value="<?php echo $box1['price']  ?>" />


                     <div class="content-right-items margin0">

                        <div class="title-pro-des-ct">

                           <h1><?php echo $box1['productName'] ?></h1>

                        </div>

                        <div class="slider-galery ">

                        
                              <?php
                              foreach($color_image as $key => $color_img){ 
                              ?>
                               <div class="item_<?php echo $color_img['color_attribute'] ?>" style="display:none">

                                  <img src="<?php echo BASE_URL ?>/teamplate/image/attribute/<?php echo $color_img['image_color'] ?>" width="100%">

                                </div> 
                              <?php
                              } 
                              ?>
                                  
                                

                                 <div id="sync1" class="owl-carousel owl-theme">
                                  
                                  <?php

                                  foreach($gallery as $key => $gal){ 

                                  ?>

                                  <div class="item">

                                      <img src="<?php echo BASE_URL ?>/teamplate/image/gallery/<?php echo $gal['image'] ?>" width="100%">

                                  </div>

                                   <?php

                                  } 

                                  ?>

                                  </div>

                                 



                                 

                             <div id="sync2" class="owl-carousel owl-theme">

                                  <?php

                                  foreach($gallery as $key => $gal2){ 

                                  ?>

                                  <div class="item">

                                      <img src="<?php echo BASE_URL ?>/teamplate/image/gallery/<?php echo $gal2['image'] ?>" width="100%">

                                  </div>

                                 <?php

                                  } 

                                  ?> 

                                  </div>
 
                                 

                           

                        </div>

                        <div class="content-des-pro">

                           <div class="content-des-pro_in">

                              <div class="">

                                 <div class="price">

                                    <p class="code_skin" style="margin-bottom:10px">

                                       <span>Thương hiệu: <a href=""><?php echo $box1['brandName'] ?></a></span>

                                    </p>

                                    <div class="status_pro">

                                       <span><b>Trạng thái:</b>  Còn hàng</span>

                                    </div>

                                    <div class="status_pro"><span><b>Xuất xứ:</b>  Việt Nam</span></div>

                                 </div>

                                 <div id="giathuong" class="color_price">

                                    <span class="title_price bg_green">Giá thường:</span> <?php echo $help->format_currency($box1['price']).' VNĐ' ?><br><br>

                                  

                                    <div class="clear"></div>

                                 </div>
                                  <div class="clear"></div>
                                    <div class="color_price">

                                        <ul class="color_product" id="variants_one">
                                      <?php
                                      if($this->count_color>0){ 
                                      ?>
                                       <li id="0" style="color:#000;border:1px solid;width:95px;height: 40px;">Giá thường</li>
                                      <?php
                                      } 
                                      ?>

                                      <?php
                                      foreach($color_by_product as $key => $color){
                                        
                                        if($color){
                                          ?>
                                             <input type="hidden" name="id_product" id="id_product" value="<?php echo  $color['product_id'] ?>">

                                            <li data-color_attribute="<?php echo $color['color_attribute'] ?>" id="<?php echo $color['color_attribute'] ?>" style="width:40px;height:40px;background-color: <?php echo '#'.$color['mamau'] ?>"><?php echo $color['tenmau'] ?></li>
                                          <?php
                                            
                                        }
                                      }
                                      ?>
                                      </ul>
                                        <div class="clear"></div>
                                        <div id="variants_two"></div>

                                 </div>
                                
                                

                              </div>

                              <div class="clear"></div>

                           </div>

                           <div class="content-pro-des">

                              <div class="content_des">

                                 <p style="font-size: 16px;font-weight: bold;"><?php echo $box1['productName'] ?></p><br />

                                <?php echo $box1['sum_text'] ?>



                              </div>

                           </div>

                           <div class="ct">

                              <div class="number_price">

                                 <div class="custom pull-left">

                                 

                                    <input type="number" class="input-text qty" min="1" title="Qty" value="1" maxlength="12" id="quantity<?php echo $box1['productId'] ?>" name="qty">

                                   

                                    <div class="clear"></div>

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <div class="wp_a">

                                  

                                  <input type="button" name="add_to_cart" id="<?php echo $box1['productId'] ?>" class="btn-styling-cart add_to_cart" value="Thêm vào giỏ" /> 

                                 

                                 <div class="clear"></div>

                              </div>

                              <div class="clear"></div>

                           </div>

                        

                           <div class="tags_products prodcut_detail">

                              <div class="tab_link">

                                 <h3 class="title_tab_link">TAGS: </h3>

                                 <div class="content_tab_link"> <a href=""></a></div>

                              </div>

                           </div>

                        </div>

                        <div class="content-des-pro-suport">
                         
                           <div class="box-setup">

                              <div class="title-setup">

                                 <i class="fa fa-tasks" aria-hidden="true"></i> Dịch vụ &amp; Chú ý

                              </div>

                              <div class="info-setup">

                                 <div class="row-setup">

                                    <p style="text-align:justify">Quý khách vui lòng liên hệ với nhân viên bán hàng theo số điện thoại Hotline sau :</p>

                                    <p><span style="color:#d50100;font-size: 16px;">0333 387 339 - 07777.38.430</span>&nbsp;để biết thêm chi tiết về Phụ kiện sản phẩm.</p>

                                 </div>

                              </div>

                           </div>
                           <!--  <div class="info-prod prod-price freeship">

                              <span class="title">

                                 <p>

                              

                                 </p>

                              </span>

                        

                              </span>

                           </div> -->
                           <div class="info-prod prod-price freeship" >
								<h4 style="text-align: center;">Thông tin bảo hành</h4>
                              <span class="title">                   
								<h4 style="font-size: 16px; color: brown; font-weight: bold;">HÀNG NEW – NGUYÊN SEAL</h4> 
								<ol class="list-baohanh">
									<li>1.Bảo Hành Sản Phẩm 1 năm theo quy định nhà sản xuất . </li>
									<li>2.Bảo Hành Sản Phẩm1 Đổi 1 Trong 3 Ngày <b>( Với Sản Phẩm Iphone )</b></li>
									<li>3.Bảo Hành Tất Cả Phần Cứng trọn đời . </li>
									<hr>
								</ol>
								<h4 style="font-size: 16px; color: brown; font-weight: bold;">HÀNG LIKE NEW 99% </h4> 
								<ol class="list-baohanh">
									<li>1.Bảo Hành Sản Phẩm 6 Tháng Theo Quy Định Của <b>3Tphone.com</b></li>
									<li>2.Bảo Hành <b>1 Đổi 1 Trong 30 Ngày</b> Đầu Đối Với Sản Phẩm Lỗi Do Nhà Cung Cấp.</b></li>
									<li>3.Bảo Hành Tất Cả Phần Cứng trọn đời . </li>
									<hr>
								</ol>
							<!-- 	<h4 style="font-size: 16px; color: brown; font-weight: bold;">LƯU Ý : <b>3Tphone.com</b> sẽ không hỗ trợ bảo hành trong các trường hợp:</h4> 
								<ol class="list-baohanh">
									<li>1.Sản Phẩm Không Còn Tem + Phiếu Bảo Hành Của Cửa Hàng.</li>
									<li>2.Bị Rơi, Va Chạm, Ma Sát Với Vật Cứng Làm Trầy Xước, Cấn Móp, Cong Vênh, Vào Nước, Rỉ Sét, Ăn Mòn Và Phần Nhựa Ở Các Cổng Bị Mẻ Vỡ.</b></li>
									<li>3.Sản Phẩm Bị Tự Ý Tháo Dỡ, Sửa Chữa, Hack/Crack, Jailbreak Hoặc Cài Phầm Mềm Không Phù Hợp Bởi Cá Nhân, Đơn Vị Bên Ngoài.</li>
									<li>4.Không Xác Định Được Serial, Imei Trong Máy, Hỏng Hóc, Cháy Nổ Do Dùng Sai Điện Áp, Do Các Nguyên Nhân Khách Quan Khác.</li>
									<li>5.Theo Qui Định Từ Chối Bảo Hành Của Nhà Sản Xuất Hoặc Của Bên Cung Cấp Sản Phẩm.</li>
									<hr>
								</ol> -->
                              </span>

                              <!-- span class="row more"><a href="" title="">Xem thêm</a> -->

                              </span>

                           </div>
                           

                          

                        

                        </div>

                        <div class="clear"></div>

                     </div>

                     <?php

                     } 

                     ?>

                  </div>

               </div>
                   <!-- <div class="box-setup" style="background: cadetblue;color: #fff;" >

                              <div class="title-setup">

                                 <i class="fa fa-tasks" aria-hidden="true"></i> Chính sách &amp; Bảo hành

                              </div>

                              <div class="info-setup ">

                                 <div class="row-setup setup-baohanh">
                                    <h4 class="tieudebaohanh">HÀNG FULLBOX - CHƯA ACTIVE</h4>
                                 
                                    <p>Bảo Hành Sản Phẩm 12 Tháng Theo Quy Định Của Nhà Sản Xuất.</p>
                                    <p>Bảo Hành Sản Phẩm1 Đổi 1 Trong 3 Ngày (Với Sản Phẩm IPhone)</p>
                                    <p>Bảo Hành Tất Cả Phần Cứng Trên Sản Phẩm (Bao Gồm Cả Màn Hình, Nguồn, Wifi...)</p>
                                    <p>Bảo Hành Phần Mềm Miễn Phí Trọn Đời Máy, Hổ trợ kỹ thuật miễn phí.</p>
                                  
                                    <br>
                                    <h4 class="tieudebaohanh">HÀNG LIKE NEW 99%</h4>
                                    <p>Bảo Hành Sản Phẩm 6 Tháng Theo Quy Định Của 3Tphone.com</p>
                                    <p>Bảo Hành 1 Đổi 1 Trong 30 Ngày Đầu Đối Với Sản Phẩm Lỗi Do Nhà Cung Cấp.</p>
                                    <p>Trả hàng Miễn Phí Trong 3 Ngày Đầu (Hoàn Tiền Không Cần Lý Do) => Không Áp Dụng Với Khách Hàng Mua Trả Góp</p>
                                    <p>Bảo Hành Tất Cả Phần Cứng Trên Sản Phẩm (Bao Gồm Cả Màn Hình, Nguồn, Wifi,Vân Tay...)</p>
                                    <p>Bảo Hành Phần Mềm Miễn Phí Trọn Đời Máy,Hổ trợ kỹ thuật miễn phí.</p>

                                    <br>
                                    <h4 class="tieudebaohanh">LƯU Ý : 3Tphone.com sẽ không hỗ trợ bảo hành trong các trường hợp</h4>
                                    <p>Sản Phẩm Không Còn Tem + Phiếu Bảo Hành Của Cửa Hàng.</p>
                                    <p>Bị Rơi, Va Chạm, Ma Sát Với Vật Cứng Làm Trầy Xước, Cấn Móp, Cong Vênh, Vào Nước, Rỉ Sét, Ăn Mòn Và Phần Nhựa Ở Các Cổng Bị Mẻ Vỡ.</p>
                                    <p>Sản Phẩm Bị Tự Ý Tháo Dỡ, Sửa Chữa, Hack/Crack, Jailbreak Hoặc Cài Phầm Mềm Không Phù Hợp Bởi Cá Nhân, Đơn Vị Bên Ngoài.</p>
                                    <p>Không Xác Định Được Serial, Imei Trong Máy, Hỏng Hóc, Cháy Nổ Do Dùng Sai Điện Áp, Do Các Nguyên Nhân Khách Quan Khác.</p>
                                    <p>Theo Qui Định Từ Chối Bảo Hành Của Nhà Sản Xuất Hoặc Của Bên Cung Cấp Sản Phẩm.</p>
                                  

                                 </div>

                              </div>

                           </div> -->
               <?php 

                  foreach($productdetailhome as $key => $box2){

               ?>

               <div class="wrapper_all_main_right">

                  <div class="tabs-animation">

                     <div class="bg_in">

                        <div id="nav-anchor"></div>

                        <nav class="nav-tabs">

                           <ul>

                              <li><a href="#productDetail"><i class="fa fa-info-circle" aria-hidden="true"></i> <span class="text-mobile">Chi tiết sản phẩm</span></a></li>

                            

                           </ul>

                           <div class="name-product">

                              Iphone X

                              <span class="" style="font-size:16px; color:red; padding-left:5px;">1,960,000 VNĐ</span>

                           </div>

                           <div class="ct btn-wp">

                              <div class="wp_a">

                                 <a onclick="return giohang(371);" class="view_duan">

                                 <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="text-mobile-buy">Mua hàng</span>

                                 </a>

                               <!--   <a href="tel:090 66 99 038" class="view_duan">

                                 <i class="fa fa-phone" aria-hidden="true"></i> <span class="text-mobile-buy">Gọi ngay</span>

                                 </a> -->

                                 <div class="clear"></div>

                              </div>

                           </div>

                        </nav>

                     </div>

                  </div>

                  <div class="product_detail_info">

                     <div class="module_pro_all" id="productDetail">

                        <div class="box-title">

                           <div class="title-bar">

                              <h3>Chi tiết sản phẩm</h3>

                           </div>

                        </div>

                        <div class="tab_content content_text_product content-module">

                          <?php echo $box2['body'] ?>

                        </div>

                     </div>

                     

                  </div>

                  <div class="clear"></div>

                

                  <div class="clear"></div>

                <!--   <div class="dmsub">

                     <div class="tags_products desktop">

                        <div class="tab_link">

                           <h3 class="title_tab_link">Từ khóa sản phẩm: </h3>

                           <div class="content_tab_link"> 
                            
                            <a href="tag/">Iphone x</a>

                            </div>

                        </div>

                     </div>

                  </div>
 -->
                  <!-- <div class="content-brank">

                     <p><strong>Apple </strong>tự hảo<strong>&nbsp;</strong>là thương hiệu Việt Nam về sản phẩm tủ rack 19", tủ cửa lưới, tủ treo tường, bảo vệ thiết bị mạng an toàn, dễ dàng quản lý và vận hành.</p>

                  </div> -->

                  <div class="module_pro_all">

                     <div class="box-title">

                        <div class="title-bar">

                           <h3>Sản phẩm liên quan</h3>

                        </div>

                     </div>

                     <div class="pro_all_gird">

                        <div class="girds_all list_all_other_page ">

                      <?php

                      foreach($productrelatedhome as $key => $relate){ 

                      ?>    

                       <div class="grids">

                            <div class="grids_in">

                                <div class="content">

                                    <div class="img-right-pro">



                                        <a href="<?php echo BASE_URL ?>/t/details/1">

                                            <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $relate['image'] ?>" data-original="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $relate['image'] ?>" alt="<?php echo $help->makeUrl($relate['productName']) ?>" />

                                        </a>



                                        <div class="content-overlay"></div>

                                        <div class="content-details fadeIn-top">

                                            <?php

                                            echo $relate['sum_text']; 

                                            ?>

                                           <!--  <ul class="details-product-overlay">

                                                <li>Màn hình : Super Amoled 4.5k</li>

                                                <li>Độ phân giải : 2K+(1440x3040)</li>

                                                <li>Ram : 8GB</li>

                                                <li>CPU : Android 9.0</li>

                                                <li>GPU : Mali-G76 MP12</li>

                                                <li>SSD : 512MB</li>



                                            </ul> -->



                                        </div>

                                    </div>

                                    <div class="name-pro-right">

                                        <a href="<?php echo BASE_URL ?>/t/details/<?php echo $relate['productId'] ?>/<?php echo $help->makeUrl($relate['productName']) ?>">

                                            <h3><?php echo $relate['productName'] ?></h3>

                                        </a>

                                    </div>

                                    <div class="add_card">

                                        <a onclick="return giohang(579);">

                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng

                                        </a>

                                    </div>

                                    <div class="price_old_new">

                                        <div class="price">

                                            <span class="news_price"><?php echo $help->format_currency($relate['price']).'đ' ?></span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                         <?php

                         } 

                         ?>

                           <div class="clear"></div>

                        </div>

                        <div class="clear"></div>

                     </div>

                     <div class="clear"></div>

                  </div>

               </div>

              <?php

              } 

              ?>

               <!--end:left-->

               <div class="clear"></div>

            </div>

            <div class="clear"></div>

         </div>

         

      </section>

      <!--end:body-->