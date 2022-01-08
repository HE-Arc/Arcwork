<template>
  <NavBar/>
  <div class="w-8/12 mx-auto p-10">
    <div class="text-center text-2xl">Arcwork est un site de référencement de projet</div>
    <div class="text-center text-2xl">Tu peux y stocker ce que tu veux</div>
    <div class="text-center text-2xl">De la rénovation de ta maison à ton projet de faire le tour du monde</div>
    
    <img class="w-1/2 mt-10 m-auto" src="../assets/logo_ing.png">
  </div>
</template>

<script>
import NavBar from "../components/NavBar";

export default {
    name: "About",
    components: {
        NavBar,
    },
    method: {
        search(){
            console.log("HELLO");
        },
    }
};
</script>