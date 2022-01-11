<template>
    <div>
        <NavBar />
        <div class="mx-auto w-8/12">
            <div class="flex justify-between px-14 py-10">
                <div class="">
                    <div class="text-4xl font-bold py-4 pr-2 inline-block">{{ name }}</div>
                    <div class="text-xl inline">#{{ $route.params.id }}</div>
                </div>
                <div class="">
                    <div class="h-32 w-32">
                        <img class="h-28 w-28 m-2 object-scale-down" src="../assets/projectDemo.png">
                    </div>
                </div>
                <div class="p-10">
                    <Like v-on:click="liked" :n="like" />
                </div>
            </div >
            <div>
                
            </div>
            <div id="tabs" class="flex gap-3 ml-4">
                <a class="bg-gray-200 border-2 rounded-t-xl p-2 hover:bg-gray-300" v-on:click="activetab='1'" v-bind:class="[ activetab === '1' ? 'active' : '' ]">Description</a>
                <a class="bg-gray-200 border-2 rounded-t-xl p-2 hover:bg-gray-300" v-on:click="activetab='2'" v-bind:class="[ activetab === '2' ? 'active' : '' ]">Test</a>
                <a class="bg-gray-200 border-2 rounded-t-xl p-2 hover:bg-gray-300" v-on:click="activetab='3'" v-bind:class="[ activetab === '3' ? 'active' : '' ]">Galery</a>
            </div>
            <div id="content">
                 <div v-if="activetab ==='1'" class="flex flex-col gap-8 py-10 bg-gray-200 rounded-xl">
                     <div class="mx-auto">
                        <div class="bg-mantis text-gray-100 rounded-xl px-4 mx-2 inline" v-for="hashtag in hashtags" :key="hashtag">
                            {{ hashtag }}
                        </div>
                    </div>
                    <div class="px-16 my-auto">{{ description }}</div>
                </div>
                <div v-if="activetab ==='2'" class="flex flex-col gap-8 py-10 bg-gray-200 rounded-xl">
                    <li v-for="text in texts" :key="text">
                        {{ text }}
                    </li>
                </div>
                <div v-if="activetab ==='3'" class="flex flex-col gap-8 py-10 bg-gray-200 rounded-xl">
                    <div class="text-3xl text-center">
                        Comming soon
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar";
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
            description: "Lorem Ipsum adaimdsiam doaimdoias moidmasoim asoismdosi moidmsaoi moiasm oimoi moi moimoimimodsam oim oim oimoi mm  mimoismaodimadoa imoidm",
            like: 0,
            color: "FF9022",
            profilePic: 0,
            texts: [],
            hashtags: ["php","js", "java", "hello"],
            display: "none",
            activetab: '1',
        };
    },
    components: {
        Like,
        NavBar
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


<style>

a.active{
    background-color: #BADBE4;
}
</style>
