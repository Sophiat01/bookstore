const username = document.getElementById('username');
        const password = document.getElementById('userpass');
        const confirmPassword = document.getElementById('confirmPassword');
        const age = document.getElementById('age');
        const email = document.getElementById('usermail');
        const firstName = document.getElementById('Firstname');
        const lastName = document.getElementById('Lastname');
        const userType = document.getElementById('userType');
        const registerButton = document.getElementById('register');
        const usernameError = document.getElementById('usernameError');
        const confirmPassError = document.getElementById('confirmPassError');
        const ageError = document.getElementById('ageError');
        const emailError = document.getElementById('emailError');
        const firstNameError = document.getElementById('FirstnameError');
        const lastNameError = document.getElementById('LastnameError');
        const userTypeError = document.getElementById('userTypeError');

      function checkFirstName() {
    const firstNameValue = firstName.value;
    if (!firstNameValue.match(/^[A-Za-z]+$/)) {
        firstNameError.textContent = "First name should contain only alphabets.";
        return false;
    } else {
        firstNameError.textContent = "";
        return true;
    }
}

function checkLastName() {
    const lastNameValue = lastName.value;
    if (!lastNameValue.match(/^[A-Za-z]+$/)) {
        lastNameError.textContent = "Last name should contain only alphabets.";
        return false;
    } else {
        lastNameError.textContent = "";
        return true;
    }
}

        // Check username - has only alphabets
        function checkUsername() {
            const usernameValue = username.value;
            if (!usernameValue.match(/^[A-Za-z]+$/)) {
                usernameError.textContent = "Username should have only alphabets";
                return false;
            } else {
                usernameError.textContent = "";
                return true;
            }
        }

        // Check password - min 8 characters, uppercase, lowercase, number, special character
        function checkPassword() {
            const passValue = password.value;
            const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passValue.match(strongPasswordRegex)) {
                passError.textContent = "Password must have at least 8 characters, including uppercase, lowercase, number, and special character";
                return false;
            } else {
                passError.textContent = "";
                return true;
            }
        }

        // Check confirm password matches password
        function checkConfirmPassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassError.textContent = "Passwords do not match";
                return false;
            } else {
                confirmPassError.textContent = "";
                return true;
            }
        }

        
            // Check age is at least 18 and below 100
function checkAge() {
    const ageValue = parseInt(document.getElementById("age").value); // Get the value from the input
    const ageError = document.getElementById("ageError"); // Get the error container

    if (isNaN(ageValue) || ageValue < 18 || ageValue >= 100) {
        ageError.textContent = "You must be at least 18 years old and below 75 years old.";
        return false;
    } else {
        ageError.textContent = ""; // Clear error if valid
        return true;
    }
}

        // Check email format
        function checkEmail() {
            const emailValue = email.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailValue)) {
                emailError.textContent = "Please enter a valid email address";
                return false;
            } else {
                emailError.textContent = "";
                return true;
            }
        }

        function checkUserType() {
    if (userType.value === "") {
        userTypeError.textContent = "Please select a user account type.";
        return false;
    } else {
        userTypeError.textContent = "";
        return true;
    }
}

        
function submitForm() {
    if (
        checkFirstName() &&
        checkLastName() &&
        checkAge() &&
        checkEmail() &&
        checkUsername() &&
        checkPassword() &&
        checkConfirmPassword() &&
        checkUserType()
    ) {
        alert(`Thank you, ${firstName.value} ! You have successfully registered as a ${userType.value}.`);
        return true;
    } else {
        return false;
    }
   
   }


        // Add event listeners
        username.addEventListener('input', checkUsername);
        password.addEventListener('input', checkPassword);
        confirmPassword.addEventListener('input', checkConfirmPassword);
        age.addEventListener('input', checkAge);
        email.addEventListener('input', checkEmail);
        firstName.addEventListener('input', checkFirstName);
        lastName.addEventListener('input', checkLastName);
        userType.addEventListener('change', checkUserType);
        registerButton.addEventListener('click', submitForm); 

