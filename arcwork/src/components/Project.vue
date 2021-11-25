<template>
  <div id="test">
    <h1>{{ name }} {{ id }}</h1>
    <ul>
      <li v-for="hashtag in hashtags" :key="hashtag">
        {{ hashtag }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      name: "projet",
      hashtags: ["go", "linux", "c++"],
    };
  },

  created: () => {
    console.log("yolo");
  },
};
</script>


<style >
#test {
  border: 1px solid #eee;
}
</style>
