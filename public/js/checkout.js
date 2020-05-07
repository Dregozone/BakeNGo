function handleForm() {
    alert('Payment would go here...');

    document.getElementById("redVelvetCakeHidden").value = localStorage.getItem("Red Velvet Cake");
    document.getElementById("cupcakesHidden").value = localStorage.getItem("Cupcakes");
    document.getElementById("sesameBreadHidden").value = localStorage.getItem("Sesame Bread");

    if ( localStorage.getItem("discount") != null ) {
        document.getElementById("redVelvetCakeHiddenDiscount").value = "1";
        document.getElementById("cupcakesHiddenDiscount").value      = "1";
    }
}

function applyDiscount(perc) { // Percentage to be discounted
    document.getElementById("showDiscount").style.display = "table-row";
}

if ( localStorage.getItem("discount") !== null ) { // If discount has been applied
    applyDiscount(localStorage.getItem("discount"));
}

if ( localStorage.getItem("Red Velvet Cake") > 0 ) {
    document.getElementById("showProductRedVelvetCake").style.display = "table-row";
}
if ( localStorage.getItem("Cupcakes") > 0 ) {
    document.getElementById("showProductCupcakes").style.display = "table-row";
}
if ( localStorage.getItem("Sesame Bread") > 0 ) {
    document.getElementById("showProductSesameBread").style.display = "table-row";
}

function emptyBasket() {

    localStorage.setItem("Red Velvet Cake", 0);
    localStorage.setItem("Sesame Bread", 0);
    localStorage.setItem("Cupcakes", 0);
}
