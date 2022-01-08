<template>
    <div class="bg-white rounded-lg border-0">
        <div v-on:click="extend" id="test" class="p-2">
            <h1 class="text-3xl" id="title">{{ name }} {{ id }}</h1>
            <p>{{ description }}</p>
            <Like v-on:click="liked" :n="like" />
        </div>
        <div id="body">
            <ul>
                <li v-for="hashtag in hashtags" :key="hashtag">
                    {{ hashtag }}
                </li>
            </ul>
            <button v-on:click="goToPage">details</button>
        </div>
    </div>
</template>

<script>
import Like from "../components/Like";
import { getData, sendData } from "../tools/network";
import { goTo } from "../tools/nav";
const testData = {
    name: "test p",
    description: "projet de dev web avec du vue !!",
    like: 101,
    color: "#3ce312",
    profilePic: 0,
    text: "qsqdslkqdslmd qds lm dsqlmdsqlkmdqslkmqdslkmd lkqdslkdqslkmqdsklqdsm",
    hashtags: ["vue", "js", "php", "tailwind", "laravel"],
};

export default {
    props: ["id"],
    data() {
        return {
            name: "projet",
            description: "",
            like: 0,
            color: "",
            profilePic: 0,
            texts: [],
            hashtags: [],
            display: "none",
        };
    },
    components: {
        Like,
    },
    methods: {
        loadData(data) {
            this.name = data.project.name;
            this.description = data.project.description;
            this.like = data.project.like;
            this.color = data.project.color;
            this.profilePic = data.project.profilePic;
            data.texts.forEach((element) => {
                this.hashtags.push(element);
            });
            data.hashtags.forEach((element) => {
                this.hashtags.push(element);
            });
        },
        extend() {
            this.display = this.display == "none" ? "inline" : "none";
        },
        async liked() {
            sendData("/likeProject", { id: this.id });
            this.like = this.like + 1;
        },

        goToPage() {
            goTo("/project/" + this.id);
        },
    },
    async created() {
        try {
            let data = await getData("/projects/" + this.id);
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>


<style >
#title {
    color: v-bind(color);
}

#body {
    display: v-bind(display);
}
</style>
