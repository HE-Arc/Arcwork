<template>
    <div class="">
        <div id="test" class="rounded-lg bg-white p-2">
            <h1 class="text-3xl" id="title">{{ name }} {{ id }}</h1>
            <p>{{ description }}</p>
            <div class="flex justify-between">
                <Like v-on:click="liked" :n="like" />
                <button v-on:click="extend">
                    <svg class="h-8 w-8 text-black transform transition duration-500 ease-in-out" :class="{'rotate-180': isDisplay }"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />
                        <polyline points="19 12 12 19 5 12" />
                    </svg>
                    </button>
                <button class="bg-green-400 rounded-lg p-2" v-on:click="goToPage">details</button>
            </div>
        </div>
        <div id="body" class="w-11/12 mx-auto  rounded-b-lg bg-gray-200">
            <ul class="flex flex-col gap-3 p-2">
                <li class="break-all" v-for="text in texts" :key="text">
                    {{ text }}
                </li>
            </ul>
            <ul class="p-2">
                <li class="bg-mantis rounded-lg px-2 py-1 inline" v-for="hashtag in hashtags" :key="hashtag">
                    {{ hashtag }}
                </li>
            </ul>
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
            isDisplay: false,
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
                this.texts.push(element);
            });
            data.hashtags.forEach((element) => {
                this.hashtags.push(element);
            });
        },
        extend() {
            this.display = this.display == "none" ? "block" : "none";
            this.isDisplay = !this.isDisplay;
        },
        async liked() {
            sendData("/likeProject/" + this.id);

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
