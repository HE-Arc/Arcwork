<template>
    <div>
        <button class="text-gray-500 w-20 h-16 relative focus:outline-none" @click="isopen = !isopen">
            <span class="sr-only">Open main menu</span>
            <div class="block w-7 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <span aria-hidden="true" class="block absolute h-1 w-7 bg-gray-200 transform transition duration-500 ease-in-out" :class="{'rotate-45': isopen,'-translate-y-2': !isopen }"></span>
                <span aria-hidden="true" class="block absolute h-1 w-7 bg-gray-200 transform transition duration-500 ease-in-out" :class="{'opacity-0': isopen } "></span>
                <span aria-hidden="true" class="block absolute h-1 w-7 bg-gray-200 transform transition duration-500 ease-in-out" :class="{'-rotate-45': isopen, 'translate-y-2': !isopen}"></span>
            </div>
        </button>
        <div class="block absolute bg-black-coral w-1/2 right-0 rounded-bl-3xl transform transition duration-500 ease-in-out" :class="{'translate-x-full': !isopen }" v-show="isopen">
            <ul class="list-none p-0 m-0">
                <li class="block px-4"><router-link class="block text-dark-side-blue p-4 text-xl" to="/about">About</router-link></li>
                <li class="block px-4"><router-link class="block text-dark-side-blue p-4 text-xl" to="/projects">Projects</router-link></li>
                <li class="block px-4"><router-link class="block text-dark-side-blue p-4 text-xl" to="/user/1">Users</router-link></li>
                <li class="block px-4"><router-link class="block text-dark-side-blue p-4 text-xl" to="/createProject">new project</router-link></li>
                <li class="block px-4" v-show="getCookie('token') == ''"><router-link class="block text-dark-side-blue p-4 text-xl" to="/login">Login</router-link></li>
                <li class="block px-4" v-show="getCookie('token') == ''"><router-link class="block text-dark-side-blue p-4 text-xl" to="/createUser" >Sign-In</router-link></li>
            </ul>
        </div>
    </div>
</template>
<script>
import {getCookie} from "../tools/cookie";

export default {
    methods: {
        getCookie(data) {
            return getCookie(data);
        },
    },
    data() {
        return {
            isopen : false,
        };
    },
    
}
</script>