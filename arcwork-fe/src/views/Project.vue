<template>
    <div>
        Project {{ name }}
        <p>{{ description }}</p>
        <Like v-on:click="liked" :n="like" />
        <ul>
            <li v-for="hashtag in hashtags" :key="hashtag">
                {{ hashtag }}
            </li>
        </ul>

        <ul>
            <li v-for="text in texts" :key="text">
                {{ text }}
            </li>
        </ul>
    </div>
</template>

<script>
import Like from "../components/Like";
import { getData, sendData } from "../tools/network";
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
        async liked() {
            sendData("/likeProject/" + this.$route.params.id, {});
            this.like = this.like + 1;
        },
    },
    async created() {
        try {
            let data = await getData("/projects/" + this.$route.params.id);
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>


<style >
</style>
