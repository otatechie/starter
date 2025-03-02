<script setup>
import { Head, router, Link } from '@inertiajs/vue3'
import DataTable from '@/Components/Datatable.vue'
import Default from '@/Layouts/Default.vue'
import { createColumnHelper } from '@tanstack/vue-table'
import { h, ref, watch } from 'vue'
import PageHeader from '@/Components/PageHeader.vue'

defineOptions({
    layout: Default
})

const props = defineProps({
    users: {
        type: Object,
        required: true
    }
})

const columnHelper = createColumnHelper()
const loading = ref(false)
const pagination = ref({
    current_page: props.users.current_page,
    per_page: Number(props.users.per_page),
    total: props.users.total
})

const columns = [
    columnHelper.accessor('name', {
        header: 'Name',
        cell: info => h('span', {
            'aria-label': `User name: ${info.getValue()}`
        }, info.getValue()),
        meta: {
            ariaLabel: 'User name'
        }
    }),
    columnHelper.accessor('email', {
        header: 'Email',
        cell: info => h('span', {
            'aria-label': `Email address: ${info.getValue()}`
        }, info.getValue()),
        meta: {
            ariaLabel: 'User email address'
        }
    }),
    columnHelper.accessor('created_at', {
        header: 'Created At',
        cell: info => h('span', {
            'aria-label': `Account created on: ${new Date(info.getValue()).toLocaleString()}`
        }, new Date(info.getValue()).toLocaleString()),
        meta: {
            ariaLabel: 'Account creation date'
        }
    }),
    columnHelper.accessor('status', {
        header: 'Status',
        cell: info => {
            const status = info.getValue()
            const formattedStatus = status?.charAt(0).toUpperCase() + status?.slice(1) || 'N/A'
            const badgeClass = {
                active: 'bg-green-50 text-green-700 border border-green-100 dark:bg-green-950 dark:text-green-400 dark:border-green-900',
                inactive: 'bg-red-50 text-red-700 border border-red-100 dark:bg-red-950 dark:text-red-400 dark:border-red-900',
                pending: 'bg-yellow-50 text-yellow-700 border border-yellow-100 dark:bg-yellow-950 dark:text-yellow-400 dark:border-yellow-900'
            }[status?.toLowerCase()] || 'bg-gray-50 text-gray-700 border border-gray-100'

            return h('span', {
                class: `px-2 py-1 rounded-full text-xs font-medium ${badgeClass}`,
                role: 'status',
                'aria-label': `Account status: ${formattedStatus}`
            }, formattedStatus)
        },
        meta: {
            ariaLabel: 'User account status'
        }
    }),
    columnHelper.display({
        id: 'actions',
        header: 'Actions',
        cell: (info) => h('div', { class: 'flex items-center gap-2 justify-end' }, [
            h('button', {
                class: 'p-2 text-gray-400 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50',
                onClick: () => handleEdit(info.row.original),
                title: 'Edit user'
            }, [
                h('span', { class: 'sr-only' }, 'Edit user'),
                h('svg', {
                    class: 'w-4 h-4 cursor-pointer',
                    fill: 'none',
                    stroke: 'currentColor',
                    viewBox: '0 0 24 24'
                }, [
                    h('path', {
                        'stroke-linecap': 'round',
                        'stroke-linejoin': 'round',
                        'stroke-width': '2',
                        d: 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'
                    })
                ])
            ]),
            h('button', {
                class: 'p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50',
                onClick: () => handleDelete(info.row.original),
                title: 'Delete user'
            }, [
                h('span', { class: 'sr-only' }, 'Delete user'),
                h('svg', {
                    class: 'w-4 h-4 cursor-pointer',
                    fill: 'none',
                    stroke: 'currentColor',
                    viewBox: '0 0 24 24'
                }, [
                    h('path', {
                        'stroke-linecap': 'round',
                        'stroke-linejoin': 'round',
                        'stroke-width': '2',
                        d: 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'
                    })
                ])
            ])
        ])
    })
]

const handleEdit = (user) => {
    router.visit(route('admin.user.edit', { id: user.id }))
}

const handleDelete = (user) => {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(route('admin.user.destroy', { id: user.id }))
    }
}

watch(pagination, newPagination => {
    loading.value = true
    router.get(
        route('admin.user.index'),
        {
            page: newPagination.current_page,
            per_page: Number(newPagination.per_page)
        },
        {
            preserveState: true,
            preserveScroll: true,
            onFinish: () => loading.value = false
        }
    )
}, { deep: true })
</script>

<template>
    <Head title="Users" />

    <main class="max-w-5xl mx-auto">
        <section class="container-border overflow-hidden">
            <PageHeader
                title="Users"
                description="Manage system users and their access"
                :breadcrumbs="[
                    { label: 'Dashboard', href: '/' },
                    { label: 'Settings', href: route('admin.setting.index') },
                    { label: 'Users' }
                ]"
            />

            <div class="p-6 dark:bg-gray-900">
                <DataTable
                    :data="users.data"
                    :columns="columns"
                    :loading="loading"
                    :pagination="pagination"
                    :search-fields="['name', 'email', 'created_at']"
                    empty-message="No users found"
                    empty-description="Users will appear here once created"
                    export-file-name="users"
                    @update:pagination="pagination = $event"
                />
            </div>
        </section>
    </main>
</template>
