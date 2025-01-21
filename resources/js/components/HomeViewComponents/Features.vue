<script setup>
const features = [
    {
        icon: 'pi-search',
        title: 'Easy Search',
        description: 'Find pets based on species, breed, age, and location.'
    },
    {
        icon: 'pi-heart',
        title: 'Save Favorites',
        description: "Keep track of pets you're interested in adopting."
    },
    {
        icon: 'pi-home',
        title: 'Shelter Dashboard',
        description: 'Manage pet listings and adoption requests efficiently.'
    } 
]
</script>

<template>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">How ShelterPaws Works</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div v-for="feature in features" :key="feature.title" class="text-center">
                    <i :class="'pi ' + feature.icon" class="text-teal-500" style="font-size: 2rem"></i>
                    <h3 v-text="feature.title" class="text-xl font-semibold mb-2"></h3>
                    <p v-text="feature.description" class="text-gray-600"></p>
                </div>
            </div>
        </div>
    </section>
</template>