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

.left-image img,
.related-games .thumb img {
   border-radius: 8px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   transition: transform 0.3s ease, box-shadow 0.3s ease;
   max-width: 100%;
   height: auto;
}

.left-image img:hover,
.related-games .thumb img:hover {
   transform: scale(1.05);
   box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.related-games .thumb {
   overflow: hidden;
   margin: 10px 0;
}

.related-games .item {
   text-align: center;
   margin-bottom: 20px;
}

.related-games .item h4 {
   font-size: 18px;
   font-weight: 600;
   margin: 10px 0 5px;
}

.related-games .thumb img {
   max-width: 200px;
   height: auto;
   margin: 0 auto;
}

.related-games .thumb a::after {
   content: "Quick View";
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   background: rgba(0, 0, 0, 0.7);
   color: #fff;
   padding: 10px 15px;
   border-radius: 5px;
   opacity: 0;
   transition: opacity 0.3s ease;
}

.related-games .thumb a:hover::after {
   opacity: 1;
}
</style>