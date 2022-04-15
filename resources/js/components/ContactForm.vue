<template>

    <div class="container mx-auto p-8">
        <form ref="contactForm"
              @submit="formSubmit"
              class="w-full max-w-lg">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="fullName"
                           class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        Your Name
                    </label>
                    <input id="fullName"
                           v-model="fullName"
                           class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           type="text"
                           placeholder="Your Name">
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        E-mail
                    </label>
                    <input id="email"
                           v-model="email"
                           class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           type="email"
                           placeholder="Your Email">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                        Phone
                    </label>
                    <input id="phone"
                           v-model="phone"
                           class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           type="tel"
                           placeholder="Phone">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="message">
                        Message
                    </label>
                    <textarea id="message"
                              v-model="message"
                              placeholder="Message"
                              class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none"></textarea>
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <button class="shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit">
                        Send
                    </button>
                </div>
            </div>
            <div class="py-2">
                <template v-if="success !== ''">
                    <p v-text="success"></p>
                </template>
                <template v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors">
                            <p v-text="error"></p>
                        </li>
                    </ul>
                </template>
            </div>

        </form>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    mounted() {
        console.log('Component mounfted.')
    },
    data() {
        return {
            fullName: '',
            email: '',
            phone: '',
            message: '',
            errors: [],
            success: ''
        };
    },
    methods: {
        formSubmit(e) {
            var VueApp = this;
            e.preventDefault();
            axios.post('/formSubmit', {
                name: VueApp.fullName,
                email: VueApp.email,
                phone: VueApp.phone,
                message: VueApp.message
            })
                .then(function (response) {
                    VueApp.success = response.data.success;
                    VueApp.errors = [];
                    VueApp.fullName = '';
                    VueApp.email = '';
                    VueApp.phone = '';
                    VueApp.message = '';
                })
                .catch(function (error) {debugger
                    var response = error.response.data;
                    VueApp.errors = response.errors;
                    VueApp.success = '';
                });
        }
    },
}
</script>
