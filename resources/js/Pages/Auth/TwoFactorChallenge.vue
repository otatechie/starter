<script setup>
import { Head } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import Auth from '../../Layouts/Auth.vue'
import FormInput from '../../Components/FormInput.vue'

defineOptions({
    layout: Auth
})

const codeForm = useForm({
    code: ''
})

const recoveryCodeForm = useForm({
    recovery_code: ''
})

const submitCode = () => {
    codeForm.post('/two-factor-challenge', {
        preserveScroll: true,
        onSuccess: () => {
            codeForm.reset()
        }
    })
}

const submitRecovery = () => {
    recoveryCodeForm.post('/two-factor-challenge', {
        preserveScroll: true,
        onSuccess: () => {
            recoveryCodeForm.reset()
        }
    })
}
</script>

<template>

    <Head title="Two-factor challenge" />

    <div class="max-w-[384px] mx-auto px-8">
        <h2 class="main-heading text-center">
            Two-factor authentication
        </h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm text-center font-medium mt-2">
            Please verify your identity to continue
        </p>

        <div class="mt-6 p-6 container-border dark:border-gray-700 rounded-xl dark:bg-gray-800">
            <div class="space-y-6">
                <div class="space-y-4">
                    <div class="flex justify-center">
                        <div class="bg-blue-50 dark:bg-blue-950 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-blue-600 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="font-medium text-gray-900 dark:text-white">Authentication code</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">Enter the code from your authenticator app</p>
                    </div>

                    <form @submit.prevent="submitCode" class="space-y-4">
                        <FormInput v-model="codeForm.code" label="Code" id="code" type="password" required
                            :disabled="codeForm.processing" :error="codeForm.errors.code" class="text-center"
                            maxlength="6" />

                        <button @click="submitCode" :disabled="codeForm.processing"
                            class="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed h-10 rounded-lg">
                            {{ codeForm.processing ? 'Verifying...' : 'Verify code' }}
                        </button>
                    </form>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 "></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-4 text-gray-500 dark:text-gray-400 text-xs">or use recovery code</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-center">
                        <div class="bg-blue-50 dark:bg-blue-950 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-blue-600 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                            </svg>
                        </div>
                    </div>

                    <form @submit.prevent="submitRecovery" class="space-y-4">
                        <FormInput v-model="recoveryCodeForm.recovery_code" label="Recovery code" id="recovery_code"
                            type="password" required :disabled="recoveryCodeForm.processing"
                            :error="recoveryCodeForm.errors.recovery_code" />

                        <button @click="submitRecovery" :disabled="recoveryCodeForm.processing"
                            class="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed h-10">
                            {{ recoveryCodeForm.processing ? 'Verifying...' : 'Use recovery code' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
            Having trouble?
            <a href="#" class="link">Contact support</a>
        </p>
    </div>
</template>
