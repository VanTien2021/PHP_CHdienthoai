<br>

<br>

 <footer>



    

        <div class="clear"></div>

        <div class="footer_top">

            <div class="bg_in">

              <?php

              foreach($info as $key => $get_info){ 

              ?>

                <div class="footer">

                    <div class="infor_company">

                        <h3><?php echo $get_info['name_company'] ?></h3>

                    

                    </div>

                    

                    <div class="footer-col">

                      <p>Liên hệ</p>

                       <p>Điện thoại : <?php echo $get_info['phone'] ?></p>

                       <p>Địa chỉ : <?php echo $get_info['address'] ?></p>

                    

                       <p>Email : <?php echo $get_info['email'] ?></p>
                        <p>Website : <?php echo $get_info['website_company'] ?></p>

                     


                    </div>

                   <!--   <div class="footer-col">

                      <p>Mạng xã hội</p>

                      



                    </div> -->

                     <div class="footer-col">

                      <p>Fanpage</p>

                      <div id="fb-root"></div>

                   <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>

                    <div class="fb-page" data-href="https://www.facebook.com/3Tphone-102041561201896/?__tn__=%2Cd%2CP-R&amp;eid=ARCxl0JseQZ4WF9_yt57H5mYnMKIZ5lnJD16PL71wmoawlQDn-oUA3CNjA1IRVRQ2nScPm4rPr25KOqX" data-tabs="message" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/3Tphone-102041561201896/?__tn__=%2Cd%2CP-R&amp;eid=ARCxl0JseQZ4WF9_yt57H5mYnMKIZ5lnJD16PL71wmoawlQDn-oUA3CNjA1IRVRQ2nScPm4rPr25KOqX" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/3Tphone-102041561201896/?__tn__=%2Cd%2CP-R&amp;eid=ARCxl0JseQZ4WF9_yt57H5mYnMKIZ5lnJD16PL71wmoawlQDn-oUA3CNjA1IRVRQ2nScPm4rPr25KOqX">3Tphone</a></blockquote></div>

                    </div>

                   

                    <div class="clear"></div>

                </div>

                <div class="clear"></div>

                <?php

                } 

                ?>



            </div>

        </div>

        <div class="clear"></div>

        <div class="copyright">

            <h4 class="tkw9999">&copy;  © Bản quyền thuộc về Webextrasite. Designed by <a href="http://webextrasite.com/" rel="dofollow" target="_blank">Thiet Ke Web</a> Bởi <a href="http://webextrasite.com/">3tphone.com</a></h4>

        </div>

    </footer>

    <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon">

        <a href="tel:0333387339" title="Gọi ngay cho chúng tôi">

            <div class="coccoc-alo-ph-circle"></div>

            <div class="coccoc-alo-ph-circle-fill"></div>

            <div class="coccoc-alo-ph-img-circle"></div>

        </a>

    </div>

     <link async rel="stylesheet" href="<?php echo BASE_URL ?>/teamplate/css/cssfooter.css"/>

      <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>/teamplate/css/product.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <script type="text/javascript" src="<?php echo BASE_URL ?>/teamplate/js/slick.min.js"></script>

      <script defer type="text/javascript" src="<?php echo BASE_URL ?>/teamplate/js/sweet-alert.js"></script>

      <script defer type="text/javascript" src="<?php echo BASE_URL ?>/teamplate/js/bootstrap.min.js"></script>

      <script defer type="text/javascript" src="<?php echo BASE_URL ?>/teamplate/js/jquery.flexslider-min.js"></script>

      <script defer src="<?php echo BASE_URL ?>/teamplate/js/owl.carousel.js" type="text/javascript"></script>

      <script defer src="<?php echo BASE_URL ?>/teamplate/js/jquery.lazyload.min.js" type="text/javascript"></script>

      <script defer type="text/javascript" src="<?php echo BASE_URL ?>/teamplate/js/script_ex.js"></script>

      <script defer type="text/javascript" src="<?php echo BASE_URL ?>/teamplate/js/script_menu.js"></script>
      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155030866-3"></script>


    <script data-ad-client="ca-pub-8704329899201751" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

 <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155030866-3');
