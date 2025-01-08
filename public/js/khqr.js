document.addEventListener("DOMContentLoaded", function () {
    const KHQR = typeof BakongKHQR !== 'undefined' ? BakongKHQR : null;

    if (!KHQR) {
        console.error("BakongKHQR or its components are not loaded or defined.");
        return;
    }

    const data = KHQR.khqrData;
    const info = KHQR.IndividualInfo;

    const optionalData = {
        currency: data.currency.usd,
        amount: 0.01, // Minimal amount for testing
        mobileNumber: "85512233455",
        storeLabel: "Coffee Shop",
        terminalLabel: "Cashier_1",
        purposeOfTransaction: "oversea",
        languagePreference: "km",
        merchantNameAlternateLanguage: "ចន ស្មីន",
        merchantCityAlternateLanguage: "សៀមរាប",
        upiMerchantAccount: "0001034400010344ABCDEFGHJIKLMNO",
    };

    const individualInfo = new info(
        "soung_layhorth@trmc",
        "Soung LayHorth",
        "PHNOM PENH",
        optionalData
    );

    const khqrInstance = new KHQR.BakongKHQR();
    const individual = khqrInstance.generateIndividual(individualInfo);

    const qrCodeCanvas = document.getElementById("qrCodeCanvas");
    const checkoutButton = document.getElementById("checkout");

    const displayQRCode = () => {
        if (!individual?.data?.qr) {
            alert("Unable to generate QR code. Please try again.");
            return;
        }

        QRCode.toCanvas(qrCodeCanvas, individual.data.qr, (error) => {
            if (error) {
                console.error("Error generating QR code:", error);
                alert("Error generating QR code. Please try again.");
            }
        });

        const qrCodeModal = new bootstrap.Modal(
            document.getElementById("qrCodeModal")
        );
        qrCodeModal.show();
    };

    if (checkoutButton) {
        checkoutButton.addEventListener("click", displayQRCode);
    } else {
        console.warn("Checkout button not found.");
    }

    let checkTransactionInterval;

    const startQrCodeScanner = (md5Value) => {
        if (!md5Value) {
            console.error("MD5 value is not available.");
            return;
        }

        checkTransactionInterval = setInterval(() => {
            fetchTransactionStatus(md5Value);
        }, 2000);
    };

    $("#qrCodeModal").on("shown.bs.modal", function () {
        const md5Value = individual?.data?.md5;
        startQrCodeScanner(md5Value);
    });

    const fetchTransactionStatus = (md5) => {
        const token = "REPLACE_WITH_SECURE_TOKEN";
        const url = "https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5";

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({ md5 }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.responseMessage === "Success") {
                    clearInterval(checkTransactionInterval);
                    window.location.href = "/success";
                } else {
                    console.log("Transaction status unknown.");
                }
            })
            .catch((error) => {
                console.error("Error checking transaction status:", error);
                clearInterval(checkTransactionInterval);
            });
    };
});
