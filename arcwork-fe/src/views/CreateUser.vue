<template>
    <div>
        <h2>create a new user</h2>
        <div id="errorMsg">
            <error-msg :msg="error_msg"> </error-msg>
        </div>
        <div id="box">
            <label for="username">Username:</label><br />
            <input type="text" id="username" name="username" /><br />

            <label for="bio">bio:</label><br />
            <textarea
                rows="5"
                cols="60"
                name="bio"
                id="bio"
                placeholder="Enter text"
            ></textarea
            ><br />

            <label for="myfile">Select a profile picture:</label><br />
            <input type="file" id="myfile" name="myfile" /> <br />

            <label for="favcolor">Select your favorite color:</label><br />
            <input
                type="color"
                id="favcolor"
                name="favcolor"
                value="#ff0000"
            /><br />

            <label for="password">Password:</label><br />
            <input type="password" id="password" name="password" /><br />
            <label for="confirmpassword">confirm Password:</label><br />
            <input
                type="password"
                id="confirmpassword"
                name="confirmpassword"
            /><br />
            <button v-on:click="send">send</button>
        </div>
    </div>
</template>

<script>
import ErrorMsg from "../components/ErrorMsg";
import { isUserNameValid, isPasswordValid, isBioValid } from "../tools/parser";
import { sendData } from "../tools/network";

export default {
    name: "CreateUser",
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
            let confirmpassword =
                document.getElementById("confirmpassword").value;
            let color = document.getElementById("favcolor").value;
            let bio = document.getElementById("bio").value;
            //let profilePic = document.getElementById("myfile").value;
            if (password != confirmpassword) {
                this.display = "inline";
                this.error_msg = "password or username error";
                return 0;
            }
            if (
                isUserNameValid(name) &&
                isPasswordValid(password) &&
                isBioValid(bio)
            ) {
                try {
                    let result = sendData("/login", {
                        username: name,
                        password: password,
                        color: color,
                        bio: bio,
                    });
                    console.log(result);
                } catch (error) {
                    console.log(error);
                    return 0;
                }
            } else {
                this.display = "inline";
                this.error_msg = "password or username error";
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