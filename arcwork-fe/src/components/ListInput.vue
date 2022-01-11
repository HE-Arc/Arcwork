<template>
    <div>
        <div class="flex flex-row justify-between border-b-2 border-black">
            <div class="p-2 inline-block font-bold text-lg">{{ name }} </div>
            <button v-on:click="newElement">
                <svg class="h-8 w-8 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />  
                    <line x1="12" y1="8" x2="12" y2="16" />  
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
            </button>
        </div>
        <ul class="flex flex-col gap-2 p-2">
            <li class="bg-white rounded-xl p-2 shadow-lg" v-for="elem in elements" :key="elem">
                {{ elem }}
            </li>
        </ul>
        <input class="p-1 rounded-md appearance-none focus:outline-none focus:shadow-outline" type="text" id="element" name="element" @keyup.enter="newElement"/>
    </div>
</template>

<script>
import { isElementValid } from "../tools/parser";

export default {
    props: ["name"],
    data() {
        return {
            elements: new Array(),
        };
    },
    methods: {
        newElement() {
            let element = this.$el.querySelector("#element").value;
            if (isElementValid(element)) {
                this.elements.push(element);
                this.$el.querySelector("#element").value = "";
            }
        },
        getValue() {
            return this.elements;
        },
    },
};
</script>

<style >
</style>