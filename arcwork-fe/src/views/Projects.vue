<template>
    <div class="projects">
        <h1>all projects ! {{ name }}</h1>
        <div class="flex flex-col space-y-7"></div>
        <ul>
            <li v-for="id in projects" :key="id">
                <ProjectMin :id="id"> </ProjectMin> <br />
            </li>
        </ul>
    </div>
</template>

<script>
import ProjectMin from "../components/ProjectMin";
import { getData } from "../tools/network";
const testData = { name: "matthieu123" };

export default {
    name: "Projects",
    components: {
        ProjectMin,
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