</script>
      <script type="text/javascript">
  $('.responsive').slick({
  // dots: true, 
  infinite: true,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 5,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
      <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-filter').click(function(){

              var id_cat_data = $(this).data('cate');
              var id_cat = $(this).val();
              // alert(id_cat);
              $(this).addClass('border-button-home').siblings().removeClass('border-button-home');
                $.ajax({
                    url:"<?php echo BASE_URL ?>/t/fetch_product_home",
                    method:"POST",
                    data:{id_cat:id_cat},
                    success:function(data)
                    {

                      $('#pro_all_gird_'+id_cat_data).addClass('display-home-product');
                      
                      $('#fetch_home_'+id_cat_data).html(data);
                    }
            });
          });
            

        });
      </script>
    <!--   <script type="text/javascript">
        $(document).ready(function(){
         $('.btn-filter-all').click(function(){
            
              var id_cat = $(this).val();
              // alert(id_cat);
              $(this).addClass('border-button-home').siblings().removeClass('border-button-home');
               $('#fetch_home_'+id_cat).addClass('display-home-product'); 
              $('#pro_all_gird_'+id_cat).addClass('display-home-product-block');
           
              
                   
            });
          });
      </script> -->
    <script type="text/javascript">
$(document).ready(function(){
  $('#variants_one li').click(function(){
    var color_attribute = $(this).data('color_attribute');
    
    var id_product = $('#id_product').val();

    var id_list = $(this).attr('id');
     if(id_list ){
      
       $(this).addClass('active_variants').siblings().removeClass('active_variants');

     }
     $.ajax({
            url:"<?php echo BASE_URL ?>/t/fetch_color_product",
            method:"POST",
            data:{id_product:id_product,id_list:id_list},
            success:function(data)
            {

              // $('.item').addClass('display-home-product');
              // $('.item_'+color_attribute).toggleClass('display-home-product-block');
              $('#variants_two').html(data);
            }
    });
    });
  // $(document).on('click','#variants_two li',function(){

  //   var id_product_two = $('.id_pro_two').val();
  //   var id_list_two = $(this).attr('id');
  //   var id_list = $('.id_list_two').val();
  //    if(id_list_two){
  //      $(this).addClass('active_variants').siblings().removeClass('active_variants');;
  //    }
    
  //    $.ajax({
  //           url:"<?php echo BASE_URL ?>/Product/fetch_img_variants_demo",
  //           method:"POST",
  //           data:{id_product_two:id_product_two,id_list_two:id_list_two,id_list:id_list},
  //           success:function(data)
  //           {
  //             $('#img_variants_two').html(data);

  //           }
  //   });
  // });

});
</script>

    <script type="text/javascript">

      $(document).ready(function() {



        var sync1 = $("#sync1");

        var sync2 = $("#sync2");

        var slidesPerPage = 5; //globaly define number of elements per page

        var syncedSecondary = true;



        sync1.owlCarousel({

          items : 1,

          slideSpeed : 2000,

          nav: false,

          autoplay: true,

          dots: false,

          loop: true,

          responsiveRefreshRate : 200,

          navText: ['<svg width="10%" height="10%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 2px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',

          '<svg width="3%" height="3%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 2px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],

        }).on('changed.owl.carousel', syncPosition);



        sync2

          .on('initialized.owl.carousel', function () {

            sync2.find(".owl-item").eq(0).addClass("current");

          })

          .owlCarousel({

          items : slidesPerPage,

          dots: false,

          nav: false,

          smartSpeed: 200,

          slideSpeed : 500,

          slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel

          responsiveRefreshRate : 100

        }).on('changed.owl.carousel', syncPosition2);



        function syncPosition(el) {

          //if you set loop to false, you have to restore this next line

          //var current = el.item.index;

          

          //if you disable loop you have to comment this block

          var count = el.item.count-1;

          var current = Math.round(el.item.index - (el.item.count/2) - .5);

          

          if(current < 0) {

            current = count;

          }

          if(current > count) {

            current = 0;

          }

          

          //end block



          sync2

            .find(".owl-item")

            .removeClass("current")

            .eq(current)

            .addClass("current");

          var onscreen = sync2.find('.owl-item.active').length - 1;

          var start = sync2.find('.owl-item.active').first().index();

          var end = sync2.find('.owl-item.active').last().index();

          https://thietbivanphong123.com/data/upload/ST8000VN004.jpg

          if (current > end) {

            sync2.data('owl.carousel').to(current, 100, true);

          }

          if (current < start) {

            sync2.data('owl.carousel').to(current - onscreen, 100, true);

          }

        }

        

        function syncPosition2(el) {

          if(syncedSecondary) {

            var number = el.item.index;

            sync1.data('owl.carousel').to(number, 100, true);

          }

        }

        

        sync2.on("click", ".owl-item", function(e){

          e.preventDefault();

          var number = $(this).index();

          sync1.data('owl.carousel').to(number, 300, true);

        });

      });

  </script> 

  <script type="text/javascript">

     $(document).on('click', '.add_to_cart', function(){

            var product_id = $(this).attr("id");

            var product_name = $('#name'+product_id+'').val();

            var product_image = $('#image'+product_id+'').val();

            var product_price = $('#price'+product_id+'').val();

            var product_quantity = $('#quantity'+product_id).val();

            var variants_1 = $('.active_variants').attr('id');

            // var variants_2 = $('.active_variants_two').attr('id');

           

            var action = "add";

            if(product_quantity > 0)

            {

             

                $.ajax({

                    url:"<?php echo BASE_URL ?>/c/action_add_cart",

                    method:"POST",

                    data:{variants_1:variants_1,product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity,product_image:product_image, action:action},

                    success:function(data)

                    {

                       

                        swal({

                        title: "Thành công",

                        text: "Sản phẩm đã được thêm vào giỏ hàng!",

                        type: "success",

                        showCancelButton: true,

                        confirmButtonColor: '#F19F00',

                        confirmButtonText: 'Xem giỏ hàng',

                        cancelButtonText: "Tiếp tục mua",

                        closeOnConfirm: false,

                         },

                         function(isConfirm){

                         if (isConfirm){

                           window.location= '<?php echo BASE_URL ?>/c';

                         } else {

                           closeOnCancel: true; 

                         }

                         });

                        }

                });

            }

            else

            {

                alert("Làm ơn điền số lượng lớn hơn 0");

            }

          

        });

  </script>

  <script type="text/javascript">

      $('#nhaplai').click(function(){

      $('.payfast_name').text('');

      $('.payfast_phone').text('');

      $('.payfast_address').text('');

      $('.payfast_email').text('');

      $('.payfast_note').text('');

    });

  </script>

 

  <script type="text/javascript">

    $('.btn-thanhtoan').click(function(){

     
      
      var payfast_name =  $('.payfast_name').val();

      var payfast_phone =  $('.payfast_phone').val();

      var payfast_address =  $('.payfast_address').val();

      var payfast_email =  $('.payfast_email').val();

      var payfast_note =  $('.payfast_note').val();

      if(payfast_name=='' || payfast_phone=='' || payfast_address == '' || payfast_email=='' || payfast_note==''){

        alert('Làm ơn không để trống');

      }else{

        $.ajax({

              url:"<?php echo BASE_URL ?>/c/CheckOut",

              method:"POST",

              data:{payfast_name:payfast_name,payfast_phone:payfast_phone,payfast_address:payfast_address,payfast_email:payfast_email,payfast_note:payfast_note},

              success:function(data)

              {

                  alert('Gửi đơn hàng thành công');

                  location.reload();



              }

         });

      }

     



     

    });

  </script>
  <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v4.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="102041561201896"
    theme_color="#ffc300"
    logged_in_greeting="Chào bạn ! Shop có thể giúp gì cho bạn?"
    logged_out_greeting="Chào bạn ! Shop có thể giúp gì cho bạn?">
        </div>
    <!-- <link rel="stylesheet" type="text/css" href="template/Default/js/sweet-alert.css"/> -->

    

    <link rel="stylesheet" href="<?php echo BASE_URL ?>/teamplate/css/font-awesome.min.css" type="text/css" />

    <!-- link rel="stylesheet" href="template/Default/css/responsive.css" type="text/css" /> -->

  

    <div style="height: 1840px;position: fixed;width: 100%;top: 0px;left: 0px;right: 0px;bottom: 0px;z-index: 1001;background: #000 none repeat scroll 0% 0%;opacity: 0.3;display: none;text-align:center" id="khungnen"></div>

    <div style="display: none;left: 70%;margin-left: -309px;z-index: 1002;position: fixed;top: 40%;margin-top: 0px;" id="loadding">

        <img src="image/loader.gif" />

    </div>
  
</body>



</html>