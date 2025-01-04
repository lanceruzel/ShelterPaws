<script setup>
import { Card, Button } from 'primevue';
import Footer from '../components/HomeViewComponents/Footer.vue';
</script>

<template>
    <section class="py-20 bg-cover bg-center relative overflow-hidden">
        <div class="absolute brightness-[.3] w-full h-full top-0" style="background-image: url('https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60')"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-4xl font-bold mb-8 text-center text-white">About ShelterPaws</h1>

            <div class="bg-white bg-opacity-90 rounded-lg p-8">
                <h2 class="text-3xl font-semibold mb-4 text-gray-900">Our Mission</h2>
                <p class="text-gray-600 mb-4">
                    ShelterPaws is dedicated to connecting loving homes with pets in need. We believe every animal
                    deserves a chance at a happy life, and we're committed to making the adoption process as smooth and
                    joyful as possible for both pets and their new families.
                </p>
                <p class="text-gray-600">
                    Our platform serves as a bridge between shelters, adopters, and volunteers, creating a community
                    united by the love for animals and the desire to make a difference in their lives.
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 className="text-3xl font-semibold mb-12 text-center">Our Vision</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <Card>
                    <template #title >
                        <div class="flex flex-col justify-center items-center">
                            <i class="pi pi-home text-teal-500" style="font-size: 2rem"></i>
                            <h3 class="text-xl font-semibold mb-2 mt-2">A Home for Every Pet</h3>
                        </div>
                    </template>

                    <template #content>
                        <p class="text-center">We envision a world where every pet has a loving home, and no animal is left behind in shelters.</p>
                    </template>
                </Card>

                <Card>
                    <template #title>
                        <div class="flex flex-col justify-center items-center">
                            <i class="pi pi-home text-teal-500" style="font-size: 2rem"></i>
                            <h3 class="text-xl font-semibold mb-2 mt-2">Community Engagement</h3>
                        </div>
                    </template>

                    <template #content>
                        <p class="text-center">We aim to foster a community of pet lovers who support each other and advocate for animal welfare.</p>
                    </template>
                </Card>

                <Card>
                    <template #title>
                        <div class="flex flex-col justify-center items-center">
                            <i class="pi pi-home text-teal-500" style="font-size: 2rem"></i>
                            <h3 class="text-xl font-semibold mb-2 mt-2">Education and Awareness</h3>
                        </div>
                    </template>

                    <template #content>
                        <p class="text-center">We strive to educate the public about responsible pet ownership and the importance of adoption.</p>
                    </template>
                </Card>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                <Card>
                    <template #title >
                        <h2 class="font-semibold">For Adopters</h2>
                    </template>

                    <template #content>
                        <p class="text-gray-600 mb-4">We provide a user-friendly platform to browse available pets, learn about their personalities, and connect with shelters. Our goal is to help you find the perfect furry companion to join your family.</p>
                        
                        <ul className="list-disc list-inside text-gray-600 mb-4">
                            <li>Easy-to-use search and filter options</li>
                            <li>Detailed pet profiles with photos and descriptions</li>
                            <li>Direct communication with shelters</li>
                            <li>Resources for new pet owners</li>
                        </ul>
                    </template>

                    <template #footer>
                        <Button label="Start Your Adoption Journey" />
                    </template>
                </Card>

                <Card>
                    <template #title >
                        <h2 class="font-semibold">For Shelters</h2>
                    </template>

                    <template #content>
                        <p class="text-gray-600 mb-4">ShelterPaws offers tools to help shelters showcase their animals, manage adoption requests, and reach a wider audience of potential adopters. We're here to support your mission of finding forever homes for animals in need.</p>
                        
                        <ul className="list-disc list-inside text-gray-600 mb-4">
                            <li>Easy pet listing management</li>
                            <li>Adoption application tracking</li>
                            <li>Volunteer coordination tools</li>
                            <li>Analytics and reporting features</li>
                        </ul>
                    </template>

                    <template #footer>
                        <Button label="Start Your Adoption Journey" />
                    </template>
                </Card>
            </div>
        </div>
    </section>

    <section className="py-20 bg-teal-600 text-white">
        <div className="container mx-auto px-4 text-center">
            <h2 className="text-3xl font-semibold mb-8">Our Impact</h2>

            <div className="grid md:grid-cols-3 gap-8">
                <div>
                    <p className="text-4xl font-bold mb-2">10,000+</p>
                    <p className="text-xl">Pets Adopted</p>
                </div>
                
                <div>
                    <p className="text-4xl font-bold mb-2">500+</p>
                    <p className="text-xl">Partner Shelters</p>
                </div>

                <div>
                    <p className="text-4xl font-bold mb-2">100,000+</p>
                    <p className="text-xl">Happy Families</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <h2 className="text-3xl font-semibold mb-8">Join Our Mission</h2>
            <p className="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
              Whether you're looking to adopt, volunteer, or support our cause, there are many ways to get involved with ShelterPaws and make a difference in the lives of animals.
            </p>

            <div className="flex justify-center space-x-4">
                <Button label="Adopt" />
            </div>
        </div>
    </section>
</template>