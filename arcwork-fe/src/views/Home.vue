<template>
    <div class="home">
        <h1>welcome !</h1>
        <UserMin id="1" />
        <UserMin id="2" />
    </div>
</template>

<script>
import UserMin from "../components/UserMin";

export default {
    name: "Home",
    components: {
        UserMin,
    },
};
</script>
