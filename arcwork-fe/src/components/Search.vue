<template>
    <div>
        <label v-if="label" class="appearance-none rounded my-4 py-2 px-3 text-gray-700 leading-tight text-lg">{{label}}</label>
        <input class="appearance-none rounded my-4 py-2 px-3 text-gray-700 w-2/3 leading-tight focus:outline-none focus:shadow-outline" :placeholder="placeholder">
    </div>
</template>

<script>

export default {
    props: ["placeholder","label"],
    /*data() {
        return {
            message: "Hello",s
        };
    },*/
};
</script>