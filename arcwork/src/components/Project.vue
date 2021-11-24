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
    }

}
</script>
