<template>
    <div>
        <NavBar />
        <div class="md:w-6/12 flex flex-col mx-auto md:px-14 px-2 py-10">
            <div class="flex-auto text-4xl font-bold mx-auto block">Create a new project</div>
            <error-msg v-if="error_msg" :msg="error_msg"> </error-msg>

            <div id="box" class="flex flex-col gap-4 py-5">
                <label class="hidden" for="name">name:</label>
                <input
                    class="rounded-lg p-2 mx-auto block w-full text-center"
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Project name"
                />

                <label class="hidden" for="description">description:</label>
                <textarea class="rounded-lg p-2 mx-auto block w-full h-24 text-center" rows="5" cols="60" name="description" id="description" placeholder="Enter text"></textarea>
                <label class="border-none mx-auto block font-bold" for="myfile">Select a profile picture:</label>
                <input class="rounded-lg p-2 mx-auto block text-center" type="file" id="myfile" name="myfile"/>

                <label class="border-none mx-auto block font-bold" for="favcolor">Select your favorite color:</label>
                <input class="border-none mx-auto block" type="color" id="favcolor" name="favcolor" value="#ff0000"/>
                <div class="flex flex-wrap lg:justify-between justify-center">
                    <list-input :name="inputName1" ref="hashtags"></list-input>
                    <list-input :name="inputName2" ref="texts"></list-input>
                </div>
                <button class="m-auto bg-mantis text-gray-200 p-2 rounded-lg block" v-on:click="send">Send</button>

            </div>
        </div>
    </div>
</template>

<script>
import ListInput from "../components/ListInput";
import ErrorMsg from "../components/ErrorMsg";
import NavBar from "../components/NavBar";
import { isUserNameValid, isBioValid } from "../tools/parser";
import { sendData } from "../tools/network";
import { getCookie } from "../tools/cookie";
import { goTo } from "../tools/nav";

export default {
    name: "CreateProject",
    data() {
        return {
            inputName1: "HASHTAG",
            inputName2: "TEXT",
            error_msg: "",
            token: "",
        };
    },
    components: {
        ListInput,
        ErrorMsg,
        NavBar,
    },
    methods: {
        getElems(ref) {
            let data = new Array();
            for (let i = 0; i < ref.elements.length; i++) {
                data.push(ref.elements[i]);
            }
            return data;
        },

        async send() {
            let hashtags = this.getElems(this.$refs.hashtags.$data);
            let texts = this.getElems(this.$refs.texts.$data);
            let name = document.getElementById("name").value;
            let color = document.getElementById("favcolor").value;
            let description = document.getElementById("description").value;
            //let profilePic = document.getElementById("myfile").value;
            if (isUserNameValid(name) && isBioValid(description)) {
                try {
                    let result = await sendData(
                        "/projects",
                        {
                            name: name,
                            color: color,
                            description: description,
                            profilePicPath: "1",
                            token: this.token,
                        },
                        { texts: texts, hashtags: hashtags }
                    );
                    console.log(result);
                    goTo("/project/" + result.id);
                } catch (error) {
                    console.log(error);
                    return 0;
                }
            } else {
                this.error_msg = "description or name error";
                return 0;
            }
        },
    },
    created() {
        this.token = getCookie("token");
        console.log(this.token);
        if (this.token == "") {
            goTo("/projects");
        }
    },
};
</script>


<style >
</style>