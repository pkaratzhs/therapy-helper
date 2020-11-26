<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="fixed-top bg-white">
        <div class="mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <router-link to="/">Therapy Helper</router-link>
                </div>
                <nav class="md:flex space-x-10">nav</nav>
                <div class="md:flex items-center justify-end md:flex-1 lg:w-0">
                    <!-- PROFILE -->
                    <div class="mr-5 relative"
                        v-if="getLoggedIn">
                        <div class="flex items-center">
                            <div class="mr-4">{{ getUser.name}}</div>
                            <button class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu"
                                aria-haspopup="true"
                                @click="isAccountOpen = !isAccountOpen">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-7 w-7 rounded-full bg-white"
                                    src="@/assets/icons/user.png"
                                    alt="">
                            </button>
                        </div>
                        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                            v-bind:class="{'hidden': !isAccountOpen, 'block':isAccountOpen}">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                @click.prevent="logOut()">Log Out</a>
                        </div>
                    </div>
                    <!-- /PROFILE -->
                    <div v-if="!getLoggedIn">
                        <router-link to="login"
                            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                            Είσοδος</router-link>
                        <router-link to="register"
                            class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Εγγραφή
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!--
    Mobile menu, show/hide based on mobile menu state.

    Entering: "duration-200 ease-out"
      From: "opacity-0 scale-95"
      To: "opacity-100 scale-100"
    Leaving: "duration-100 ease-in"
      From: "opacity-100 scale-100"
      To: "opacity-0 scale-95"
  -->
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    data() {
        return {
            isAccountOpen: false,
        };
    },
    methods: {
        ...mapActions('auth', ['logOut']),
    },
    computed: {
        ...mapGetters('auth', ['getLoggedIn', 'getUser']),
    },
};
</script>
