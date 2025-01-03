<script setup>
import { Card } from 'primevue';

const testimonials = [
  {
    name: 'Sarah Johnson',
    role: 'Pet Parent',
    content: "ShelterPaws made it so easy to find our perfect furry friend. We couldn't be happier with our new family member!",
    image: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80'
  },
  {
    name: 'Mike Thompson',
    role: 'Shelter Manager',
    content: "As a shelter manager, ShelterPaws has been a game-changer. It's helped us connect more pets with loving homes.",
    image: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80'
  },
  {
    name: 'Emily Davis',
    role: 'Volunteer',
    content: "I love how ShelterPaws brings together shelters and adopters. It's made volunteering even more rewarding!",
    image: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80'
  }
]
</script>

<template>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">What People Are Saying</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <Card v-for="testimonial in testimonials" :key="testimonial.name" class="bg-gray-50">
                    <template #title>
                        <div class="flex items-center mb-4">
                            <img :src="testimonial.image" class="w-12 h-12 rounded-full mr-4 object-cover" :alt="testimonial.name" />

                            <div>
                                <h3 v-text="testimonial.name" class="font-semibold text-gray-900"></h3>
                                <p v-text="testimonial.role" class="text-sm text-gray-6000"></p>
                            </div>
                        </div>
                    </template>

                    <template #content>
                        <p class="text-gray-600 italic text-center">"{{ testimonial.content }}"</p>
                    </template>

                </Card>
            </div>
        </div>
    </section>
</template>