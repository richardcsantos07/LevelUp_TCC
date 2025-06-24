var btnSignin = document.querySelector("#signin")
var btnSignup = document.querySelector("#signup")
var body = document.querySelector("body")

btnSignin.addEventListener("click", () => {
  // Remove qualquer classe anterior
  body.classList.remove("sign-up-js")
  // Adiciona a nova classe
  body.classList.add("sign-in-js")
})

btnSignup.addEventListener("click", () => {
  // Remove qualquer classe anterior
  body.classList.remove("sign-in-js")
  // Adiciona a nova classe
  body.classList.add("sign-up-js")
})
