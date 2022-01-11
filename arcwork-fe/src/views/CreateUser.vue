<template>
    <div>
        <NavBar />
        <div class="md:w-6/12 lg:4/12 flex flex-col mx-auto md:px-14 px-2 py-10">
            <div class="flex-auto text-4xl font-bold mx-auto block">Create a new user</div>
            <error-msg v-if="error_msg" :msg="error_msg"> </error-msg>
            <div id="box" class="flex flex-col gap-4 py-5">
                <label class="hidden" for="username">Username:</label>
                <input class="rounded-lg p-2 mx-auto block text-center" type="text" id="username" name="username" placeholder="UserName"/>

                <label class="hidden" for="bio">bio:</label>
                <textarea class="rounded-lg p-2 mx-auto block w-full h-24 text-center" name="bio" id="bio" placeholder="Describe yourself"/>

                <label class="border-none mx-auto block font-bold" for="myfile">Select a picture for your project:</label>
                <input class="border-none mx-auto block" type="file" id="myfile" name="myfile" />

                <label class="border-none mx-auto block font-bold" for="favcolor">Select a color for your project :</label>
                <input class="border-none mx-auto block" type="color" id="favcolor" name="favcolor" value="#ff0000"/>

                <label class="hidden" for="password">Password:</label>
                <input class="rounded-lg p-2 mx-auto block w-full text-center" type="password" id="password" name="password" placeholder="Enter Password"/>
                <label class="hidden" for="confirmpassword" >confirm Password:</label>
                <input class="rounded-lg p-2 mx-auto block w-full text-center" type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"/>
                <button class="m-auto bg-mantis text-gray-200 p-2 rounded-lg block" v-on:click="send">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar";
import ErrorMsg from "../components/ErrorMsg";
import { isUserNameValid, isPasswordValid, isBioValid } from "../tools/parser";
import { sendData } from "../tools/network";
import { setCookie } from "../tools/cookie";
import { goTo } from "../tools/nav";

export default {
    name: "CreateUser",
    data() {
        return {
            error_msg: "",
        };
    },
    components: {
        ErrorMsg,
        NavBar
    },
    methods: {
        async send() {
            console.log("send");
            let name = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let confirmpassword =
                document.getElementById("confirmpassword").value;
            let color = document.getElementById("favcolor").value;
            let bio = document.getElementById("bio").value;
            //let profilePic = document.getElementById("myfile").value;
            if (password != confirmpassword) {
                this.error_msg = "password or username error";
                return 0;
            }
            if (
                isUserNameValid(name) &&
                isPasswordValid(password) &&
                isBioValid(bio)
            ) {
                try {
                    let result = await sendData(
                        "/users",
                        {
                            pseudo: name,
                            password: password,
                            color: color,
                            bio: bio,
                            profilePicPath: "1",
                        },
                        ""
                    );
                    if (result.identificationToken == "") {
                        throw new Error();
                    }
                    console.log(result.identificationToken);
                    setCookie("token", result.identificationToken);
                    goTo("/user/" + result.id);
                } catch (error) {
                    console.log(error);
                    return 0;
                }
            } else {
                this.error_msg = "password or username error";
                return 0;
            }
        },
    },
};
</script>


<style >
</style>