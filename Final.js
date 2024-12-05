window.addEventListener("load", startForm);


// Function: startForm
// Details: This function initializes the game by adding event listeners to the form submissions.
//          It validates the player's name, maximum number, and guess inputs by calling the validation functions.
//          It also focuses on the player name input field.
// Parameters: None
// Returns: None

function startForm(){
    const nameForm = document.getElementById("finalNameForm")
    if(nameForm){
        nameForm.addEventListener("submit", validateName);
        document.getElementById("fullName").focus();
    }

}



// Function: validateName
// Details: This function validates the user's name input to ensure it is not empty and not a number.
//          If the input is invalid, it prevents the form submission and displays an appropriate error message.
// Parameters: 
//   - event 
// Returns: None

function validateName(event) {
    const fullName = document.getElementById('fullName').value.trimEnd();
    const nameError = document.getElementById('nameError');
    const regex = /^[A-Za-z]+ [A-Za-z]+$/;
    nameError,textContent = "";

    if (fullName == '') {
        event.preventDefault();
        nameError.textContent = "Error: Name cannot be blank";
        return;
    } 
    
    if (!isNaN(fullName)) {
        event.preventDefault();
        nameError.textContent = "Error: Please enter a proper Name and not a number.";
        return;
    } 
    
    if (!regex.test(fullName)) {
        event.preventDefault();
        nameError.textContent = "Error: Please enter a valid first and last name (only alphabetical characters, separated by a space).";
        return;
    }
}

window.addEventListener("load", () => {
    const checkboxes = document.querySelectorAll(".topping");
    checkboxes.forEach((checkbox) =>
        checkbox.addEventListener("change", UpdateCost)
    );
});

function UpdateCost() {
    const pep = document.getElementById('pepperoni').checked ? 1 : 0;
    const mush = document.getElementById('mushrooms').checked ? 1 : 0;
    const grnOlive = document.getElementById('greenOlives').checked ? 1 : 0;
    const grnpep = document.getElementById('greenPeppers').checked ? 1 : 0;
    const doubleC = document.getElementById('doubleCheese').checked ? 1 : 0;

    const payload = {
        Pepperoni: pep,
        Mushrooms: mush,
        GreenOlives: grnOlive,
        GreenPeppers: grnpep,
        DoubleCheese: doubleC,
    };

    $.ajax({
        url: "Ajaxhandler.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(payload),
        success: function (serverData) {
            console.log("Server Response:", serverData);
            if (!serverData || typeof serverData.Value === 'undefined') {
                console.error("Invalid server response", serverData);
                document.getElementById("totalPrice").innerText = "Error calculating price";
                return;
            }
            const total = serverData.Value;
            document.getElementById("totalPrice").innerText = total.toFixed(2);
        },
        error: function (err) {
            console.error("Error:", err);
            document.getElementById("totalPrice").innerText = "Error";
        }
    });
}


