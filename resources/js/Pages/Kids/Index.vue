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
                            :currentSearch="search"
                            showColumnsInFooter="false"
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

const props = defineProps(['kids', 'search']);

const columns = [
    {
        header: 'Name',
        column: 'name',
        class: 'text-left',
    },
    {
        header: 'Amount',
        column: 'amount',
        class: 'text-left',
    },
    {
        header: 'Interval',
        column: 'interval',
        class: 'text-left',
    },
    {
        header: '',
        class: 'text-left',
        buttons: [
            {
                text: 'Edit',
                route: ['/kids/%1', ['id']]
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