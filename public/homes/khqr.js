document.addEventListener("DOMContentLoaded", function () {
    const KHQR = typeof BakongKHQR !== 'undefined' ? BakongKHQR : null;

    if (!KHQR) {
        console.error("BakongKHQR or its components are not loaded or defined.");
        return;
    }

    const totalPrice = {{ $totalPrice }};

    const data = KHQR.khqrData;
    const info = KHQR.IndividualInfo;

    const optionalData = {
        currency: data.currency.usd,
        amount:totalPrice, // Adjusted for testing with minimal amount
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
    const startQrCodeScanner = (md5Value) => {
        if (!md5Value) {
            console.error("Md5 value is not available.");
            return;
        }

        checkTransactionInterval = setInterval(() => {
            fetchTransactionStatus(md5Value);
        }, 2000);
    };

    // Handle modal open event
    $('#qrCodeModal').on('shown.bs.modal', function () {
        const md5Value = individual?.data?.md5; // Replace with actual md5 generation logic if needed
        startQrCodeScanner(md5Value);
    });

    // Fetch transaction status
    const fetchTransactionStatus = (md5) => {
        const token = 'your-api-token'; // Replace with your actual token
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
                    window.location.href = '/success';
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
