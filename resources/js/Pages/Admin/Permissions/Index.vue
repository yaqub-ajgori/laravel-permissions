<script setup>
import AdminLayout from '@/Layouts/AdminLayout .vue';
import { Head, Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';

defineProps ({
    permissions: {
        type: Array,
        required: true
    }
})

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto p-2 m-2">
            <div class="flex justify-between p-2 m-2">
                <h2>All Users Permissions</h2>
                <Link class="bg-indigo-700 text-white px-3 py-1 rounded-md" :href="route('permissions.create')">Create Permissions</Link>
            </div>
            <div class="mt-6">
                <Table>
                <template #header>
                    <TableRow>
                        <TableHeaderCell>Id</TableHeaderCell>
                        <TableHeaderCell>Name</TableHeaderCell>
                    </TableRow>
                </template>
                <template #default>
                    <TableRow v-for="permission in permissions" :key="permission.id" class="border border-b-2">
                        <TableDataCell>{{ permission.id }}</TableDataCell>
                        <TableDataCell>{{ permission.name }}</TableDataCell>
                        <TableDataCell class="flex space-x-4">
                            <Link class="bg-indigo-700 text-white px-3 py-1 rounded-md" :href="route('permissions.edit', permission.id)">Edit</Link>
                            <Link
                            method="DELETE"
                            as="button"
                            class="bg-red-700 text-white px-3 py-1 rounded-md" :href="route('permissions.destroy', permission.id)">Delete</Link>
                        </TableDataCell>
                    </TableRow>
                </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
