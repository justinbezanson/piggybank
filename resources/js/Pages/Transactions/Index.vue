<template>
    <Head title="Transactions" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Transactions
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <div v-if="props.successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            {{ props.successMessage }}
                        </div>

                        <p>
                            <LinkButton :href="route('transactions.create')" style="float: left;">
                                Add Transaction
                            </LinkButton>

                            <div class="w-48 ml-2" style="float: left; position: relative; top: -6px;">
                            <Dropdown
                                id="interval"
                                class="mt-1 block w-full"
                                width="full"
                                v-model="filterForm.kid"
                                autocomplete="interval"
                            >
                                <template #trigger>
                                    <div class="relative">
                                        <button type="button"
                                                class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="options-menu" aria-haspopup="true" aria-expanded="true">
                                            <span v-if="filterForm.kid === ''">Select Kid To Filter</span>
                                            <span v-else>{{ filterForm.kid }}</span>
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M5 8a1 1 0 011.707 0L10 11.293l3.293-3.294a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4A1 1 0 015 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template #content>
                                    <div class="py-1 w-full" role="none">
                                        <button v-for="kid in kids" :key="kid.value" type="button"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                role="menuitem" @click="filterForm.kid = kid.value">
                                            {{ kid.label }}
                                        </button>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                        </p>
                        <br style="clear: both;" />

                        <DataGrid 
                            :data="transactionData" 
                            :columns="columns"
                            keyColumn="id"
                            searchRoute="transactions.index"
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
import { Head, useForm } from '@inertiajs/vue3';
import DataGrid from '@/Components/DataGrid.vue';
import LinkButton from '@/Components/LinkButton.vue';
import { onMounted } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';

const props = defineProps(['transactions', 'user', 'kid', 'kids', 'search', 'successMessage']);

const kids = props.kids?.map(kid => ({ value: kid.id, label: kid.name }));
const transactionData = props.transactions.hasOwnProperty('data') ? props.transactions : {data:[]};

const deleteForm = useForm({

});

const filterForm = useForm({
    'kid': ''
});


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
                route: ['/transactions/%1', ['id']]
            },
            {
                text: 'Delete',
                method: 'POST',
                handler: (event, row) => {
                    event.preventDefault();
                    if(confirm('Are you sure you want to delete this kid?')) {
                        //deleteForm.delete(`/kids/${row.id}`);
                    }
                }
            }
        ]
    }
];
</script>