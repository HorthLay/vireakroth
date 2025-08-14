<script>
    document.addEventListener("DOMContentLoaded", function() {
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
            amount: totalPrice,
            mobileNumber: "85512233455",
            storeLabel: "Coffee Shop",
            terminalLabel: "Cashier_1",
            purposeOfTransaction: "oversea",
            languagePreference: "km",
            merchantNameAlternateLanguage: "ចន ស្មីន",
            merchantCityAlternateLanguage: "សៀមរាប",
            upiMerchantAccount: "0001034400010344ABCDEFGHJIKLMNO"
        };

        const individualInfo = new info(
            "soung_layhorth@trmc",
            "Soung LayHorth",
            "PHNOM PENH",
            optionalData
        );

        const khqrInstance = new KHQR.BakongKHQR();
        const individual = khqrInstance.generateIndividual(individualInfo);

        // Show QR Code
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

            QRCode.toCanvas(qrCodeCanvas, individual.data.qr, (error) => {
                if (error) {
                    console.error("Error generating QR code:", error);
                }
            });

            const qrCodeModal = new bootstrap.Modal(document.getElementById("qrCodeModal"));
            qrCodeModal.show();
        };

        const checkoutButton = document.getElementById("checkout");
        if (checkoutButton) {
            checkoutButton.addEventListener("click", displayQRCode);
        } else {
            console.warn("Checkout button not found.");
        }

        let checkTransactionInterval;

        // Start polling
        const startQrCodeScanner = (md5Value, orderNumber) => {
            if (!md5Value) {
                console.error("Md5 value is not available.");
                return;
            }

            checkTransactionInterval = setInterval(() => {
                fetchTransactionStatus(md5Value, orderNumber);
            }, 2000);
        };

        $('#qrCodeModal').on('shown.bs.modal', function() {
            const md5Value = individual?.data?.md5;
            startQrCodeScanner(md5Value, orderNumber);
        });

        // Check transaction status
        const fetchTransactionStatus = (md5, orderNumber) => {
            fetch('/check-transaction', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        md5: md5,
                        order_number: orderNumber
                    }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.responseMessage === 'Success') {
                        clearInterval(checkTransactionInterval);
                        window.location.href = `/success/${orderNumber}`;
                    }
                })

                .catch(error => {
                    console.error("Error checking transaction status:", error);
                    clearInterval(checkTransactionInterval);
                });
        };

    });
</script>
