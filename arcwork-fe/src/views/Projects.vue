<template>
  <div class="projects">
    <h1>all projects ! {{ name }}</h1>
    <Project id="1" />
    <Project id="2" />
    <Project id="3" />
  </div>
</template>

<script>
import Project from "../components/Project";
import { getData } from "../tools/network";
export default {
  name: "Projects",
  components: {
    Project,
  },
  data() {
    return {
      name: "yo",
    };
  },
  methods: {
      loadData(data) {
          this.name = data["name"]
      }
  },
  async created()  {
    let data = await getData("api")
    this.loadData(data)
  }
};
</script>
