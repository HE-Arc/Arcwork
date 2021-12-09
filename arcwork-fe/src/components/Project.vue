<template>
    <div
        v-on:click="extend"
        id="test"
        class="
            max-w-sm
            mx-auto
            bg-white
            rounded-xl
            shadow-md
            flex
            items-center
            space-x-4
        "
    >
        <h1 id="title">{{ name }} {{ id }}</h1>

        <p>{{ description }}</p>
        <Like v-on:click="liked" :n="like" />
    </div>
    <div id="body">
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
    props: ["id"],
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
        extend() {
            this.display = this.display == "none" ? "inline" : "none";
        },
        async liked() {
            console.log("liked");
        },
    },
    async created() {
        try {
            let data = await getData("/prjects/" + this.id);
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>


<style >
#test {
    border: 1px solid #eee;
}

#title {
    color: v-bind(color);
}

#body {
    display: v-bind(display);
}
</style>
