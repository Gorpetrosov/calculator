<template>
  <div class="m-3">
      <input @input="emitEnterValue($event)" type="number" title="Enter number" class="form-control">
  </div>
</template>

<script>

import {defineComponent} from "vue"

export default defineComponent({
    name: "AppInputNumber",
    setup(props, {emit}) {
        function emitEnterValue(e){
           emit('inputValue',e.target.value)
        }
        return {
            emitEnterValue
        }
    }
})
</script>

<style scoped>

</style>
