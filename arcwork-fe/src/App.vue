<template>
    <div class="w-full">
        <div id="nav" class="bg-gray-700">
            <div class="py-2 mx-auto w-9/12">
                <Logo class="mx-4" />
                <router-link class="text-xl text-underlined p-4" to="/about"
                    >About</router-link
                >
                <router-link class="text-xl text-underlined p-4" to="/projects"
                    >Projects</router-link
                >
                <router-link class="text-xl text-underlined p-4" to="/user/1"
                    >Users</router-link
                >
                <router-link class="text-xl text-underlined p-4" to="/login"
                    >Login</router-link
                >
                <router-link
                    class="text-xl text-underlined p-4"
                    to="/createProject"
                    >new project</router-link
                >
                <router-link
                    class="text-xl text-underlined p-4"
                    to="/createUser"
                    >new user</router-link
                >
            </div>
        </div>
        <div id="content" class="w-8/12 m-auto">
            <router-view />
        </div>
    </div>
</template>

<script>
import Logo from "./components/Logo";

export default {
    components: {
        Logo,
    },
};
</script>


<style>
.text-underlined {
    position: relative;
    overflow: hidden;

    will-change: color;
    transition: color 1s ease-out;
}

.text-underlined::before,
.text-underlined::after {
    content: "";
    width: 0;
    height: 3px;
    background-color: green;

    will-change: width;
    transition: width 0.1s ease-out;

    position: absolute;
    bottom: 0;
}

.text-underlined::before {
    left: 50%;
    transform: translateX(-50%);
}

.text-underlined::after {
    right: 50%;
    transform: translateX(50%);
}

.text-underlined:hover::before,
.text-underlined:hover::after {
    width: 100%;
    transition-duration: 0.2s;
}

/*#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

#nav {
    padding: 30px;
}

#nav a {
    font-weight: bold;
    color: #2c3e50;
}

#nav a.router-link-exact-active {
    color: #42b983;
}*/
</style>
