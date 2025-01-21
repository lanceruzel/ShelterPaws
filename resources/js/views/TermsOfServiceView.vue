<script setup>
import { Card } from 'primevue';
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Terms of Service</h1>

            <Card>
                <template #content>
                    <h2 class="text-2xl font-semibold mb-4">1. Acceptance of Terms</h2>
                    <p class="mb-4">By accessing or using ShelterPaws, you agree to be bound by these Terms of Service and all applicable laws and regulations.</p>

                    <h2 class="text-2xl font-semibold mb-4">2. Use of the Service</h2>
                    <p class="mb-4">You may use ShelterPaws only for lawful purposes and in accordance with these Terms of Service. You agree not to use ShelterPaws in any way that could damage, disable, overburden, or impair the service.</p>

                    <h2 class="text-2xl font-semibold mb-4">3. User Accounts</h2>
                    <p class="mb-4">You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.</p>

                    <h2 class="text-2xl font-semibold mb-4">4. Content</h2>
                    <p class="mb-4">You retain all rights to any content you submit, post or display on or through ShelterPaws. By submitting, posting or displaying content, you grant us a worldwide, non-exclusive, royalty-free license to use, reproduce, adapt, publish, translate and distribute it.</p>

                    <h2 class="text-2xl font-semibold mb-4">5. Termination</h2>
                    <p class="mb-4">We may terminate or suspend your account and bar access to the service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation.</p>

                    <h2 class="text-2xl font-semibold mb-4">6. Limitation of Liability</h2>
                    <p class="mb-4">In no event shall ShelterPaws, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the service.</p>

                    <h2 class="text-2xl font-semibold mb-4">7. Changes to Terms</h2>
                    <p class="mb-4">We reserve the right to modify or replace these Terms at any time. If a revision is material we will provide at least 30 days' notice prior to any new terms taking effect.</p>

                </template>
                
                <template #footer>
                    <p class="mt-8 text-sm text-gray-600">Last updated: {{ new Date().toLocaleDateString() }}</p>
                </template>
            </Card>
        </div>
    </div>
</template>