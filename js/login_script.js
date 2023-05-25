// "use strict";

// // Login Form
// const loginForm = document.getElementById("login");

// // Inputs
// const usernameInput = document.getElementById("username");
// const nameInput = document.getElementById("name");
// const emailInput = document.getElementById("email");
// const passwordInput = document.getElementById("password");

// // Buttons
// const loginButton = document.getElementById("register");

// // Error messages

// const usernameIsValid = () => {
//   // Check if username contains only letters and numbers and is not empty
//   const username = usernameInput.value;
//   return /^[a-zA-Z0-9]+$/.test(username) && username.trim() !== "";
// };

// const nameIsValid = () => {
//   // Check if name contains only letters and is not empty
//   const name = nameInput.value;
//   return /^[a-zA-Z]+$/.test(name) && name.trim() !== "";
// };

// const emailIsValid = () => {
//   // Check if email is valid
//   const email = emailInput.value;
//   return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
// };

// const passwordIsValid = () => {
//   // Check if password contains at least one letter, at least one number and is at least 6 characters
//   const password = passwordInput.value;
//   return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/.test(password);
// };

// const formIsValid = () => {
//   return (
//     usernameIsValid() && nameIsValid() && emailIsValid() && passwordIsValid()
//   );
// };

// // Event Listeners
// usernameInput.addEventListener("input", () => {
//   if (!usernameIsValid()) {
//     usernameInput.classList.add("is-invalid");
//   } else {
//     usernameInput.classList.remove("is-invalid");
//   }
// });

// nameInput.addEventListener("input", () => {
//   if (!nameIsValid()) {
//     nameInput.classList.add("is-invalid");
//   } else {
//     nameInput.classList.remove("is-invalid");
//   }
// });

// emailInput.addEventListener("input", () => {
//   if (!emailIsValid()) {
//     emailInput.classList.add("is-invalid");
//   } else {
//     emailInput.classList.remove("is-invalid");
//   }
// });

// passwordInput.addEventListener("input", () => {
//   if (!passwordIsValid()) {
//     passwordInput.classList.add("is-invalid");
//   } else {
//     passwordInput.classList.remove("is-invalid");
//   }
// });

// loginForm.addEventListener("submit", (e) => {
//   if (!formIsValid()) {
//     e.preventDefault();
//   }
// });
