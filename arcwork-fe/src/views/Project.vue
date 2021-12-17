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
        <p>{{ text }}</p>
    </div>
</template>

<script>
import Like from "../components/Like";
import { getData } from "../tools/network";
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
            text: "",
            hashtags: [],
            display: "none",
        };
    },
    components: {
        Like,
    },
    methods: {
        loadData(data) {
            this.name = data.name;
            this.description = data.description;
            this.like = data.like;
            this.color = data.color;
            this.profilePic = data.profilePic;
            this.text = data.text;
            data.hashtags.forEach((element) => {
                this.hashtags.push(element);
            });
        },
        async liked() {
            console.log("liked");
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
