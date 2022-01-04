<template>
    <div class="home">
        <div class="w-1/2 mx-auto">
            <div class="text-5xl font-bold my-10">Welcome to Arcwork</div>
            <div class="flex flex-row space-x-7">
                <Search class="inline-block" placeholder="Email"/>
                <input class="cursor-pointer bg-green-400 rounded px-4 my-4 hover:bg-green-500" type="button" value="Sign in">
            </div>
        </div>
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
