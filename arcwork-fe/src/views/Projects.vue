<template>
    <div class="projects">
        <h1>all projects ! {{ name }}</h1>
        <div class="flex flex-col space-y-7">
            <ProjectMin id="1" />
            <ProjectMin id="2" />
            <ProjectMin id="3" />
        </div>
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
