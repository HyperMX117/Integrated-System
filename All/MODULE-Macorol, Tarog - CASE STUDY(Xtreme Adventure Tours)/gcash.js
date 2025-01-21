    function updateQrCode() {
        var paymentMethod = document.getElementById("paymentMethod").value;
        var qrCodeContainer = document.getElementById("qrCodeContainer");

        qrCodeContainer.innerHTML = "";

        if (paymentMethod === "gcash") {
            var gcashQrCodeImage = document.createElement("img");
            gcashQrCodeImage.src = "images/gcashqr.jpg";  
            gcashQrCodeImage.alt = "Gcash QR Code";
            gcashQrCodeImage.style.width = "100px";  
            gcashQrCodeImage.style.height = "100px";  

            qrCodeContainer.appendChild(gcashQrCodeImage);
        }
    }

    document.getElementById("paymentMethod").addEventListener("change", updateQrCode);

