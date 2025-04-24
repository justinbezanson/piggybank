<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Link, useForm, router } from '@inertiajs/vue3';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    // const props = defineProps(['user', 'kid']);

    // const form = useForm({
    //     name: props.kid.name || '',
    //     amount: props.kid.amount.toFixed(2) || '0.00',
    //     interval: props.kid.interval || '',
    // });

    // const intervals = [
    //     { value: '', label: 'None' },
    //     { value: 'weekly', label: 'Weekly' },
    //     { value: 'monthly', label: 'Monthly' },
    // ];

    // function submit() {
    //     form.put(route('kids.update', props.kid.id));
    // }
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Edit Transaction
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
                                Edit a transaction record.
                            </p>
                        </header>

                        
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>