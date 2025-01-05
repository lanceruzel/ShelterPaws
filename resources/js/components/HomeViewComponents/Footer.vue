<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <footer class="bg-gray-100 text-gray-600 py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="flex flex-col items-center md:items-start justify-start">
                    <RouterLink to="/" class="flex items-center space-x-2 mb-4">
                        <span class="text-xl font-semibold text-gray-900">ShelterPaws</span>
                    </RouterLink>

                    <p class="text-sm">Connecting pets with loving homes.</p>
                </div>

                <div class="flex flex-col items-center md:items-start justify-start">
                    <h3 class="text-sm font-semibold mb-4 text-gray-900">Quick Links</h3>

                    <ul class="space-y-2 text-sm flex flex-col items-center md:items-start justify-start">
                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">Adopt a Pet</RouterLink>
                        </li>

                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">Find Shelters</RouterLink>
                        </li>

                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">About</RouterLink>
                        </li>

                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">Contact</RouterLink>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col items-center md:items-start justify-start">
                    <h3 class="text-sm font-semibold mb-4 text-gray-900">Resources</h3>

                    <ul class="space-y-2 text-sm flex flex-col items-center md:items-start justify-start">
                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">Blog</RouterLink>
                        </li>

                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">FAQ</RouterLink>
                        </li>

                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">Privacy Policy</RouterLink>
                        </li>

                        <li>
                            <RouterLink :to="{ name: 'home' }" class="hover:text-teal-500 transition-colors">Terms of Service</RouterLink>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col items-center md:items-start justify-start">
                    <h3 class="text-sm font-semibold mb-4 text-gray-900">Connect With Us</h3>

                    <div class="flex space-x-4">
                        <a href="#" className="text-gray-400 hover:text-teal-500 transition-colors">
                            <i class="pi pi-facebook" style="font-size: 1.3rem"></i>
                        </a>

                        <a href="#" className="text-gray-400 hover:text-teal-500 transition-colors">
                            <i class="pi pi-twitter" style="font-size: 1.3rem"></i>
                        </a>

                        <a href="#" className="text-gray-400 hover:text-teal-500 transition-colors">
                            <i class="pi pi-instagram" style="font-size: 1.3rem"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200 text-center text-sm text-gray-400">
                © {{ new Date().getFullYear() }} ShelterPaws. All rights reserved.
            </div>
        </div>
    </footer>
</template>