<script setup>
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import { Card } from 'primevue';

const faqs = [
    {
        question: "How does the adoption process work?",
        answer: "The adoption process typically involves browsing available pets, submitting an application, going through a screening process, meeting the pet, and finalizing the adoption if it's a good match. Each shelter may have slightly different procedures, which will be outlined on their profile page."
    },
    {
        question: "Are all the pets on ShelterPaws up to date on vaccinations?",
        answer: "Most shelters ensure that pets are up to date on vaccinations before listing them for adoption. However, the exact medical history and status can vary. We recommend checking with the specific shelter for detailed information about a pet's medical history and vaccination status."
    },
    {
        question: "Can I adopt if I live in a different state from the pet?",
        answer: "This depends on the individual shelter's policies. Some shelters are open to out-of-state adoptions, while others prefer local adopters. Check the shelter's profile or contact them directly for their specific policies on out-of-state adoptions."
    },
    {
        question: "How can I list my shelter on ShelterPaws?",
        answer: "To list your shelter on ShelterPaws, click on the 'Register Your Shelter' button in the navigation menu. You'll need to provide some basic information about your shelter, and our team will review your application. Once approved, you can start listing pets for adoption."
    },
    {
        question: "Is there a fee for using ShelterPaws?",
        answer: "ShelterPaws is free for potential adopters to use. For shelters, we offer both free and premium plans. The free plan allows basic listings, while premium plans offer additional features to help increase visibility and streamline the adoption process."
    },
    {
        question: "What should I do if I can no longer care for a pet I adopted through ShelterPaws?",
        answer: "If you're unable to care for a pet you've adopted, please contact the shelter you adopted from. Many shelters have policies in place to take back pets they've placed. If you're unable to reach the original shelter, contact us, and we'll assist you in finding a suitable solution."
    },
    {
        question: "How can I volunteer or foster through ShelterPaws?",
        answer: "While ShelterPaws doesn't directly manage volunteer or foster programs, many of our partner shelters are always looking for help. Check the profiles of shelters in your area for information on their volunteer and foster programs, or use our 'Contact' page to ask about opportunities."
    },
    {
        question: "Are the pets on ShelterPaws only dogs and cats?",
        answer: "While dogs and cats make up the majority of pets on ShelterPaws, many of our partner shelters also list other animals such as rabbits, guinea pigs, birds, and sometimes even farm animals. You can use our search filters to look for specific types of pets."
    }
];
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Frequently Asked Questions</h1>

            <Card>
                <template #content>
                    <Accordion value="0">
                        <AccordionPanel v-for="faq in faqs" :key="faq.question" :value="faq.question">
                            <AccordionHeader>{{ faq.question }}</AccordionHeader>
                            <AccordionContent>
                                <p class="m-0">{{ faq.answer }}</p>
                            </AccordionContent>
                        </AccordionPanel>
                    </Accordion>
                </template>
            </Card>
        </div>
    </div>
</template>