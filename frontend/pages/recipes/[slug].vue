<script setup lang="ts">
    import {RecipeDetail} from "~/types/types";

    const config = useRuntimeConfig()
    const route = useRoute()

    const {data: recipe} = await useFetch<RecipeDetail>('/recipes/' + route.params.slug, {
        baseURL: config.public.apiBase
    })
</script>

<template>
    <div class="container mx-auto px-4 max-w-[700px] mt-8 mb-12">
        <h1 class="text-4xl font-bold">{{recipe.name}}</h1>
        <div class="mt-4">By: {{recipe.author_email}}</div>
        <div class="mt-8 bg-emerald-100 p-4 sm:p-6 rounded-lg">
            <div class="font-bold">About This Recipe:</div>
            {{recipe.description}}
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold">Ingredients</h2>
            <ul class="list-disc ml-8 mt-4 leading-loose">
                <li v-for="ingredient in recipe.ingredients" :key="ingredient.id">
                    {{ingredient.quantity}} {{ingredient.unit}} - {{ingredient.name}}
                </li>
            </ul>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold">Steps</h2>
            <ol class="list-decimal ml-8 mt-4 grid gap-4">
                <li v-for="step in recipe.steps" :key="step.id">
                    {{step.description}}
                </li>
            </ol>
        </div>
    </div>
</template>
