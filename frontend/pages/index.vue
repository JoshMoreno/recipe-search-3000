<script setup lang="ts">
    import {FetchRecipesResponse} from "~/types/types";

    const config = useRuntimeConfig()
    const route = useRoute()
    const page = computed(() => route.query.page || 1)
    let responseData = ref<FetchRecipesResponse | null>(null)
    const recipes = computed(() => responseData.value?.data)


    async function fetchRecipes(){
        const {data, error} = await useFetch<FetchRecipesResponse>('/recipes', {
            baseURL: config.public.apiBase,
            query: {
                page: page.value
            }
        })

        responseData.value = data.value

        if (error.value) {
            console.error(error.value)
        }
    }

    await fetchRecipes()

    watch(page, async () => {
        await fetchRecipes()
        window.scrollTo(0, 0)

    })
</script>

<template>
    <div class="container px-4 mx-auto mt-8 mb-16">
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
