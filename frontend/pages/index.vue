<script setup lang="ts">
    import {FetchRecipesResponse} from "~/types/types";

    const config = useRuntimeConfig()
    const route = useRoute()
    let responseData = ref<FetchRecipesResponse | null>(null)
    const recipes = computed(() => responseData.value?.data)

    const queryParams = computed(() => {
        return {
            page: route.query.page || 1,
            email: route.query.email || '',
            keyword: route.query.keyword || '',
            ingredient: route.query.ingredient || '',
        }
    })

    async function fetchRecipes(){
        const {data, error} = await useFetch<FetchRecipesResponse>('/recipes', {
            baseURL: config.public.apiBase,
            query: queryParams.value,
        })

        responseData.value = data.value

        if (error.value) {
            console.error(error.value)
        }
    }

    await fetchRecipes()

    watch(queryParams, async () => {
        await fetchRecipes()
        window.scrollTo(0, 0)
    })
</script>

<template>
    <div class="container px-4 mx-auto mt-8 mb-16">
        <div class="bg-gray-100 p-6 rounded-lg mb-12">
            <SearchFilters class="mx-auto"/>
        </div>
        <div v-if="!recipes || !recipes.length">
            No recipes found
        </div>
        <div v-else>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                <RecipeCard v-for="recipe in recipes" :key="recipe.id" :recipe="recipe"/>
            </div>
            <div class="mt-12">
                <AppPagination :response="responseData"/>
            </div>
        </div>
    </div>
</template>
