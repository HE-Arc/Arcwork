<template>
    <NavBar />
    <div class="lg:w-1/2 mx-auto p-2">
        <div class="flex flex-row">
            <Search class="flex-1" placeholder="Recherche" label="Recherche"/>
            <input class="cursor-pointer bg-green-400 rounded px-2 my-4 hover:bg-green-500" type="button" value="Rechercher" v-on:click="search"/>
        </div>
        <div class="flex flex-col space-y-7">
            <div v-for="id in projects" :key="id">
                <ProjectMin :id="id"/>
            </div>
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
            projects: [],
        };
    },
    methods: {
        loadData(data) {
            data.forEach((element) => {
                this.projects.push(element.id);
            });
        },
        search(){
            
        }
    },
    async created() {
        try {
            let data = await getData("/projects");
            this.loadData(data);
        } catch (error) {
            this.loadData(testData);
        }
    },
};
</script>
