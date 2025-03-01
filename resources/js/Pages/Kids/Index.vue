<template>
    <Head title="Kids" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Kids
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p>
                            <LinkButton href="/kids/create">
                                Add Kid
                            </LinkButton>
                        </p>
                        <DataGrid 
                            :data="props.kids" 
                            :columns="columns"
                            keyColumn="id"
                            searchRoute="kids.index"
                            currentSearch=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DataGrid from '@/Components/DataGrid.vue';
import LinkButton from '@/Components/LinkButton.vue';

const props = defineProps(['kids']);

const columns = [
    {
        header: 'Name',
        column: 'name',
    },
    {
        header: 'Amount',
        column: 'amount',
    },
    {
        header: 'Interval',
        column: 'interval',
    },
    {
        header: 'Actions',
        buttons: [
            {
                text: 'Edit',
                route: ['kids.edit', 'id'],
                handler: (event, row) => {
                    event.preventDefault();
                    console.log(row);
                }
            },
            {
                text: 'Delete',
                method: 'POST',
                handler: (event, row) => {
                    event.preventDefault();
                    console.log(row);
                }
            }
        ]
    }
];
</script>