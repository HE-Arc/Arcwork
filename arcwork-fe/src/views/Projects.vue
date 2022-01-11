<template>
    <NavBar />
    <div class="w-1/2 mx-auto">
        <div class="flex flex-row space-x-7">
            <Search
                class="flex-1"
                placeholder="Recherche"
                label="Recherche"
                ref="searchBar"
            />
            <input
                class="
                    cursor-pointer
                    bg-green-400
                    rounded
                    px-2
                    my-4
                    hover:bg-green-500
                "
                type="button"
                value="Rechercher"
                v-on:click="search"
            />
        </div>
        <div class="flex flex-col space-y-7">
            <div v-for="elem in projects" :key="elem">
                <ProjectMin :id="elem.id" />
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar";
import Search from "../components/Search.vue";
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
            input: "",
        };
    },
    methods: {
        search() {
            this.input = this.$refs.searchBar.data;
            this.projects.sort(this.sortProjects);
        },

        //utilisé pour dire quel mot est le plus proche du mot recherché entre 2 mots
        sortProjects(w1, w2) {
            let b1 = w1.name.includes(this.input);
            let b2 = w2.name.includes(this.input);
            if ((b2 && b1) || (!b2 && !b1)) {
                return 0;
            }
            if (b1) {
                return -1;
            }
            return 1;
        },

        loadData(data) {
            data.forEach((element) => {
                this.projects.push({ id: element.id, name: element.name });
            });
        },
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
