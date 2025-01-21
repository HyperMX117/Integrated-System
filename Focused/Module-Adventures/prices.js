function updatePricesAndCode() {
    var tourSelect = document.getElementById("tour");
    var tourLengthSelect = document.getElementById("tour-length");
    var peopleInput = document.getElementById("people");
    var pricesDiv = document.getElementById("prices");
    var tourCodeDiv = document.getElementById("tourCode");

    var tourOptions = {
        "class1-2": { "3days": { price: 100, code: "3WW12" }, "5days": { price: 145, code: "5WW12" } },
        "class3-4": { "3days": { price: 125, code: "3WW34" }, "5days": { price: 175, code: "5WW34" } },
        "kayaking/camping": { "3days": { price: 70, code: "3KC" }, "5days": { price: 95, code: "5KC" } },
        "hiking/camping": { "3days": { price: 50, code: "3HC" }, "5days": { price: 70, code: "5HC" } },
    };

    var selectedOption = tourSelect.value;
    var selectedTourLength = tourLengthSelect.value;
    var numberOfPeople = peopleInput.value;

    if (selectedOption in tourOptions && selectedTourLength in tourOptions[selectedOption]) {
        var selectedTourData = tourOptions[selectedOption][selectedTourLength];
        var totalPrice = selectedTourData.price * numberOfPeople;
        pricesDiv.innerHTML = "Total Price: $" + totalPrice.toFixed(2);
        tourCodeDiv.innerHTML = "Tour Code: " + selectedTourData.code;
    } else {
        pricesDiv.innerHTML = "";
        tourCodeDiv.innerHTML = "";
    }
}