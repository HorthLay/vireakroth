<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('pic/vireakroth.png') }}">
    <title>VireakRoth PhoneShop - Home📱</title>

    <!-- Bootstrap core CSS -->
    <link href="homes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="homes/assets/css/fontawesome.css">
    <link rel="stylesheet" href="homes/assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="homes/assets/css/owl.css">
    <link rel="stylesheet" href="homes/assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="https://kit.fontawesome.com/a2e0f9e6a3.js" crossorigin="anonymous"></script> --}}


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
            bottom: 20px;
            /* Distance from the bottom of the screen */
            right: 20px;
            /* Distance from the right side of the screen */
            background-color: #007bff;
            /* Button background color */
            color: white;
            /* Text color */
            padding: 15px 20px;
            border-radius: 50%;
            /* Round button */
            font-size: 24px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
            /* Ensure it stays on top */
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
            line-height: 18px;
            /* Centers the number vertically */
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

        .footer p,
        .footer li {
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
                    <span class="breadcrumb"><a href="#">Home</a> > Contact Us</span>
                </div>
            </div>
        </div>
    </div>

    <section class="py-16 bg-gradient-to-br from-white via-gray-50 to-blue-50">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left Section -->
                <div class="space-y-6">
                    <div>
                        <p class="text-blue-600 font-semibold uppercase tracking-widest text-sm mb-2">Contact Us</p>
                        <h2 class="text-4xl font-bold text-gray-800 mb-4">Hello 👋</h2>
                        <p class="text-gray-600 leading-relaxed">
                            <strong class="text-blue-600">VireakRoth Phone Shop</strong> — your trusted place to buy,
                            sell,
                            or order your next device. We’re here to help you with any questions or requests.
                        </p>
                    </div>

                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <div
                                class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-xl mr-3">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="font-semibold">Address:</span><br>
                                PHUM2, SihanoukVille, Cambodia
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-xl mr-3">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <span class="font-semibold">Phone:</span><br>
                                +855 96 6011 905
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-xl mr-3">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <span class="font-semibold">Email:</span><br>
                                vireakroth@gmail.com
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Right Section -->
                <div class="relative rounded-2xl overflow-hidden shadow-xl border border-gray-100">
                    <div class="aspect-[4/3]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.351270885132!2d103.51499407480273!3d10.629795189510196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3107e1b7afac750b%3A0xab2f286eb3d0e423!2sKamakor%20St%2C%20Preah%20Sihanouk!5e0!3m2!1sen!2skh!4v1761107208016!5m2!1sen!2skh"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-gray-900/60 to-transparent p-4 text-white text-sm">
                        <p class="font-medium">Find us on Google Maps</p>
                    </div>
                </div>

            </div>
        </div>
    </section>



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
