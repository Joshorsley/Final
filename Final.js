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
    const fullName = document.getElementById('fullName').value.trim();
    const nameError = document.getElementById('nameError');
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
}

