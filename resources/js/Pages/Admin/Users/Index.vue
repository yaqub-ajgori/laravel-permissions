<script setup>
import AdminLayout from '@/Layouts/AdminLayout .vue';
import { Head, Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';

defineProps ({
    users: {
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
                <h2>All Users Roles</h2>
                <Link class="bg-indigo-700 text-white px-3 py-1 rounded-md" :href="route('users.create')">Create User</Link>
            </div>
            <div class="mt-6">
                <Table>
                <template #header>
                    <TableRow>
                        <TableHeaderCell>Id</TableHeaderCell>
                        <TableHeaderCell>Name</TableHeaderCell>
                        <TableHeaderCell>Email</TableHeaderCell>
                        <TableHeaderCell>Action</TableHeaderCell>
                    </TableRow>
                </template>
                <template #default>
                    <TableRow v-for="user in users" :key="user.id" class="border border-b-2">
                        <TableDataCell>{{ user.id }}</TableDataCell>
                        <TableDataCell>{{ user.name }}</TableDataCell>
                        <TableDataCell>{{ user.email }}</TableDataCell>
                        <TableDataCell class="flex space-x-4">
                            <Link class="bg-indigo-700 text-white px-3 py-1 rounded-md" :href="route('users.edit', user.id)">Edit</Link>
                            <Link
                            class="bg-red-700 text-white px-3 py-1 rounded-md"
                            method="DELETE"
                            as="button"
                            :href="route('users.destroy', user.id)">Delete</Link>
                        </TableDataCell>
                    </TableRow>
                </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
