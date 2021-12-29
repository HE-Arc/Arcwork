<template>
    <div class="w-8/12 m-auto">
        <input class="shadow appearance-none border rounded w-full my-4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="message" placeholder="modifiez-moi">
        <p>Le message est : {{ message }}</p>
    </div>
</template>

<script>

export default {
  data() {
        return {
            message: "Hello",
        };
    },
};
</script>