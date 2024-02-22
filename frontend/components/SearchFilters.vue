<script setup lang="ts">
    const router = useRouter()
    const route = useRoute()

    const form = ref({
        email: route.query.email || '',
        keyword: route.query.keyword || '',
        ingredient: route.query.ingredient || '',
    })

    function handleSubmit() {
        router.push({
            path: '/',
            query: {
                email: form.value.email,
                keyword: form.value.keyword,
                ingredient: form.value.ingredient,
            }
        })
    }
</script>

<template>
    <form @submit.prevent="handleSubmit" class="max-w-[500px] grid gap-4">
        <InputText v-model="form.email" label="Email" id="email"/>
        <InputText v-model="form.keyword" label="Keyword" id="keyword"/>
        <InputText v-model="form.ingredient" label="Ingredient" id="ingredient"/>

        <div class="mt-4">
            <button class="inline-flex bg-[#ED6226] text-white px-4 py-2 rounded hover:opacity-90">
                Search
            </button>
        </div>
    </form>

</template>
