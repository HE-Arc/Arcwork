<template>
    <NavBar />
    <div class="md:w-1/2 mx-auto">
        <div class="text-5xl font-bold my-10">Welcome to Arcwork</div>
        <div class="flex flex-row space-x-7">
            <Search class="flex-1" placeholder="Recherche" label="Recherche"/>
            <input class="cursor-pointer bg-green-400 rounded px-2 my-4 hover:bg-green-500" type="button" value="Rechercher" v-on:click="search"/>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar";
import Search from '../components/Search.vue';

export default {
    name: "Home",
    components: {
        Search,
        NavBar,
    },
    method: {
        search(){
            console.log("HELLO");
        },
    }
};
</script>
