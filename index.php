<?php include('./admin/include/connection1.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include("include/head.php"); ?>

<body>
   <!--================  Header-Section ================= -->
   <?php include("include/header.php"); ?>
   <!--================ Header-Section =================-->
   <!--================ Banner-Section =================-->
   <!-- START main Slider REVOLUTION SLIDER 6.2.22 -->
   <p class="rs-p-wp-fix"></p>
   <rs-module-wrap id="rev_slider_2_1_wrapper" data-alias="home-slider-1" data-source="gallery"
      style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0; width: 100%;">
      <rs-module id="rev_slider_2_1" data-version="6.2.22">

         <rs-slides>

            <?php
            $i = 0;
            $sql = "SELECT * FROM silde WHERE status='Active' ORDER BY id ASC";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
               $i++;
            ?>
               <rs-slide data-key="rs-<?php echo $i; ?>" data-title="Slide"
                  data-thumb="./rev-slider/assets/<?php echo $row['image']; ?>"
                  data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:0;">

                  <img src="./rev-slider/assets/<?php echo $row['image']; ?>"
                     title="<?php echo $row['image']; ?>" width="1920" height="1080"
                     class="rev-slidebg" data-no-retina>

                  <!-- First text layer -->
                  <rs-layer id="slider-2-slide-<?php echo $i; ?>-layer-0" data-type="text" data-rsp_ch="on"
                     data-xy="x:c;y:m;yo:-10px,-7px,-5px,-3px;"
                     data-text="w:normal;s:82,64,52,32;l:90,72,62,38;ls:1px,0px,0px,0px;fw:800;a:center;"
                     data-frame_1="e:power4.inOut;st:1200;sp:1000;" data-frame_1_sfx="se:blocktoleft;"
                     data-frame_999="o:0;st:w;"
                     style="z-index:9;font-family:Montserrat;text-transform:uppercase;">
                     <?php echo $row['heading_1']; ?><br /> <?php echo $row['heading_2']; ?>
                  </rs-layer>

                  <!-- Background heading -->
                  <rs-layer id="slider-2-slide-<?php echo $i; ?>-layer-2" data-type="text"
                     data-color="rgba(255, 255, 255, 0.2)" data-rsp_ch="on"
                     data-xy="x:c;y:m;yo:-60px,-37px,-109px,-57px;"
                     data-text="s:140,110,100,61;l:148,116,110,67;ls:1px,0px,0px,0px;fw:800;a:center;"
                     data-border="boc:#ff3a2d;bow:10px,0,0,0;" data-frame_1="e:power4.inOut;st:600;sp:1000;"
                     data-frame_1_sfx="se:blocktoright;" data-frame_999="o:0;st:w;"
                     style="z-index:8;font-family:Montserrat;text-transform:uppercase;-webkit-text-fill-color:transparent;-webkit-text-stroke-width:2px;">
                     <?php echo $row['back_heading']; ?>
                  </rs-layer>

                  <!-- First button -->
                  <rs-layer id="slider-2-slide-<?php echo $i; ?>-layer-4" class="rev-btn" data-type="button"
                     data-rsp_ch="on" data-xy="x:c;xo:-100px,-88px,-96px,-76px;y:m;yo:130px,102px,103px,73px;"
                     data-text="w:normal;s:16,16,16,14;l:32,32,32,30;fw:500;a:center;"
                     data-dim="minh:0px,none,none,none;" data-padding="t:10,8,10,6;r:30,24,30,19;b:10,8,10,6;l:30,24,30,19;"
                     data-frame_1="e:power4.inOut;st:1800;sp:1000;" data-frame_1_sfx="se:blocktoright;"
                     data-frame_999="o:0;st:w;" data-frame_hover="c:#fff;bgc:#fff;bor:0px,0px,0px,0px;"
                     style="z-index:11;background-color:#b3b312;font-family:Montserrat; color:#ffffff;">
                     <a href="#about" style="color: var(--dark-color);"> Explore More </a><br />
                  </rs-layer>

                  <!-- Second button -->
                  <rs-layer id="slider-2-slide-<?php echo $i; ?>-layer-8" class="rev-btn" data-type="button"
                     data-color="#b3b312" data-rsp_ch="on"
                     data-xy="x:c;xo:100px,88px,96px,76px;y:m;yo:130px,102px,103px,73px;"
                     data-text="w:normal;s:16,16,16,14;l:32,32,32,30;fw:500;a:center;"
                     data-dim="minh:0px,none,none,none;" data-padding="t:10,8,10,6;r:30,24,30,19;b:10,8,10,6;l:30,24,30,19;"
                     data-frame_1="e:power4.inOut;st:1800;sp:1000;" data-frame_1_sfx="se:blocktoleft;"
                     data-frame_999="o:0;st:w;" data-frame_hover="c:#fff;bgc:#b3b312;bor:0px,0px,0px,0px;"
                     style="z-index:10;background-color:#ffffff;font-family:Montserrat;">
                     <a href="#contact" class="content-img"> <?php echo $row['btn_name']; ?> </a><br />
                  </rs-layer>
               </rs-slide>
            <?php } ?>

         </rs-slides>
      </rs-module>
   </rs-module-wrap>

   <!-- END REVOLUTION SLIDER -->
   <!--================ Banner-Section  ================= -->
   <!--=============== About-us-Section  ==================-->
   <section class="about-us" id="about">
      <div class="container">
         <div class="row">
            <div class="col-xl-6">
               <div class="img1">
                  <img src="images/main-home/16.jpg" alt="demo-img">
               </div>
               <div class="img2">
                  <img src="images/main-home/17.jpg" alt="demo-img">
               </div>
               <div class="img3 wow animate__fadeInRight">
                  <img src="images/main-home/18.png" alt="demo-img">
               </div>
            </div>
            <div class="col-xl-6 pt-lg-5 pt-5 text-lg-center text-xl-left text-center">
               <div class="pt-title-section ">
                  <div class="pt-section-title-box ">
                     <span class="pt-section-sub-title">About</span>
                     <h2 class="pt-section-title">About Us</h2>
                     <h3 style="padding-top: 30px;">At oxygym.</h3>
                  </div>

                  <p class="pt-section-description" style="padding-top:5px;"> <strong style="color:#b3b312; font-size:20px;">Established in 2002, </strong>we've been empowering individuals to reach their fitness goals for over two decades. our mission has always been clear: to provide a welcoming, results driven environment where every member can unlock their full potential. Whether you're just starting your fitness journey or are a seasoned athlete, we offer a comprehensive range of services to meet your needs, including expert personal training, group classes, and state-of-the-art equipment. Our experienced trainers, supportive community, and dedication to your success make OxyGym more than just a gym - it's a place where goals are achieved and fitness is transformed into a lifestyle.
                  </p>
                 
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--=============== About-us-Section  ==================-->
   <!--================= Why-Us-Section ================-->
   <section class="pt-fancy-box pt-0 pb-0" id="choose">
      <div class="container-fluid px-0">

         <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-xl-8 text-center">
               <div class="pt-section-title-box">
                  <span class="pt-section-sub-title"> Why Us</span>
                  <h2 class="pt-section-title">Why Us</h2>
               </div>
            </div>
            <div class="col-lg-2"></div>
         </div>

         <div class="row no-gutters">
            <div class="col-xl-3 col-md-6">
               <div class="pt-fancy-box pt-fancybox-1 text-center">
                  <div class="pt-fancy-media"><i class="flaticon-runner"></i></div>
                  <div class="pt-fancybox-info">
                     <h4 class="pt-fancy-box-title">Convenient Location</h4>
                     <p class="pt-fancybox-description">The gym is located in an area with sample, easy-to-find parking. It is located on the main road and near the Greater Kailash metro station, making it hassle free for you.
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6 d-inline-block">
               <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="false" data-desk_num="1"
                  data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1" data-autoplay="true"
                  data-loop="true" data-margin="30">
                  <div>
                     <img src="images/main-home/5.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">01</h5>
                  </div>
                  <div>
                     <img src="images/main-home/6.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">01</h5>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="pt-fancy-box pt-fancybox-1 pt-fancy text-center">
                  <div class="pt-fancy-media"><i class="flaticon-gym" style="color:#111111"></i></div>
                  <div class="pt-fancybox-info">
                     <h4 class="pt-fancy-box-title" style="color:#111111">Experienced Trainers</h4>
                     <p class="pt-fancybox-description" style=" color:#111111">Knowledgeable and certified trainers are
                        here to help you to reach your goals and motivate you throughout your fitness journey.
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6 d-inline-block">
               <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="false" data-desk_num="1"
                  data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1" data-autoplay="true"
                  data-loop="true" data-margin="30">
                  <div>
                     <img src="images/main-home/13.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">02</h5>
                  </div>
                  <div>
                     <img src="images/main-home/14.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">02</h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="row no-gutters">
            <div class="col-xl-3 col-md-6 d-inline-block">
               <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="false" data-desk_num="1"
                  data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1" data-autoplay="true"
                  data-loop="true" data-margin="30">
                  <div>
                     <img src="images/main-home/8.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">03</h5>
                  </div>
                  <div>
                     <img src="images/main-home/7.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">03</h5>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="pt-fancy-box pt-fancybox-1  pt-fancy text-center">
                  <div class="pt-fancy-media"><i class="flaticon-strength" style="color:#111111"></i></div>
                  <div class="pt-fancybox-info">
                     <h4 class="pt-fancy-box-title" style="color:#111111">Cleanliness & Hygiene Standards</h4>
                     <p class="pt-fancybox-description" style="color:#111111">Cleanliness is our top priority. We ensure
                        a pleasant experience for our clients.
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6 d-inline-block">
               <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="false" data-desk_num="1"
                  data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1" data-autoplay="true"
                  data-loop="true" data-margin="30">
                  <div>
                     <img src="images/main-home/1.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">04</h5>
                  </div>
                  <div>
                     <img src="images/main-home/4.jpg" class="img-fluid img-8">
                     <h5 class="big-heading-title1 mt-sm-0 wow animate__fadeInRight" data-wow-duration="1s"
                        data-wow-delay="1s">04</h5>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="pt-fancy-box pt-fancybox-1 text-center">
                  <div class="pt-fancy-media"><i class="flaticon-weight-lifting"></i></div>
                  <div class="pt-fancybox-info">
                     <h4 class="pt-fancy-box-title">Affordability</h4>
                     <p class="pt-fancybox-description">Our membership options deliver value to our clients.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--=============== Why-Us-Section ==================-->


   <!--=============== Gols-Section ==================-->
   <section class="icon-box wow animate__fadeIn" data-wow-delay="0.2s">
      <div class="container">
         <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-xl-8 text-center">
               <div class="pt-section-title-box">
                  <span class="pt-section-sub-title">GOALS</span>
                  <h2 class="pt-section-title">SET HIGH FITNESS GYM GOALS</h2>
                  <p class="pt-section-description">We've been empowering individuals to reach their fitness goals
                  </p>
               </div>
            </div>
            <div class="col-lg-2"></div>
         </div>
         <div class="row">
            <div class="col-xl-4 col-md-6 ">
               <div class="pt-icon-box-section text-center">
                  <div class="pt-icon-box-icon">
                     <span class="pt-icon">
                        <i aria-hidden="true" class="flaticon-lunges"></i> </span>
                  </div>
                  <div class="pt-icon-box-content">
                     <h6 class="pt-icon-box-title">
                        <span>Build Muscle and Strength</span>
                     </h6>
                     <p class="pt-icon-box-description">Maximize strength and muscle definition with our customized
                        weightlifting programs.</p>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-md-6 ">
               <div class="pt-icon-box-section text-center">
                  <div class="pt-icon-box-icon">
                     <span class="pt-icon">
                        <i aria-hidden="true" class="flaticon-dumbbell-1"></i> </span>
                  </div>
                  <div class="pt-icon-box-content">
                     <h6 class="pt-icon-box-title">
                        <span>Master Complex Skills</span>
                     </h6>
                     <p class="pt-icon-box-description">Learn gymnastic and strength skills like pull-ups, handstands,
                        or advanced lifts.</p>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-md-6 ">
               <div class="pt-icon-box-section text-center">
                  <div class="pt-icon-box-icon">
                     <span class="pt-icon">
                        <i aria-hidden="true" class="flaticon-cardio"></i> </span>
                  </div>
                  <div class="pt-icon-box-content">
                     <h6 class="pt-icon-box-title">
                        <span>High Level of Mental Resilience</span>
                     </h6>
                     <p class="pt-icon-box-description">Train the mind along with the body for lasting success and
                        discipline.</p>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </section>
   <!--=============== Gols-Section ==================-->

   <!--=================================
         Gallery-Section-->
   <section class="portfoliyo pt-bg-light pb-0" id="gallery">
      <div class="container-fluid px-0">
         <div class="row no-gutters">
            <div class="col-xl-3"></div>
            <div class="col-xl-6 text-center">
               <div class="pt-section-title-box">
                  <h2 class="pt-section-title">VIEW OUR GALLERY</h2>
                  <p class="pt-section-description">Welcome to the OxyGym gallery! Explore moments of transformation, dedication, and community. Our state-of-the-art facilities, dynamic group classes, and expert personal training come together to inspire fitness journeys for all. See how OxyGym empowers members to achieve their goals and make fitness a lifestyle!
                  </p>
               </div>
            </div>
            <div class="col-xl-3">
            </div>
         </div>
         <section class="gallery">
            <div class="row no-gutters">

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05638-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05643-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05648-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05653-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05663-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05678-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05703-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="pt-portfolio-block-one">
                     <div class="pt-portfolio-img">
                        <div class="card">
                           <img src="./images/gallery/AAA05713-HDR.jpg" class="gallery-item" alt="gallery">
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-lg-12  mt-5">
                  <div class="pt-button-block" style="display:flex; justify-content:center;">
                     <a class="pt-button" href="gallery.php">View All</a>
                  </div>
               </div>

            </div>


         </section>

         <!-- Modal -->
         <div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                  </div>
                  <div class="modal-body">
                     <img src="img/1.jpg" class="modal-img" alt="modal img">
                  </div>
               </div>
            </div>
         </div>



      </div>
   </section>
   <!--=============== Gallery-section==================-->


   <!--=============== Resgister-section==================-->
   <section class="video pt-bg-dark">
      <div class=" pt-bg-overley pt-opacity1" style="background-image: url('images/main-home/19.png');">
      </div>
      <div class="container">
         <div class="row d-flex justify-content-center">
            <div class="col-12 mt-xl-5">
               <div class="pt-section-title-box text-center">
                  <a href="registration.php"><span
                        class="pt-section-sub-title pt-section-sub-title1 pt-opacity">Register </span></a>
                  <h2 class="pt-section-title text-white">Register Now</h2>
                  <p class="pt-section-description text-white">Join OxyGym today and unlock your full fitness potential with expert training, top-notch equipment, and a supportive community. Start your journey to a healthier, stronger you—register now!
                  </p>
               </div>
            </div>
            <div class="col-lg-4 text-center">
               <div class="pt-btn-container">
                  <div class="pt-button-block">
                     <a class="pt-button" href="registration.php">
                        <span class="pt-button-line-left"></span>
                        <span class="text">Register Now</span>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-12 "></div>
         </div>
      </div>
   </section>
   <!--=============== Register-section==================-->





   <!--=================================
         contect-us-->
   <section class="contect-us pt-bg-light" id="contact">
      <div class="container">
         <div class="row d-flex align-items-center">
            <div class="col-xl-6 col-12 mt-xl-0  mt-5 mt-md-0">
               <div class="pt-section-title-box">
                  <h2 class="pt-section-title">For Any Queries</h2>
                  <p class="pt-section-description"><strong style="color:#b3b312; font-size:20px;">Established in 2002, </strong>we've been empowering individuals to reach their fitness goals for over two decades. our mission has always been clear: to provide a welcoming, results driven environment where every member can unlock their full potential.
                  </p>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="contact-info">
                        <div class="contact-info-icon">
                           <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                           <h5>Our Office Address:</h5>
                           <p class="mb-0">B 25 Greater Kailash 2 Enclave <br> Opp Savitri Cinema ( Opp Cinepolis ) <br> New Delhi-110048.</p>
                        </div>
                     </div>
                     <div class="contact-info">
                        <div class="contact-info-icon">
                           <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-info-content">
                           <h5>Call Us:</h5>
                           <p class="mb-0"><a href="tel:+91 98104 59310">+91 98104 59310,</a>
                           <a href="tel:+91 8800 909882">+91 8800 909882,</a>
                           <a href="tel:+91 9560870616">+91 9560870616</a></p>
                        </div>
                     </div>
                     <div class="contact-info">
                        <div class="contact-info-icon">
                           <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                           <h5>Mail us</h5>
                           <a href="mailto:info@oxygymgk.com"><p class="mb-0">info@oxygymgk.com</p></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-6 col-lg-12 pt-xl-3 mb-md-0 ">
               <div class="pt-bg-light">
                  <form class="quote-from">
                     <div class="row mt-5">
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" class="form-control" id="exampleInputName" placeholder="Enter name">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="email" class="form-control" id="Email" placeholder="Enter email">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <input type="text" class="form-control" id="Subject1" placeholder="Enter subject">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"
                                 placeholder="Enter your message"></textarea>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <input type="submit" value="Send Message" class="wpcf7-form-control wpcf7-submit">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--=================================
               contect-us-->

   <!--=================================
         footer-->
   <?php include("include/footer.php"); ?>
   <!--=================================
         footer-->
   <!--=================================
         Back To Top-->
   <div id="back-to-top">
      <a class="topbtn" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
   </div>
   <!--=================================
         Back To Top-->
   <?php include("include/foot.php"); ?>

</body>
<script>
   'undefined' === typeof _trfq || (window._trfq = []);
   'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
      'tccl.baseHost': 'secureserver.net'
   }, {
      'ap': 'cpbh-mt'
   }, {
      'server': 'sg2plmcpnl492384'
   }, {
      'dcenter': 'sg2'
   }, {
      'cp_id': '9858662'
   }, {
      'cp_cache': ''
   }, {
      'cp_cl': '8'
   })
</script>
<script src='../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>


</html>