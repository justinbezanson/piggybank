<template>
    <Link 
        :href="props.href"
        class="text-blue-400 hover:text-blue-800 underline"
    >
        {{ props.text }}
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'text']);
</script>