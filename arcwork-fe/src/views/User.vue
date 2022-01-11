<template>
    <div>
        <NavBar />
        <div class="mx-auto md:w-8/12">
            <div class="md:flex justify-between md:px-14 py-10">
                <div class="flex justify-center">
                    <div class="text-4xl font-bold py-4 pr-2 inline-block">{{ name }}<div class="text-xl inline">#{{ $route.params.id }}</div></div>
                    <div class="break-words">
                        {{ bio }}
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class=" h-32 w-32">
                        <img class="h-28 w-28 m-2 object-scale-down" src="../assets/ArcworkLogo.png">
                    </div>
                </div>
                <div class="flex justify-center md:p-10 p-0">
                    <Like v-on:click="liked" :n="like" />
                    <p>{{ creationDate }}</p>
                </div>
            </div >
            <div class="flex flex-col w-3/4 m-auto space-y-7">
                <ProjectMin id="1"/>
                <ProjectMin id="2"/>
                <ProjectMin id="3"/>
                <ProjectMin id="3"/>
                <ProjectMin id="3"/>
                <ProjectMin id="3"/>
                <ProjectMin id="3"/>
                <ProjectMin id="3"/>
                <ProjectMin id="3"/>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar";
import { getData, sendData } from "../tools/network";
import Like from "../components/Like";
import ProjectMin from "../components/ProjectMin";

const testData = {
    name: "MatLePirrate",
    bio: "Developpre en piraterie",
    like: 0,
    creationDate: "12/10/2012",
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
        NavBar,
        ProjectMin,
    },
    methods: {
        loadData(data) {
            this.name = data.pseudo;
            this.bio = data.bio;
            this.like = data.like;
            this.color = data.color;
            this.profilePic = data.profilePic;
            this.creationDate = data.creationDate;
        },
        async liked() {
            sendData("/likeUser", { id: this.$route.params.id });
            this.like = this.like + 1;
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