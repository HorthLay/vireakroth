<style>
    /* General Styling */
    body {
        font-size: 16px;
        line-height: 1.5;
    }

    h4 {
        font-size: 18px;
    }

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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
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



   
    /* Product Item Styling */
    .trending-box .trending-items .item {
        padding: 10px;
        margin: 15px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .trending-box .thumb img {
        width: 100%;
        border-radius: 3px;
    }

    .trending-box .down-content {
        text-align: center;
    }

    .trending-box .down-content h4 {
        margin: 10px 0 5px;
        font-size: 16px;
        font-weight: bold;
    }

    .trending-box .down-content .price {
        font-size: 14px;
        color: #3238e4;
        margin-top: 5px;
    }

    .trending-box .down-content .btn {
        font-size: 14px;
        padding: 5px 10px;
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

    /* Responsive Styling */
    @media (max-width: 768px)  {
        body {
            font-size: 14px;
        }

        h4 {
            font-size: 16px;
        }

        .success-message {
            width: 90%;
        }

        .trending-box .trending-items .item {
            margin: 10px 0;
        }

        .trending-box .thumb img {
            max-width: 100%;
            height: auto;
        }

        .trending-filter {
            flex-wrap: wrap;
            text-align: center;
        }

        .pagination {
            justify-content: center;
        }
    }

    .trending-box .down-content .price {
font-size: 14px; /* Default font size */
}

/* Media Query for Small Screens */
@media (max-width: 576px) {
.trending-box .down-content .price {
    font-size: 10px; /* Smaller font size for mobile screens */
}
}






</style>