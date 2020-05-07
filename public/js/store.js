let totalExc = 0;
let totalInc = 0;

let items = [
    "Red Velvet Cake"
    ,"Sesame Bread"
    ,"Cupcakes"
];

let prices = {
    "Red Velvet Cake"  : 10.00
    ,"Sesame Bread"     : 3.50
    ,"Cupcakes"         : 8.00
};

function add(item) {

    let itemName = item.id.substr(3).replace(/_/g, " ");

    console.log("Adding " + itemName);

    if (typeof(Storage) !== "undefined") { // Ensure users browser supports local storage

        let currentValue = localStorage.getItem(itemName);

        if ( currentValue == null ) { // This is the first time the user is adding the item
            // will add checks that this doesnt exceed the available qty later ////

            localStorage.setItem(itemName, 1);
        } else { // This has previously been added, increment count by 1
            //

            localStorage.setItem(itemName, parseInt(currentValue) + 1);
        }

    } else {
        alert("This browser does not support local Storage. The shopping basket will not work correctly");
        document.getElementById("basket").style.display = "none"; // Hide the shopping basket to avoid misleading the user
    }

    updateBasket();
}

function rem(item) {

    let itemName = item.id.substr(3).replace(/_/g, " ");

    console.log("Removing " + itemName);

    if (typeof(Storage) !== "undefined") { // Ensure users browser supports local storage

        let currentValue = localStorage.getItem(itemName);

        if ( currentValue == null ) { // This is the first time the user is adding the item
            // No operation, the user doesnt have any of these in their shopping basket right now
        } else { // This has previously been added, decrease count by 1

            if ( parseInt(currentValue) === 0 ) {
                // No operation, the user has already removed their whole quantity
            } else {
                localStorage.setItem(itemName, parseInt(currentValue) - 1); // Decrease qty by 1
            }
        }

    } else {
        alert("This browser does not support local Storage. The shopping basket will not work correctly");
        document.getElementById("basket").style.display = "none"; // Hide the shopping basket to avoid misleading the user
    }

    updateBasket();
}

function updateBasket() {

    let i;
    let j;

    totalExc = 0;

    for ( i=0, j=items.length; i<j; i++ ) {

        if ( localStorage.getItem(items[i]) > 0 ) { // This exists, must display in basket

            let subTotal = parseFloat(localStorage.getItem(items[i])) * prices[items[i]];
            totalExc += subTotal;

            document.getElementById(items[i]).style.display      = "table-row";
            document.getElementById(items[i] + " Qty").innerText       = localStorage.getItem(items[i]);
            document.getElementById(items[i] + " Sub Total").innerText  = subTotal.toFixed(2);
        } else {
            // Hide the section
            document.getElementById(items[i]).style.display = "none";
        }

    }

    document.getElementById("totalExc").innerText = totalExc.toFixed(2);

    totalInc = totalExc*1.2; // Including VAT
    document.getElementById("totalInc").innerText = totalInc.toFixed(2);

    if ( totalExc === 0 ) { // No items in basket
        // Hide the basket for now
        document.getElementById("basket"). style.display = "none";
        document.getElementById("items").style.width = "100%";
    } else { // There are items
        // Show the basket
        document.getElementById("basket"). style.display = "block";
        document.getElementById("items").style.width = "70%";
    }
}

function emptyBasket() {

    localStorage.setItem("Red Velvet Cake", 0);
    localStorage.setItem("Sesame Bread", 0);
    localStorage.setItem("Cupcakes", 0);

    updateBasket();
}

function toCheckout() {

    // Load inputs
    document.getElementById("Red_Velvet_Cake_Hidden").value = localStorage.getItem("Red Velvet Cake");
    document.getElementById("Sesame_Bread_Hidden").value    = localStorage.getItem("Sesame Bread");
    document.getElementById("Cupcakes_Hidden").value        = localStorage.getItem("Cupcakes");

    document.getElementById("discountHidden").value        = localStorage.getItem("discount");

    // Submit form for processing
    document.getElementById("toCheckout").submit();
}

function applyDiscount() {

    let code = document.getElementById("discountCode").value;

    if ( code === "voucher" ) {  // Code is value
        document.getElementById("discountCell").style.display = "block";

        // Handle discount amount at checkout
        document.getElementById("discountCell").innerHTML = "Discount will be applied at checkout!";
        localStorage.setItem("discount", 15);

        // Stop user from entering further codes
        document.getElementById("discount").removeAttribute("onclick");
        document.getElementById("discount").style.display = "none";
        document.getElementById("discountCode").style.display = "none";

        // Show savings amount ////

    } else {
        document.getElementById("discountCell").style.display = "block";
        document.getElementById("discountCell").innerHTML = "Code not valid";

        setTimeout(function() {
            document.getElementById("discountCell").style.display = "none";
        }, 3000);
    }

    console.log("checking discount!" + code);
}

window.onload = updateBasket();
