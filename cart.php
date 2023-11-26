 <?php

  include_once('app/helper/Helper.php');

  $help = new Helper();

?> 

<section>

   <div class="bg_in">

      <div class="content_page cart_page">

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

                  Giỏ hàng

                  </strong>

                  </span>

                  <meta itemprop="position" content="2" />

               </li>

            </ol>

         </div>

         <div class="box-title">

            <div class="title-bar">

               <h1>Giỏ hàng của bạn</h1>

            </div>

         </div>              

         <?php



      if(!empty($_GET['msg'])){



        $msg = unserialize(urldecode($_GET['msg']));



        foreach ($msg as $key => $value){



          echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';



        }



      }



      ?>

         <div class="content_text">

            <div class="container_table">

               <?php

               $total_price = 0;

               $total_item = 0;

                ?>

               

               <table class="table table-hover table-condensed">

                  <thead>

                     <tr class="tr tr_first">

                       

                        <th>Tên sản phẩm</th>
                        <th>Tùy chọn màu</th>

                        <th>Hình ảnh</th>

                        <th>Giá tiền</th>

                        <th style="width:100px;">Số lượng</th>

                        <th>Thành tiền</th>

                        <th style="width:50px; text-align:center;"></th>

                     </tr>

                  </thead>

                  <tbody>

                     <form action='<?php echo BASE_URL ?>/c/UpdateCart' method="post">

                        <?php

                      if(!empty($_SESSION["shopping_cart"]))

                          {

                              foreach($_SESSION["shopping_cart"] as $keys => $cart)

                              {

                                 $subtotal = 0;
                                 if($cart['product_variants']){
                                    $subtotal = $cart['product_quantity']*$cart['price_change'];
                                 }else{
                                    $subtotal = $cart['product_quantity']*$cart['product_price'];
                                 }
                                 $total_price +=$subtotal;

                                

                        ?>

                        <tr class="tr">

                          

                           <td data-th="Sản phẩm">

                              <div class="col_table_name">

                                 <h4 class="nomargin"><?php echo $cart['product_name']  ?></h4>

                              </div>

                           </td>
                            <td data-th="Tùy chọn">

                              <div class="col_table_name">
                                 <?php 
                                 if($cart['product_variants']==''){
                                 ?>
                                  <h4 class="nomargin">Giá thường</h4>
                                 <?php
                                 }else{ 
                                 ?>
                                  <h4 class="nomargin"><?php echo $cart['product_variants']  ?></h4>
                                 <?php 
                                    }
                                  
                                 ?>
                                

                              </div>

                           </td>

                           <td data-th="Hình ảnh">

                              <div class="col_table_image col_table_hidden-xs"><img src="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $cart['product_image']  ?>" class="img-responsive" /></div>

                           </td>

                           <td data-th="Mã sản phẩm">

                              <div class="col_table_name">

                                 <h4 class="nomargin">

                                    <?php
                                    if($cart['product_variants']){
                                     echo $help->format_currency($cart['price_change']).'đ';
                                     }else{
                                     echo $help->format_currency($cart['product_price']).'đ'; 
                                     }
                                     ?>
                                       
                                    </h4>

                              </div>

                           </td>

                          

                           <td data-th="Số lượng">

                              <div class="clear margintop5">

                                 <div class="floatleft">

                                    <input type="number" class="inputsoluong" min="1" name="quantity[<?php echo $cart['product_token'] ?>]" value="<?php echo $cart['product_quantity'] ?>">
                                  
                                 </div>

                                 <button type="submit"  name="update" ><span><i class="fa fa-refresh"></i></span></button>
                                

                                

                              </div>

                              <div class="clear"></div>

                           </td>

                           <td data-th="Thành tiền" class="text_center"><span class="color_red font_money"><?php echo $help->format_currency($subtotal).'đ' ?></span></td>

                           <td class="actions aligncenter" data-th="">
                             
                                      <a class="delete_link" href="<?php echo BASE_URL ?>/c/DelCart/<?php echo $cart['product_id'] ?>/?token=<?php echo $cart['product_token'] ?>">Xóa</a>

                           </td>

                        </tr>

                        <?php

                           }

                       

                        ?>

                     </form>

                     <tr>

                        <td colspan="7" class="textright_text">

                           <div class="sum_price_all">

                             

                              <span class="text_price">Tổng tiền thành toán</span>:

                              <span class="text_price color_red"><?php echo $help->format_currency($total_price).'đ' ?></span>

                           </div>

                        </td>

                     </tr>

                     <?php

                     }else{ 

                     ?>

                      <tr>

                        <td colspan="7">

                          

                              <span style="font-size: 15px">Giỏ hàng hiện đang trống</span>

                             

                         

                        </td>

                     </tr>

                     <?php

                     } 

                     ?>

                  </tbody>

                  <tfoot>

                     <tr class="tr_last">

                        <td colspan="7">

                           <a href="<?php echo BASE_URL ?>" class="btn_df btn_table floatleft"><i class="fa fa-long-arrow-left"></i> Tiếp tục mua hàng</a>

                           

                           <div class="clear"></div>

                        </td>

                     </tr>

                  </tfoot>

               </table>

            </div>

            <div class="contact_form">

               <div class="contact_left">

                  <div class="ch-contacts-details">

                     <ul class="contact-list">

                        <li class="addr">

                           <strong class="title">Địa chỉ của chúng tôi</strong>

                           <p><em><strong>3tphone</strong></em>

                              <br />

                           <p>Trung Tâm Bán Hàng:</p>

                           <p>244A Nguyễn Văn Luông, Phường 11, Quận 6, TP.HCM</p>

                          

                           </p>

                        </li>

                     </ul>

                     <div class="hiring-box">

                        <strong class="title">Chào bạn!</strong>

                        <p>Mọi thắc mắc bạn hãy gửi về mail của chúng tôi <strong>3tphoneshop@gmail.com</strong> chúng tôi sẽ giải đáp cho bạn.</p>

                        <p><a href="<?php echo BASE_URL ?>" class="arrow-link"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Về trang chủ</a></p>

                     </div>

                  </div>

               </div>



               <div class="contact_right">

                  <div class="form_contact_in">

                     <div class="box_contact">

                        <form name="FormDatHang" method="post" action="gio-hang/">

                           <div class="content-box_contact">

                              <div class="row">

                                 <div class="input">

                                    <label>Họ và tên: <span style="color:red;">*</span></label>

                                    <input type="text" name="payfast_name" required class="clsip payfast_name">

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <!---row---->

                              <div class="row">

                                 <div class="input">

                                    <label>Số điện thoại: <span style="color:red;">*</span></label>

                                    <input type="text" name="payfast_phone" required onkeydown="return checkIt(event)" class="clsip payfast_phone">

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <!---row---->

                              <div class="row">

                                 <div class="input">

                                    <label>Địa chỉ: <span style="color:red;">*</span></label>

                                    <input type="text" name="payfast_address" required class="clsip payfast_address">

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <!---row---->

                              <div class="row">

                                 <div class="input">

                                    <label>Email: <span style="color:red;">*</span></label>

                                    <input type="text" name="payfast_email" onchange="return KiemTraEmail(this);" required class="clsip payfast_email">

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <!---row---->

                              <div class="row">

                                 <div class="input">

                                    <label>Nội dung: <span style="color:red;">*</span></label>

                                    <textarea type="text"  name="payfast_note" class="clsipa payfast_note"></textarea>

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <!---row---->

                              <div class="row btnclass">

                                 <div class="input ipmaxn ">

                                    <input type="button" class="btn-gui btn-thanhtoan" name="frmSubmit" id="frmSubmit" value="Xác nhận thông tin">



                                    <input type="reset" id="nhaplai" class="btn-gui" value="Nhập lại">

                                 </div>

                                 <div class="clear"></div>

                              </div>

                              <!---row---->

                              <div class="clear"></div>

                           </div>

                        </form>

                     </div>

                   



                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</section>



<!---End bg_in----->

<div class="clear"></div>