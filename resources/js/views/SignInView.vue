<script setup>
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';
import Message from 'primevue/message';
</script>

<template>
    <div class="w-full h-full flex items-center justify-center">
        <Card class="w-[400px]">
            <template #title>
                <h1 class="text-3xl">Sign In</h1>
            </template>

            <template #content>
                <Message class="mt-2" severity="success">fdsf</Message>
                
                <form>
                    <div class="flex flex-col gap-1 mt-3">
                        <label for="email">Email</label>
                        <InputText type="email"/>
                        <small class="form-error-message"></small>
                    </div>

                    <div class="flex flex-col gap-1 mt-3">
                        <label for="password">Password</label>
                        <Password toggleMask fluid />
                        <small class="form-error-message"></small>
                    </div>

                    <!-- <div class="flex justify-end">
                        <Button label="Forgot Password?" link />
                    </div> -->

                    <Button type="submit" label="Signin" class="mt-5" fluid />
                </form>

                <Button label="Don't have an account? Sign Up" link fluid as="router-link" :to="{ name: 'signup' }" />
            </template>
        </Card>
    </div>
</template>