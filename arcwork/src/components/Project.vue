<template>
  <div id="test" class=" max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
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
      description: "",
      like: 0,
      color: 0,
      profilePic: 0,
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
