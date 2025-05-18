<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, EyeOffIcon, EyeIcon} from 'lucide-vue-next';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    usernick: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const passwordVisible = ref(false);

const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
};

const passwordVisibleRepeat = ref(false);

const togglePasswordVisibilityRepeat = () => {
    passwordVisibleRepeat.value = !passwordVisibleRepeat.value;
};



</script>

<template>
    <AuthBase title="Crea una cuenta" description="Ingrese sus datos a continuación para crear su cuenta">
        <Head title="Registrate" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Nombre</Label>
                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Nombre completo" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>
                <div class="grid gap-2">
                    <Label for="usernick">User Nick</Label>
                    <Input id="usernick" type="text" required :tabindex="2" autocomplete="email" v-model="form.usernick" placeholder="user nick" />
                    <InputError :message="form.errors.usernick" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Contraseña</Label>
                    <div class="relative flex items-center">
                        <Input
                            id="password"
                            :type="passwordVisible ? 'text' : 'password'"
                            required
                            :tabindex="3"
                            autocomplete="new-password"
                            v-model="form.password"
                            placeholder="Password"
                        />
                        <button
                            type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 transform"
                            @click="togglePasswordVisibility"
                            :tabindex="3"
                        >
                            <EyeIcon v-if="!passwordVisible" class="h-5 w-5 text-gray-500" />
                            <EyeOffIcon v-else class="h-5 w-5 text-gray-500" />
                        </button>
                    </div>

                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password</Label>
                    <div class="relative flex items-center">
                        <Input
                            id="password_confirmation"
                            :type="passwordVisibleRepeat ? 'text' : 'password'"
                            required
                            :tabindex="4"
                            autocomplete="new-password"
                            v-model="form.password_confirmation"
                            placeholder="Confirm password"
                        />
                        <button
                            type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 transform"
                            @click="togglePasswordVisibilityRepeat"
                            :tabindex="3"
                        >
                            <EyeIcon v-if="!passwordVisibleRepeat" class="h-5 w-5 text-gray-500" />
                            <EyeOffIcon v-else class="h-5 w-5 text-gray-500" />
                        </button>
                    </div>

                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Crea tu cuenta
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                ¿Ya tienes una cuenta?
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Inicia session</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
