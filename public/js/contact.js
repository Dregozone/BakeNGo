function clearForm() {
    document.getElementById("name").value       = "";
    document.getElementById("email").value      = "";
    document.getElementById("message").value    = "";
}

function submitForm() {

    if (
        document.getElementById("name").value       == "" ||
        document.getElementById("email").value      == "" ||
        document.getElementById("message").value    == ""
    ) { // Form is invalid
        document.getElementById("error").innerHTML = "Please check all required fields are completed before submission.";

        return false;
    } else { // Form is valid
        document.getElementById("contactForm").submit();
    }
}
