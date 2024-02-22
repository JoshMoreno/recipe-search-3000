<script setup lang="ts">
    import {PaginatedResponse} from "~/types/types";

    defineProps<{
        response: PaginatedResponse
    }>()

</script>

<template>
    <nav class="flex flex-col sm:flex-row items-center justify-between border-t border-gray-200 bg-white py-3" aria-label="Pagination">
        <div class="block mb-4 mt-4">
            <p class="text-sm text-gray-700">
                Showing
                {{ ' ' }}
                <span class="font-medium">{{response.from}}</span>
                {{ ' ' }}
                to
                {{ ' ' }}
                <span class="font-medium">{{response.to}}</span>
                {{ ' ' }}
                of
                {{ ' ' }}
                <span class="font-medium">{{response.total}}</span>
                {{ ' ' }}
                results
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <NuxtLink v-if="response.prev_page_url" :href="{path: $route.path, query: {...$route.query, page: response.current_page - 1}}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</NuxtLink>
            <NuxtLink v-if="response.next_page_url" :href="{path: $route.path, query: {...$route.query, page: response.current_page + 1}}" class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</NuxtLink>
        </div>
    </nav>
</template>
