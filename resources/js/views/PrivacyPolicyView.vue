<script setup>
import { Card } from 'primevue';
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Privacy Policy</h1>

            <Card>
                <template #content>
                    <h2 class="text-2xl font-semibold mb-4">1. Information We Collect</h2>
                    <p class="mb-4">We collect information you provide directly to us, such as when you create an account, fill out a form, or communicate with us. This may include your name, email address, phone number, and other contact information.</p>

                    <h2 class="text-2xl font-semibold mb-4">2. How We Use Your Information</h2>
                    <p class="mb-4">We use the information we collect to provide, maintain, and improve our services, to communicate with you, and to comply with legal obligations.</p>

                    <h2 class="text-2xl font-semibold mb-4">3. Information Sharing and Disclosure</h2>
                    <p class="mb-4">We do not sell or rent your personal information to third parties. We may share your information with animal shelters when you express interest in adopting a pet.</p>

                    <h2 class="text-2xl font-semibold mb-4">4. Data Security</h2>
                    <p class="mb-4">We take reasonable measures to help protect your personal information from loss, theft, misuse, unauthorized access, disclosure, alteration, and destruction.</p>

                    <h2 class="text-2xl font-semibold mb-4">5. Your Rights</h2>
                    <p class="mb-4">You have the right to access, correct, or delete your personal information. You can do this by logging into your account or contacting us directly.</p>

                    <h2 class="text-2xl font-semibold mb-4">6. Changes to This Policy</h2>
                    <p class="mb-4">We may update this privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page.</p>
                </template>
                
                <template #footer>
                    <p class="mt-8 text-sm text-gray-600">Last updated: {{ new Date().toLocaleDateString() }}</p>
                </template>
            </Card>
        </div>
    </div>
</template>