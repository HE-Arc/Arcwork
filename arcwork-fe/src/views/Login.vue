<template>
    <NavBar />
    <div class="w-4/12 flex flex-col mx-auto px-14 py-10">
        <div class="flex-auto text-4xl font-bold mx-auto block">Login</div>
        <div id="errorMsg">
            <error-msg :msg="error_msg"> </error-msg>
        </div>
        <div id="box" class="flex flex-col gap-4 py-5">
            <label class="hidden" for="username">Username:</label>
            <input class="rounded-lg p-2 mx-auto block text-center" type="text" id="username" name="username" placeholder="username"/>
            <label class="hidden" for="pwd">Password:</label>
            <input class="rounded-lg p-2 mx-auto block text-center" type="password" id="password" name="password" placeholder="password"/>
            <div class="flex flex-row justify-between">
                <a href="/#/createUser">Don't have an account?</a>
                <button class="bg-mantis text-gray-200 p-2 rounded-lg" v-on:click="send" >send</button>
            </div>
        </div>
        
    </div>
</template>

<script>
import ErrorMsg from "../components/ErrorMsg";
import NavBar from "../components/NavBar";
import { isUserNameValid, isPasswordValid } from "../tools/parser";
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
        NavBar,
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