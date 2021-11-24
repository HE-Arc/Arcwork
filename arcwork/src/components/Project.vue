<template>
    <h1>{{name}} {{ id }}</h1>
</template>

<script>
export default {
    props : ['id'],
    data() {
        return {
            name : "projet"
        }
    },

    created: () => {
        console.log("yolo")
    }

}
</script>
