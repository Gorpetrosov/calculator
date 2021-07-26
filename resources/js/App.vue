<template>
    <header-component />
    <calculator />
</template>
<script>
import {defineComponent, ref} from "vue"
import HeaderComponent from "./components/layout/HeaderComponent.vue";
import Calculator from "./views/Calculator.vue";
export default defineComponent({
    name: "App",
    components: {
        Calculator,
        HeaderComponent
    },
    setup() {
        const test = ref('safe');
        return {
            test
        }
    }
})
</script>

<style scoped>

</style>
