const username = document.getElementById('username');
const password = document.getElementById('userpass');
const confirmPassword = document.getElementById('confirmPassword');
const age = document.getElementById('age');
const email = document.getElementById('usermail');
const firstName = document.getElementById('Firstname');
const lastName = document.getElementById('Lastname');
const userType = document.getElementById('userType');
const genre = document.getElementById('genre'); // Added genre field
const genderInputs = document.getElementsByName('gender'); // Gender radio buttons
const registerButton = document.getElementById('register');
const usernameError = document.getElementById('usernameError');
const confirmPassError = document.getElementById('confirmPassError');
const ageError = document.getElementById('ageError');
const emailError = document.getElementById('emailError');
const firstNameError = document.getElementById('FirstnameError');
const lastNameError = document.getElementById('LastnameError');
const userTypeError = document.getElementById('userTypeError');
const genreError = document.createElement('div'); // Create error div for genre
genreError.className = 'error';
genreError.id = 'genreError';
genre.parentNode.insertBefore(genreError, genre.nextSibling); // Add error div after genre select

// Check First Name
function checkFirstName() {
    const firstNameValue = firstName.value.trim();
    if (firstNameValue === "") {
        firstNameError.textContent = "First name is required.";
        return false;
    } else if (!firstNameValue.match(/^[A-Za-z]+$/)) {
        firstNameError.textContent = "First name should contain only alphabets.";
        return false;
    } else {
        firstNameError.textContent = "";
        return true;
    }
}

// Check Last Name
function checkLastName() {
    const lastNameValue = lastName.value.trim();
    if (lastNameValue === "") {
        lastNameError.textContent = "Last name is required.";
        return false;
    } else if (!lastNameValue.match(/^[A-Za-z]+$/)) {
        lastNameError.textContent = "Last name should contain only alphabets.";
        return false;
    } else {
        lastNameError.textContent = "";
        return true;
    }
}

// Check Username
function checkUsername() {
    const usernameValue = username.value.trim();
    if (usernameValue === "") {
        usernameError.textContent = "Username is required.";
        return false;
    } else if (!usernameValue.match(/^[A-Za-z]+$/)) {
        usernameError.textContent = "Username should have only alphabets.";
        return false;
    } else {
        usernameError.textContent = "";
        return true;
    }
}

// Check Password
function checkPassword() {
    const passValue = password.value;
    const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (passValue === "") {
        passError.textContent = "Password is required.";
        return false;
    } else if (!passValue.match(strongPasswordRegex)) {
        passError.textContent = "Password must have at least 8 characters, including uppercase, lowercase, number, and special character.";
        return false;
    } else {
        passError.textContent = "";
        return true;
    }
}

// Check Confirm Password
function checkConfirmPassword() {
    const confirmPassValue = confirmPassword.value;
    if (confirmPassValue === "") {
        confirmPassError.textContent = "Please confirm your password.";
        return false;
    } else if (password.value !== confirmPassValue) {
        confirmPassError.textContent = "Passwords do not match.";
        return false;
    } else {
        confirmPassError.textContent = "";
        return true;
    }
}

// Check Age
function checkAge() {
    const ageValue = parseInt(age.value);
    if (!age.value) {
        ageError.textContent = "Age is required.";
        return false;
    } else if (isNaN(ageValue) || ageValue < 18 || ageValue >= 100) {
        ageError.textContent = "You must be at least 18 years old and below 100 years old.";
        return false;
    } else {
        ageError.textContent = "";
        return true;
    }
}

// Check Email
function checkEmail() {
    const emailValue = email.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailValue === "") {
        emailError.textContent = "Email is required.";
        return false;
    } else if (!emailRegex.test(emailValue)) {
        emailError.textContent = "Please enter a valid email address.";
        return false;
    } else {
        emailError.textContent = "";
        return true;
    }
}

// Check User Type
function checkUserType() {
    if (userType.value === "") {
        userTypeError.textContent = "Please select a user account type.";
        return false;
    } else {
        userTypeError.textContent = "";
        return true;
    }
}

// Check Genre
function checkGenre() {
    if (genre.value === "") {
        genreError.textContent = "Please select a favorite genre.";
        return false;
    } else {
        genreError.textContent = "";
        return true;
    }
}

// Check Gender
function checkGender() {
    let genderSelected = false;
    for (const genderInput of genderInputs) {
        if (genderInput.checked) {
            genderSelected = true;
            break;
        }
    }
    if (!genderSelected) {
        document.getElementById('genderError') || (genderInputs[0].parentNode.insertBefore(
            Object.assign(document.createElement('div'), { id: 'genderError', className: 'error', textContent: 'Please select a gender.' }),
            genderInputs[0].nextSibling
        ));
        return false;
    } else {
        const genderError = document.getElementById('genderError');
        if (genderError) genderError.textContent = "";
        return true;
    }
}

// Submit Form Validation
function submitForm() {
    const isValid = (
        checkFirstName() &&
        checkLastName() &&
        checkUsername() &&
        checkPassword() &&
        checkConfirmPassword() &&
        checkAge() &&
        checkEmail() &&
        checkUserType() &&
        checkGenre() &&
        checkGender()
    );

    if (isValid) {
        alert(`Thank you, ${firstName.value}! You have successfully registered as a ${userType.value}.`);
        return true; // Allow form submission
    } else {
        alert("Please fill in all fields correctly before submitting.");
        return false; // Prevent form submission
    }
}

// Add event listeners for real-time validation
username.addEventListener('input', checkUsername);
password.addEventListener('input', checkPassword);
confirmPassword.addEventListener('input', checkConfirmPassword);
age.addEventListener('input', checkAge);
email.addEventListener('input', checkEmail);
firstName.addEventListener('input', checkFirstName);
lastName.addEventListener('input', checkLastName);
userType.addEventListener('change', checkUserType);
genre.addEventListener('change', checkGenre);
genderInputs.forEach(input => input.addEventListener('change', checkGender));
registerButton.addEventListener('click', submitForm);

