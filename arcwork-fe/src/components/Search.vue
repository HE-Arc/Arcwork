<template>
    <div>
        <label v-if="label" class="md:inline block appearance-none rounded my-4 py-2 px-3 text-gray-700 leading-tight text-lg ">{{label}}</label>
        <input class="md:inline block appearance-none rounded my-4 py-2 px-3 text-gray-700 md:w-2/3 leading-tight focus:outline-none focus:shadow-outline" :placeholder="placeholder">
    </div>
</template>

<script>

export default {
    props: ["placeholder","label"],
    
};
</script>