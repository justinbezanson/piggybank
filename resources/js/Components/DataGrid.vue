<template>
    <div class="datagrid grid lg:grid-cols-2 sm:grid-cols-1 gap-4">
        <div>
            <!--TODO: results per page-->
        </div>

        <div class="text-right mb-6">
            <img 
                v-show="isSearching" 
                src="../../images/3-dots-move.svg" 
                title="Loading..." 
                alt="Loading..." 
                class="inline" 
            />
            
            <span class="pr-2">Search:</span>

            <TextInput
                id="search"
                v-model="search"
                type="text"
            />
        </div>
    </div>

    <table class="w-full">
        <thead>
            <tr class="border-b  border-gray-600">
                <th v-for="column in props.columns">{{ column.header }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="props.data.data.length === 0">
                <td class="py-2" colspan="100%">
                    <div class="text-center">
                        No results found.
                    </div>
                </td>
            </tr>
            <tr 
                v-else
                v-for="(row, index) in props.data.data"
                :key="row[props.keyColumn]"
                class="border-t border-gray-300 hover:bg-gray-100"
                :class="index%2==0 ? 'bg-gray-50': ''"
            >
                <td class="py-2" v-for="column in props.columns">
                    <div v-if="column.hasOwnProperty('buttons')" class="flex space-x-2 justify-end">
                        <div v-for="button in column.buttons">
                            <div v-if="button.method === 'POST'">
                                <PrimaryButton type="button" @click="button.handler($event, row)">
                                    {{ button.text }}
                                </PrimaryButton>
                            </div>
                            <div v-else>
                            <LinkButton :href="columnLink(row, button)">
                                {{ button.text }}
                            </LinkButton>
                            </div>
                        </div>
                    </div>
                    <span v-else> {{ row[column.column] }}</span>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="border-t  border-gray-600" v-if="props.data.data.length > 0">
                <th v-for="column in props.columns">{{ column.header }}</th>
            </tr>
        </tfoot>
    </table>

    <div v-if="props.data.data.length > 0" class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 mt-4">
        <div class="flex items-center text-gray-500 text-sm">
            Showing {{ props.data.from }} to {{ props.data.to }} of {{ props.data.total }}
        </div>

        <div class="text-right">
            <Pagination class="float-right" :links="props.data.links" />
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import TextLink from '@/Components/TextLink.vue';
import FormSection from '@/Components/FormSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import LinkButton from '@/Components/LinkButton.vue';

const props = defineProps(['data', 'columns', 'keyColumn', 'searchRoute', 'currentSearch']);

const search = ref(props.currentSearch);

const searchForm = useForm({
    search: ''
});

let isSearching = ref(false);

let timeout = null;

watch(search, async (newSearch, oldSearch) => {
    if(newSearch === oldSearch) {
        return;
    }

    searchForm.search = search;

    if (typeof timeout === "number") {
        clearTimeout(timeout);
    }

    timeout = setTimeout(datagridSearch, 1000);
});

const columnLink = (row, button) => {
    if(!button.hasOwnProperty('route') || button.route.length < 1) {
        return '';
    }

    let href = button.route[0];
    if(button.route.length > 1) {
        for(let i=0; i<button.route[1].length; i++) {
            href = href.replace('%'+(i+1), row[button.route[1][i]]);
        }
    }

    return href;
};

const datagridSearch = async () => {
    isSearching.value = true;

    try {
        searchForm.get(route(props.searchRoute), {
            onFinish: () => { isSearching.value = false; }
        });
    } catch (error) {
      //throw error
    } finally {
      clearTimeout(timeout);
    }
};

onMounted(() => {
    document.getElementById('search').focus();
});
</script>