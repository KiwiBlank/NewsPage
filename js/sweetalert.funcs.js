function errorNoAdmin() {
    Swal.fire({
        title: "Not Authorized!",
        text: "You need to be an admin to perform this action!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorLengthNews() {
    Swal.fire({
        title: "Failed!",
        text: "Title length can not be greater than 64 characters!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function successPostNews() {
    Swal.fire({
        title: "Success!",
        text: "News has been posted!",
        icon: "success",
        confirmButtonText: "OK"
    })
}

function successRegistered() {
    Swal.fire({
        title: "Registered!",
        text: "You have successfully registered, you can now login!",
        icon: "success",
        confirmButtonText: "Yay!"
    })
}

function errorUsernameExists() {
    Swal.fire({
        title: "Failed!",
        text: "Username exists, please choose another!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorPasswordLength() {
    Swal.fire({
        title: "Failed!",
        text: "Password must be between 5 and 32 characters long!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorUsernameInvalid() {
    Swal.fire({
        title: "Failed!",
        text: "Username is not valid!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorEmailInvalid() {
    Swal.fire({
        title: "Failed!",
        text: "Email is not valid!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorRegisterGeneric() {
    Swal.fire({
        title: "Failed!",
        text: "Registration did not complete, please try again!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorImageUpload() {
    Swal.fire({
        title: "Failed!",
        text: "Image was not uploaded!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function successImageUpload() {
    Swal.fire({
        title: "Uploaded!",
        text: "Image has been uploaded!",
        icon: "success",
        confirmButtonText: "OK"
    })
}

function errorLoginFillOut() {
    Swal.fire({
        title: "Failed!",
        text: "Please fill both the username and password fields!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorLoginPassword() {
    Swal.fire({
        title: "Failed!",
        text: "Incorrect password!",
        icon: "error",
        confirmButtonText: "OK"
    })
}

function errorLoginUsername() {
    Swal.fire({
        title: "Failed!",
        text: "Incorrect username!",
        icon: "error",
        confirmButtonText: "OK"
    })
}


function successLogin() {
    Swal.fire({
        title: "Success!",
        text: "Welcome to the website!",
        icon: "success",
        confirmButtonText: "OK"
    })
}

function infoLogOut() {
    Swal.fire({
        title: "Logged Out",
        text: "You have been logged out.",
        icon: "info",
        confirmButtonText: "OK"
    })
}
