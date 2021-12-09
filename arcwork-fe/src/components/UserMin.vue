<template>
    <div>
        <h1>{{ pseudo }}</h1>
        <p>{{ bio }}</p>
    </div>
</template>
<script>
import { getData } from "../tools/network";
const testData = {
    pseudo: "matthieu",
    profilePic: 0,
    bio: "bla bla",
};

export default {
    props: ["id"],
    data() {
        return {
            pseudo: "",
            profilePic: 0,
            bio: "",
        };
    },
    components: {},
    methods: {
        loadData(data) {
            this.pseudo = data.pseudo;
            this.profilePic = data.profilePic;
            this.bio = data.bio;
        },
    },
    async created() {
        try {
            let data = await getData("/users/" + this.id);
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>



<style >
</style>