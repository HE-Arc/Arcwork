function isPasswordValid(password) {
    return RegExp("^[a-zA-Z0-9]{6,20}$").test(password)
}

function isUserNameValid(userName) {
    return RegExp("^[a-zA-Z0-9]{1,30}$").test(userName)

}

function isElementValid(element) {
    return RegExp("^[a-zA-Z0-9 ]{1,20}$").test(element)

}

function isBioValid(bio) {
    return RegExp("^[a-zA-Z0-9\\s]{1,200}$").test(bio)

}
export { isPasswordValid, isUserNameValid, isBioValid, isElementValid }