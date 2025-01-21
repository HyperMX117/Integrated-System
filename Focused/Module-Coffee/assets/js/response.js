function getBotResponse(input) {
    // Simple responses
    if (input == "hello") {
        return "Hello there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "commands") {
        return "Keywords/Commands: <br/><br/> <strong>menu</strong> - it will show our menu. <br/> <strong>how to order</strong> - it will show the instruction. <br/> ";
    } else if (input == "menu") {
        return "Here's our menu: <br /><br /> Americano - Hot Espresso (12 OZ) - ₱45.00 <br /> Caffe Latte - Steamed Milk (12 OZ) - ₱65.00 <br /> Salted Caramel Espresso (12 OZ) - ₱75.00 <br /> Cafe Mocha Espresso (12 OZ) - ₱75.00 <br /> Spanish Latte Espresso (12 OZ) - ₱75.00 ";
    } else if (input == "about") {
        return "Hi there! <br /><br /> <strong>Cafedemic Break</strong> is a coffee shop and retailer in Tanza, Cavite.";
    } else if (input == "how to order") {
        return "Hi There! <br /><br /> To order, you can go to our <strong>Menu</strong> section and click the <strong'Add to Cart'></strong> button of your choice. <br /><br /> I hope you understand. Thank you so much!";
    } else {
        return "Try asking something else!";
    }
}
