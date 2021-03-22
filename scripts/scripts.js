// Register the validate function for the form submit event
let form = document.getElementById("guestForm");
form.onsubmit = validate;

//Make all error messages invisible
function clearErrors()
{
    let errors = document.getElementsByClassName("text-danger");

    for(let i=0; i<errors.length; i++)
    {
        errors[i].classList.add("d-none");
    }
}

function validate()
{
    clearErrors(); // calls clearErrors to make all error message invisible.

    let isValid = true;

    // Validate first name
    let firstName = document.getElementById("fname").value;
    if(firstName === "")
    {
        let errorFname = document.getElementById("errorFname");
        errorFname.classList.remove("d-none");
        isValid = false; // when isValid is false, it doesn't send the data to server. stays on the form page
    }

    // Validate lastname
    let lastName = document.getElementById("lname").value;
    if(lastName === "")
    {
        let errorLname = document.getElementById("errorLname");
        errorLname.classList.remove("d-none");
        isValid = false;
    }

    // Validate Email
    if(!validateEmail())
    {
        isValid = false;
    }

    // Validate user name
    let userName = document.getElementById("username").value;
    if(userName === "")
    {
        let errorUsername = document.getElementById("noUsername");
        errorUsername.classList.remove("d-none");
        isValid = false; // when isValid is false, it doesn't send the data to server. stays on the form page
    }

    return isValid;
}

function validateEmail()
{
    let email = document.getElementById("email").value;
    let emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    let isValid = true;

    if(email === "")
    {
        let noEmail = document.getElementById("noEmail");
        noEmail.classList.remove("d-none");
        isValid = false;
    }
    else if (!email.match(emailRegex))
    {
        let invalidEmail = document.getElementById("invalidEmail");
        invalidEmail.classList.remove("d-none");
        isValid = false;
    }

    return isValid;
}