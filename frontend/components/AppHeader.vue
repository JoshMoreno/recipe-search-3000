<script setup lang="ts">
    const router = useRouter()
    const route = useRoute()

    const showBackButton = computed(() => route.name === 'recipes-slug')

    function goBack() {
        router.back()
    }
</script>

<template>
    <header class="container px-4 mx-auto border-b py-4 flex items-center justify-between">
        <NuxtLink href="/" class="text-2xl font-bold hover:underline">Recipe Search 3000</NuxtLink>
        <button v-if="showBackButton" type="button" @click="goBack"  class="flex items-center gap-2 font-bold ml-auto hover:underline group">
            <svg class="w-6 h-6 transition group-hover:-translate-x-2"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
            </svg>
            Back
        </button>
    </header>
</template>
