<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Link, useForm, router } from '@inertiajs/vue3';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const props = defineProps(['user', 'kids']);

    const form = useForm({
        kid: '',
        type: '',
        amount: 0.00,
        date: todaysDate(),
        note: '',
    });

    const types = [
        { value: 'DEPOSIT', label: 'Deposit' },
        { value: 'WITHDRAWAL', label: 'Withdrawal' },
    ];

    const kids = props.kids?.map(kid => ({ value: kid.id, label: kid.name }));

    function submit() {
        form.post(route('transactions.store'));
    }

    function getKidNameById(kidId) {
        return props.kids.find(kid => kid.id === kidId)?.name;
    }

    function todaysDate() {
        return new Date().toISOString().split('T')[0];
    }
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Create Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Transaction Information
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create a new transaction record.
                            </p>
                        </header>

                        <form
                            @submit.prevent="submit"
                            class="mt-6 space-y-6 lg:w-1/2"
                        >
                            <div>
                                <InputLabel for="kid" value="Kid" />

                                <Dropdown
                                    id="type"
                                    class="mt-1 block w-full"
                                    width="full"
                                    v-model="form.kid"
                                    autocomplete="kid"
                                >
                                    <template #trigger>
                                        <div class="relative">
                                            <button type="button"
                                                    class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    id="options-menu" aria-haspopup="true" aria-expanded="true">
                                                <span v-if="form.kid === ''">Select Kid</span>
                                                <span v-else>{{ getKidNameById(form.kid) }}</span>
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
                                                    role="menuitem" @click="form.kid = kid.value">
                                                {{ kid.label }}
                                            </button>
                                        </div>
                                    </template>
                                </Dropdown>

                                <InputError class="mt-2" :message="form.errors.kid" />
                            </div>

                            <div>
                                <InputLabel for="amount" value="Amount" />

                                <TextInput
                                    id="amount"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.amount"
                                    autocomplete="amount"
                                />

                                <InputError class="mt-2" :message="form.errors.amount" />
                            </div>

                            <div>
                                <InputLabel for="type" value="Type" />

                                <Dropdown
                                    id="type"
                                    class="mt-1 block w-full"
                                    width="full"
                                    v-model="form.type"
                                    autocomplete="type"
                                >
                                    <template #trigger>
                                        <div class="relative">
                                            <button type="button"
                                                    class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    id="options-menu" aria-haspopup="true" aria-expanded="true">
                                                <span v-if="form.type === ''">Select Type</span>
                                                <span v-else>{{ form.type }}</span>
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
                                            <button v-for="type in types" :key="type.value" type="button"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                    role="menuitem" @click="form.type = type.value">
                                                {{ type.label }}
                                            </button>
                                        </div>
                                    </template>
                                </Dropdown>

                                <InputError class="mt-2" :message="form.errors.type" />
                            </div>

                            <div>
                                <InputLabel for="date" value="Date" />

                                <TextInput
                                    id="date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.date"
                                    autocomplete="date"
                                />

                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>

                            <div>
                                <InputLabel for="note" value="Note" />

                                <TextInput
                                    id="note"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.note"
                                    autocomplete="note"
                                />

                                <InputError class="mt-2" :message="form.errors.note" />
                            </div>

                            <div>
                                <PrimaryButton>Create</PrimaryButton>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>