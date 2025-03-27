<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>VireakRoth PhoneShop - Home📱</title>

    <!-- Bootstrap core CSS -->
    <link href="homes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="homes/assets/css/fontawesome.css">
    <link rel="stylesheet" href="homes/assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="homes/assets/css/owl.css">
    <link rel="stylesheet" href="homes/assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <style>
        /* Success Message Styling */
    .success-message {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        position: fixed;
        top: 20px;
        right: 20px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        z-index: 1000;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease-in-out;
    }

    .success-message.show {
        opacity: 1;
        transform: translateX(0);
    }

    .success-message .close-btn {
        color: white;
        font-size: 20px;
        background: transparent;
        border: none;
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
    }

    .success-message .close-btn:hover {
        color: #ffffff;
    }

           /* Floating cart button */
.popup-cart-btn {
    position: fixed;
    bottom: 20px; /* Distance from the bottom of the screen */
    right: 20px; /* Distance from the right side of the screen */
    background-color: #007bff; /* Button background color */
    color: white; /* Text color */
    padding: 15px 20px;
    border-radius: 50%; /* Round button */
    font-size: 24px;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    z-index: 1000; /* Ensure it stays on top */
    transition: all 0.3s ease-in-out;
}

/* Hover effect */
.popup-cart-btn:hover {
    background-color: #0056b3;
}

/* Cart count styling (small red circle) */
.cart-count {
    position: absolute;
    top: 10px;
    right: 5px;
    background-color: red;
    color: white;
    font-size: 12px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    text-align: center;
    line-height: 18px; /* Centers the number vertically */
    font-weight: bold;
}


      /* Footer Styling */
      .footer {
            background-color: #141414;
            color: #f1f1f1;
            padding: 40px 0;
            font-size: 14px;
        }

        .footer h5 {
            color: #000000;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .footer p, .footer li {
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .footer a {
            color: #fff700;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #ff3300;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links li a {
            display: inline-block;
        }

        .footer .social-icons {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .footer .social-icon {
            width: 40px;
            height: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 50%;
            background: #312aff;
            padding: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .footer .social-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer .row {
            margin-bottom: 30px;
        }

        .footer .text-center {
            border-top: 1px solid #444;
            padding-top: 15px;
            margin-top: 20px;
        }

    </style>


   
<!--

  

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
 @include('home.header')
  <!-- ***** Header Area End ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>Contact Us</h3>
          <span class="breadcrumb"><a href="#">Home</a>  >  Contact Us</span>
        </div>
      </div>
    </div>
  </div>

 <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="left-text">
            <div class="section-heading">
              <h6>Contact Us</h6>
              <h2>Say Hello!</h2>
            </div>
            <p>LUGX Gaming Template is based on the latest Bootstrap 5 CSS framework. This template is provided by TemplateMo and it is suitable for your gaming shop ecommerce websites. Feel free to use this for any purpose. Thank you.</p>
            <ul>
              <li><span>Address</span> Sunny Isles Beach, FL 33160, United States</li>
              <li><span>Phone</span> +123 456 7890</li>
              <li><span>Email</span> lugx@contact.com</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-content">
            <div class="row">
              <div class="col-lg-12">
                <div id="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth" width="100%" height="325px" frameborder="0" style="border:0; border-radius: 23px;" allowfullscreen=""></iframe>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

 
 @include('home.footer')

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->

  
  <script src="homes/vendor/jquery/jquery.min.js"></script>
  <script src="homes/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="homes/assets/js/isotope.min.js"></script>
  <script src="homes/assets/js/owl-carousel.js"></script>
  <script src="homes/assets/js/counter.js"></script>
  <script src="homes/assets/js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  </body>
</html>