<template>
    <div>{{ $route.params.id }}</div>
    <h1>{{ name }}</h1>
    <p>{{ creationDate }}</p>
    <Like v-on:click="liked" :n="like" />
    <p>{{ bio }}</p>
</template>

<script>
import { getData } from "../tools/network";
import Like from "../components/Like";

const testData = {
    name: "mat",
    bio: "bla, bla, bla ...",
    like: 0,
    creationDate: "12/12/12",
    color: "blue",
    profilePic: "",
};
export default {
    data() {
        return {
            name: "user",
            bio: "",
            creationDate: 0,
            like: 0,
            color: "",
            profilePic: "",
        };
    },
    components: {
        Like,
    },
    methods: {
        loadData(data) {
            this.name = data.name;
            this.bio = data.bio;
            this.like = data.like;
            this.color = data.color;
            this.profilePic = data.profilePic;
            this.creationDate = data.creationDate;
        },
        async liked() {
            console.log("liked");
        },
    },
    async created() {
        try {
            let data = await getData("/users/" + this.$route.params.id);
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>

<style>
</style>