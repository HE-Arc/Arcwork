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
        <div class="block absolute bg-black-coral w-1/2 right-0 rounded-bl-3xl transform transition duration-500 ease-in-out" :class="{'translate-x-full': !isopen }">
            <ul class="list-none p-0 m-0">
                <li class="block px-4"><a class="block transition duration-300 ease-in p-4 text-xl" href="">Top</a></li>
                <li class="block px-4"><a class="block transition duration-300 ease-in p-4 text-xl" href="">About</a></li>
                <li class="block px-4"><a class="block transition duration-300 ease-in p-4 text-xl" href="">Blog</a></li>
                <li class="block px-4"><a class="block transition duration-300 ease-in p-4 text-xl" href="">Work</a></li>
                <li class="block px-4"><a class="block transition duration-300 ease-in p-4 text-xl" href="">Link</a></li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isopen : false,
        };
    },
    
}
</script>
<style>
body {
  overflow-x: hidden;
}
</style>