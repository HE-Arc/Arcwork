<template>
    <NavBar />
    <div class="w-1/2 mx-auto">
        <div class="flex flex-row space-x-7">
            <Search class="flex-1" placeholder="Recherche" label="Recherche"/>
            <input class="cursor-pointer bg-green-400 rounded px-2 my-4 hover:bg-green-500" type="button" value="Rechercher" v-on:click="search"/>
        </div>
        <div class="flex flex-col space-y-7">
            <ProjectMin id="1" />
            <ProjectMin id="2" />
            <ProjectMin id="3" />
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar";
import Search from '../components/Search.vue';
import ProjectMin from "../components/ProjectMin";
import { getData } from "../tools/network";
const testData = { name: "matthieu123" };

export default {
    name: "Projects",
    components: {
        ProjectMin,
        NavBar,
        Search,
    },
    data() {
        return {
            name: "yo",
        };
    },
    methods: {
        loadData(data) {
            this.name = data["name"];
        },
    },
    async created() {
        try {
            let data = await getData("api");
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>
