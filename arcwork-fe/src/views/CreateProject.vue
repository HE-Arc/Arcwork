<template>
    <div>
        <h1>Create a new project</h1>
        <div id="errorMsg">
            <error-msg :msg="error_msg"> </error-msg>
        </div>
        <div>
            <label for="name">name:</label><br />
            <input type="text" id="name" name="name" /><br />

            <label for="description">description:</label><br />
            <textarea
                rows="5"
                cols="60"
                name="description"
                id="description"
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
            <list-input :name="inputName1" ref="hashtags"> </list-input>
            <br />
            <list-input :name="inputName2" ref="texts"> </list-input>
            <button v-on:click="send">send</button>
        </div>
    </div>
</template>

<script>
import ListInput from "../components/ListInput";
import ErrorMsg from "../components/ErrorMsg";
import { isUserNameValid, isBioValid } from "../tools/parser";
import { sendData } from "../tools/network";

export default {
    name: "CreateProject",
    data() {
        return {
            inputName1: "HASHTAG",
            inputName2: "TEXT",
            error_msg: "",
        };
    },
    components: {
        ListInput,
        ErrorMsg,
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
            console.log("HAHAHHAH");
            let hashtags = this.getElems(this.$refs.hashtags.$data);
            let texts = this.getElems(this.$refs.texts.$data);
            let name = document.getElementById("name").value;
            let color = document.getElementById("favcolor").value;
            let description = document.getElementById("description").value;
            //let profilePic = document.getElementById("myfile").value;
            if (isUserNameValid(name) && isBioValid(description)) {
                try {
                    let result = sendData("/createProject", {
                        name: name,
                        color: color,
                        description: description,
                        texts: texts,
                        hashtags: hashtags,
                    });
                    console.log(result);
                } catch (error) {
                    console.log(error);
                    return 0;
                }
            } else {
                this.display = "inline";
                this.error_msg = "description or name error";
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