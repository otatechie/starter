<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import Default from '../../Layouts/Default.vue';
import PageHeader from '@/Components/PageHeader.vue';

defineOptions({
    layout: Default,
});

const props = defineProps({
    backupInfo: {
        type: Array,
        required: true,
        default: () => [],
    },
});

const isBackupRunning = ref(false);
const form = useForm({});

const runBackup = () => {
    if (isBackupRunning.value) return;
    isBackupRunning.value = true;
    form.post(route('backup.run'), {
        preserveScroll: true,
        onError: () => isBackupRunning.value = false,
        onFinish: () => isBackupRunning.value = false,
    });
};

const downloadBackup = (fileName) => {
    if (!fileName) return;
    const encodedPath = encodeURIComponent(fileName.trim());
    window.open(route('backup.download', { path: encodedPath }));
};

const deleteBackup = (path) => {
    if (!path) return;
    if (confirm('This backup will be permanently deleted. Are you sure you want to continue?')) {
        form.delete(route('backup.delete', { path: path.trim() }), {
            preserveScroll: true,
        });
    }
};

const getStats = (info) => [
    {
        type: 'disk',
        title: 'Disk',
        value: info.disk
    },
    {
        type: 'storage',
        title: 'Storage Type',
        value: info.storageType
    },
    {
        type: 'space',
        title: 'Used Space',
        value: info.storageSpace
    },
    {
        type: 'status',
        title: 'Status',
        value: info.healthy ? 'Normal' : 'Attention Required'
    }
]
</script>

<template>
    <Head title="Backups" />

    <main class="max-w-5xl mx-auto">
        <section class="container-border overflow-hidden">
            <PageHeader
                title="Backups"
                description="Manage system backups and restore points"
                :breadcrumbs="[
                    { label: 'Dashboard', href: '/' },
                    { label: 'Backups' }
                ]"
            >
                <template #actions>
                    <button @click="runBackup"
                        class="btn-primary"
                        :disabled="isBackupRunning">
                        {{ isBackupRunning ? 'Creating backup...' : 'Create backup' }}
                    </button>
                </template>
            </PageHeader>

            <div class="p-6 space-y-6 dark:bg-gray-900">
                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-lg p-4">
                    <p class="text-sm text-amber-700 dark:text-amber-400 font-medium flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        If backup fails through the interface, try running <code class="bg-amber-100 dark:bg-amber-900/50 px-1.5 py-0.5 rounded">php artisan backup:run</code> in console
                    </p>
                </div>

                <div v-for="info in backupInfo" :key="info.name" class="space-y-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <article v-for="(stat, index) in getStats(info)" :key="index"
                            class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                            <div class="flex items-center gap-3 mb-1">
                                <svg v-if="stat.type === 'disk'" class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                <svg v-else-if="stat.type === 'storage'" class="w-5 h-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                </svg>
                                <svg v-else-if="stat.type === 'space'" class="w-5 h-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                                <svg v-else-if="stat.type === 'status' && info.healthy" class="w-5 h-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg v-else-if="stat.type === 'status'" class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h2 class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ stat.title }}</h2>
                            </div>
                            <p :class="[
                                stat.type === 'status' ?
                                    (info.healthy ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400') :
                                    'text-gray-700 dark:text-gray-200',
                                'text-xl font-medium capitalize'
                            ]">
                                {{ stat.value }}
                            </p>
                        </article>
                    </div>

                    <div v-if="info.backups?.length > 0" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700 md:table hidden">
                                <thead class="bg-gray-50 dark:bg-gray-800/50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Size</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">File Name</th>
                                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="backup in info.backups" :key="backup.path" class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ backup.date }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ backup.size }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 font-mono truncate max-w-[200px]">{{ backup.path }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-right space-x-1">
                                            <button type="button" @click="downloadBackup(backup.path)"
                                                class="inline-flex items-center p-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/50 transition-colors cursor-pointer"
                                                title="Download backup" :disabled="!backup.path">
                                                <span class="sr-only">Download backup</span>
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </button>
                                            <button type="button" @click="deleteBackup(backup.path)"
                                                class="inline-flex items-center p-2 text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900/50 transition-colors cursor-pointer"
                                                title="Delete backup" :disabled="!backup.path">
                                                <span class="sr-only">Delete backup</span>
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                            <div v-for="backup in info.backups" :key="backup.path"
                                class="p-4 space-y-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ backup.date }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ backup.size }}</p>
                                    </div>
                                    <div class="flex space-x-1">
                                        <button @click="downloadBackup(backup.path)" class="p-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/50 transition-colors" title="Download backup">
                                            <i class="pi pi-download text-lg"></i>
                                        </button>
                                        <button @click="deleteBackup(backup.path)" class="p-2 text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900/50 transition-colors" title="Delete backup">
                                            <i class="pi pi-trash text-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-mono truncate">{{ backup.path }}</p>
                            </div>
                        </div>
                    </div>

                    <div v-else class="text-center p-8 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                        <p class="text-gray-600 dark:text-gray-400">No backups found in this storage location</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
