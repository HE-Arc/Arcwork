<template>
    <div class="home">
        <Search/>
        <h1>welcome !</h1>
        <UserMin id="1" />
        <UserMin id="2" />
    </div>
</template>

<script>
import Search from '../components/Search.vue';
import UserMin from "../components/UserMin";

export default {
    name: "Home",
    components: {
        UserMin,
        Search,
    },
};
</script>
