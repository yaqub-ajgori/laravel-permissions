<script setup>
import AdminLayout from '@/Layouts/AdminLayout .vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import VueMultiselect from 'vue-multiselect'
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';


const props = defineProps({
    role: Object,
    permissions: Object,
});

const form = useForm({
    name: props.role.name,
    permissions: [],
});

const submit = () => {
    form.put(route('roles.update', props.role.id));
};

props.role.permissions.forEach((rolePermission) => {
    props.permissions.forEach((permission) => {
        if (rolePermission.id === permission.id) {
            form.permissions.push(permission);
        }
    });
});

</script>

<template>
    <Head title="Create Role" />
    <AdminLayout>
        <div class="max-w-6xl mx-auto bg-slate-100 py-8 px-4">
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-6">
                    <InputLabel for="permissions" value="Permissions" />
                    <VueMultiselect
                        v-model="form.permissions"
                        :options="permissions"
                        :multiple="true"
                        :close-on-select="true"
                        placeholder="Pick some"
                        label="name"
                        track-by="id"
                    />
                </div>
                <div class="flex items-center mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </PrimaryButton>
                </div>
                <div class="mt-6">
                    <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>Id</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Actions</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow v-for="rolePermission in role.permissions" :key="rolePermission.id" class="border border-b-2">
                            <TableDataCell>{{ rolePermission.id }}</TableDataCell>
                            <TableDataCell>{{ rolePermission.name }}</TableDataCell>
                            <TableDataCell class="flex space-x-4">
                                <Link
                                method="DELETE"
                                as="button"
                                class="bg-red-700 text-white px-3 py-1 rounded-md" :href="route('permissions.destroy', rolePermission.id)">Revote</Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                    </Table>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
