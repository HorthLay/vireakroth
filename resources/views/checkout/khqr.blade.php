<script>
    document.addEventListener("DOMContentLoaded", function () {
        const KHQR = typeof BakongKHQR !== 'undefined' ? BakongKHQR : null;
    
        if (!KHQR) {
            console.error("BakongKHQR or its components are not loaded or defined.");
            return;
        }
    
        const totalPrice = {{ $totalPrice }};
        const orderNumber = "{{ $order_number }}";
        const data = KHQR.khqrData;
        const info = KHQR.IndividualInfo;
    
        const optionalData = {
            currency: data.currency.usd,
            amount: totalPrice, // Adjusted for testing with minimal amount
            mobileNumber: "85512233455",
            storeLabel: "Coffee Shop",
            terminalLabel: "Cashier_1",
            purposeOfTransaction: "oversea",
            languagePreference: "km",
            merchantNameAlternateLanguage: "ចន ស្មីន",
            merchantCityAlternateLanguage: "សៀមរាប",
            upiMerchantAccount: "0001034400010344ABCDEFGHJIKLMNO"
        };
    
        const individualInfo = new info("soung_layhorth@trmc", "Soung LayHorth", "PHNOM PENH", optionalData);
        const khqrInstance = new KHQR.BakongKHQR();
        const individual = khqrInstance.generateIndividual(individualInfo);
    
        // Function to display QR code in the modal
        const displayQRCode = () => {
            if (!individual?.data?.qr) {
                console.error("QR code data is not available.");
                return;
            }
    
            const qrCodeCanvas = document.getElementById("qrCodeCanvas");
            if (!qrCodeCanvas) {
                console.error("QR code canvas element not found.");
                return;
            }
    
            // Generate QR code and display it on the canvas
            QRCode.toCanvas(qrCodeCanvas, individual.data.qr, (error) => {
                if (error) {
                    console.error("Error generating QR code:", error);
                }
            });
    
            // Show the modal
            const qrCodeModal = new bootstrap.Modal(document.getElementById("qrCodeModal"));
            qrCodeModal.show();
        };
    
        // Attach click event to the QR image/button
        const checkoutButton = document.getElementById("checkout");
        if (checkoutButton) {
            checkoutButton.addEventListener("click", displayQRCode);
        } else {
            console.warn("Checkout button not found.");
        }
    
        let checkTransactionInterval;
    
        // Function to poll transaction status
        const startQrCodeScanner = (md5Value, orderNumber) => {
            if (!md5Value) {
                console.error("Md5 value is not available.");
                return;
            }
    
            checkTransactionInterval = setInterval(() => {
                fetchTransactionStatus(md5Value, orderNumber);
            }, 2000);
        };
    
        // Handle modal open event
        $('#qrCodeModal').on('shown.bs.modal', function () {
    const md5Value = individual?.data?.md5; // Replace with actual md5 generation logic if needed
    startQrCodeScanner(md5Value, orderNumber); // Use the orderNumber variable defined at the top
});

    
        // Fetch transaction status
        const fetchTransactionStatus = (md5, orderNumber) => {
            const token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoiMzYyZTU0Y2RmNDk2NDUzNSJ9LCJpYXQiOjE3NDE3ODczNTYsImV4cCI6MTc0OTU2MzM1Nn0.Au8fr_r6pZJG4CuTXbFi-YsYSjJWe7TRZ38IBJzfFYo'; // Replace with your actual token
            const url = 'https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5';
    
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
                body: JSON.stringify({ md5 }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.responseMessage === 'Success') {
                    clearInterval(checkTransactionInterval);
    
                    // Send notification to Telegram
                    const telegramBotToken = '8124975670:AAGjJGP4ULkfEuRhNdTIk2REF_YIffcBSic';
                    const chatId = '1081724526';
                    const message = `Order #${orderNumber} has been successfully processed.`;
    
                    fetch(`https://api.telegram.org/bot${telegramBotToken}/sendMessage`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            chat_id: chatId,
                            text: message,
                        }),
                    })
                    .then(response => response.json())
                    .then(telegramData => {
                        console.log('Telegram notification sent:', telegramData);
                    })
                    .catch(telegramError => {
                        console.error('Error sending Telegram notification:', telegramError);
                    });
                    fetch(`/update-order-status/${orderNumber}`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for security
    },
    body: JSON.stringify({
        status: 'success',
    }),
})
.then(response => response.json())
.then(updateData => {
    console.log('Order status updated:', updateData);
    window.location.href = `/success/${orderNumber}`;
})
.catch(updateError => {
    console.error('Error updating order status:', updateError);
});

                } else {
                    console.log("Transaction status unknown.");
                }
            })
            .catch(error => {
                console.error("Error checking transaction status:", error);
                clearInterval(checkTransactionInterval);
            });
        };
    });
    </script>
    