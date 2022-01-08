<template>
    <h2>LOGIN</h2>
    <div id="errorMsg">
        <error-msg :msg="error_msg"> </error-msg>
    </div>
    <div id="box">
        <label for="username">Username:</label><br />
        <input type="text" id="username" name="username" /><br />
        <label for="pwd">Password:</label><br />
        <input type="password" id="password" name="password" />
        <button v-on:click="send">send</button>
    </div>
    <a href="/#/createUser">create an account</a>
</template>

<script>
import { isUserNameValid, isPasswordValid } from "../tools/parser";
import ErrorMsg from "../components/ErrorMsg";
import { sendData } from "../tools/network";
import { setCookie } from "../tools/cookie";
import { goTo } from "../tools/nav";

export default {
    name: "Login",
    data() {
        return {
            display: "none",
            error_msg: "",
        };
    },
    components: {
        ErrorMsg,
    },
    methods: {
        async send() {
            let name = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            if (isUserNameValid(name) && isPasswordValid(password)) {
                this.display = "none";
            } else {
                this.display = "inline";
                this.error_msg = "password or username error";
                return 0;
            }
            try {
                let result = await sendData("/login", {
                    pseudo: name,
                    password: password,
                });
                console.log(result);
                if (result.status == "success") {
                    setCookie("token", result.token);
                    goTo("/projects");
                }
            } catch (error) {
                console.log(error);
                return 0;
            }
        },
    },
};
</script>

<style >
#errorMsg {
    display: v-bind(display);
}
</style>