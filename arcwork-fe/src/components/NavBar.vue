<template>
    <div id="nav" class="bg-charcoal">
        <ul class="flex justify-between items-center mx-auto md:w-8/12">
            <li class="">
                <Logo class="mx-4" />
            </li>
            <li>
                <router-link class="hidden lg:inline-block text-lg text-dark-side-blue text-underlined py-4 px-2" to="/about">About</router-link>
                <router-link class="hidden lg:inline-block text-lg text-dark-side-blue text-underlined py-4 px-2" to="/projects">Projects</router-link>
                <router-link class="hidden lg:inline-block text-lg text-dark-side-blue text-underlined py-4 px-2" to="/user/1">Users</router-link>
                <router-link class="hidden lg:inline-block text-lg text-dark-side-blue text-underlined py-4 px-2" to="/createProject">new project</router-link>
            </li>
            <li>
                <router-link class="hidden lg:inline-block text-lg text-dark-side-blue text-underlined py-4 px-2" to="/login" v-show="getCookie('token') != ''">Login</router-link>
                <router-link class="hidden lg:inline-block text-lg text-dark-side-blue text-underlined py-4 px-2" to="/createUser" v-show="getCookie('token') != ''">Sign-In</router-link>
                <Hamburger class="inline-block lg:hidden"/>
            </li>

        </ul>
    </div>
</template>

<script>
import Logo from "../components/Logo";
import Hamburger from "../components/Hamburger";
import { getCookie } from '../tools/cookie';

export default {
    components: {
        Logo,
        Hamburger
    },
    methods: {
        getCookie(data) {
            return getCookie(data);
        },
    },
};
</script>
<style>
/*
* Text souligné
*/

.text-underlined{
  position: relative;
  overflow: hidden;

  will-change: color;
  transition: color 1s ease-out ; 
}

.text-underlined::before, 
.text-underlined::after{
  content: "";
  width: 0;
  height: 3px;
  background-color: #6CC25B;

  will-change: width;
  transition: width .1s ease-out;

  position: absolute;
  bottom: 0;
}

.text-underlined::before{
  left: 50%;
  transform: translateX(-50%); 
}

.text-underlined::after{
  right: 50%;
  transform: translateX(50%); 
}

.text-underlined:hover::before, 
.text-underlined:hover::after{
  width: 100%;
  transition-duration: .2s;
}
</style>
