<script setup lang="ts">
    import {Recipe} from "~/types/types";

    const props = defineProps<{
        recipe: Recipe
    }>()

    const url = computed(() => `/recipes/${props.recipe.slug}`)
</script>

<template>
    <div class="border rounded-lg p-6 flex flex-col">
        <div>
            <NuxtLink :href="url" class="text-xl font-semibold cursor-pointer hover:underline">
                {{ recipe.name }}
            </NuxtLink>
        </div>
        <div class="mt-0 text-base">
            By: {{ recipe.author_email }}
        </div>
        <div class="my-4">
            {{ recipe.description}}
        </div>
        <div class="mt-auto">
            <NuxtLink
                :href="url"
                class="inline-flex bg-[#ED6226] text-white px-4 py-2 rounded hover:opacity-90"
                tabindex="-1"
            >
                View Recipe
            </NuxtLink>
        </div>
    </div>
</template>
