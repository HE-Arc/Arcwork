<template>
    <div>
        {{ name }} <button v-on:click="newElement">new</button><br />
        <ul>
            <li v-for="elem in elements" :key="elem">
                {{ elem }}
            </li>
        </ul>
        <input type="text" id="element" name="element" />
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