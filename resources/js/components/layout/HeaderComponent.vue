<template>
    <nav class="navbar navbar-light bg-danger m-0">
        <div class="container-fluid justify-content-center">
            <h1 class="text-white text-center">{{ appName }}</h1>
        </div>
    </nav>
</template>

<script>
import { defineComponent, ref } from "vue"
export default defineComponent({
    name: "HeaderComponent",
    setup() {
        const appName = ref(process.env.MIX_APP_NAME)

        return {
            appName
        }
    }
})
</script>

<style scoped>

</style>
