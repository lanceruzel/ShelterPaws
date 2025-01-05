<script setup>
import { Button, Card } from 'primevue';

const features = [
    {
        icon: 'pi-search',
        title: 'Find Your Perfect Match',
        description: 'Browse through our database of adorable pets waiting for their forever homes.'
    },
    {
        icon: 'pi-heart',
        title: 'Save a Life',
        description: "By adopting, you're giving a deserving animal a second chance at happiness."
    },
    {
        icon: 'pi-home',
        title: 'Support Local Shelters',
        description: 'Partner with us to showcase your shelter\'s animals and increase adoption rates.'
    },
]
</script>

<template>
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 text-center">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Make a Difference?</h2>
                    <p class="text-xl mb-8 max-w-2xl mx-auto">Whether you're looking to adopt or you're a shelter in need of support, we're here to help connect loving homes with pets in need.</p>
                    
                    <div class="space-x-4">
                        <Button as="router-link" label="Find a Pet" to="/" />
                        <Button as="router-link" label="Register Your Shelter" to="/" severity="secondary" />
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    <Card>
                        <template #title>
                            <i class="pi pi-search text-teal-500" style="font-size: 2rem"></i>
                            <h3 class="text-xl font-semibold mb-2 mt-2">Find Your Perfect Match</h3>
                        </template>

                        <template #content>
                            <p>Browse through our database of adorable pets waiting for their forever homes.</p>
                        </template>
                    </Card>

                    <Card>
                        <template #title>
                            <i class="pi pi-heart text-teal-500" style="font-size: 2rem"></i>
                            <h3 class="text-xl font-semibold mb-2 mt-2">Save a Life</h3>
                        </template>

                        <template #content>
                            <p>By adopting, you're giving a deserving animal a second chance at happiness.</p>
                        </template>
                    </Card>

                    <Card class="col-span-2">
                        <template #title>
                            <i class="pi pi-home text-teal-500" style="font-size: 2rem"></i>
                            <h3 class="text-xl font-semibold mb-2 mt-2">Support Local Shelters</h3>
                        </template>

                        <template #content>
                            <p>Partner with us to showcase your shelter's animals and increase adoption rates.</p>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </section>
</template>