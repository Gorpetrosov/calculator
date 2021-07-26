<template>
    <div class="row justify-content-center m-0 mt-3 mt-md-5">
        <div class="col-11 col-md-4">
            <div class="card">
                <div class="row p-2 justify-content-center">
                    <div class="col-12 col-md-8">
                    <div class="col-12">
                        <h4 class="text-center text-ccc p-2">
                            Enter the numbers
                        </h4>
                    </div>
                    <form @submit="calculateSum($event)">
                    <div class="col-12">
                        <app-input-number @inputValue="getFirstInputValue"></app-input-number>
                        <p v-if="invalidNumberFirst" class="text-center text-danger">Please Enter Valid Number</p>
                    </div>
                    <div class="col-12">
                        <app-input-number @inputValue="getSecondInputValue"></app-input-number>
                        <p v-if="invalidNumberSecond" class="text-center text-danger">Please Enter Valid Number</p>
                    </div>
                    <div class="col-12">
                        <div class="m-3">
                        <button type="submit" class="btn btn-danger w-100 text-white text-center">SUM</button>
                        </div>
                    </div>
                    </form>
                    </div>
                    <div class="col-12">
                        <div class="m-3">
                        <hr class="hr-line">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                    <div class="col-12 mt-3">
                        <h4 class="text-center text-ccc p-2">
                            Result
                        </h4>
                    </div>
                    <div class="col-12">
                        <div class="m-3">
                        <button class="btn w-100 btn-outline-danger disabled">
                            <app-loader v-if="showLoader" />
                            {{showLoader ? null : result }}
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent, ref} from "vue"
import AppInputNumber from "../components/base/AppInputNumber.vue";
import AppLoader from "../components/base/AppLoader";

export default defineComponent({
    name: "Calculator",
    components: {AppLoader, AppInputNumber},
    setup() {
        const firstInput = ref(0);
        const secondInput = ref(0);
        const showLoader = ref(false);
        const invalidNumberFirst = ref(false);
        const invalidNumberSecond = ref(false);
        const validRegExpNumber = /^[1-9]/;
        const result = ref(0);
        function getFirstInputValue(val){
            if(validRegExpNumber.test(val)){
                firstInput.value = val;
                invalidNumberFirst.value = false;
            }else{
                invalidNumberFirst.value = true;
            }
        }
        function getSecondInputValue(val){
            if(validRegExpNumber.test(val)){
                secondInput.value = val;
                invalidNumberSecond.value = false;
            }else{
                invalidNumberSecond.value = true;
            }
        }
        function calculateSum(e){
            e.preventDefault()
            if(!invalidNumberSecond.value && !invalidNumberFirst.value && firstInput.value && secondInput.value){
                showLoader.value = true;
               window.axios.post('api/calculate/sum', {
                   firstNumber : Number(firstInput.value),
                   secondNumber : Number(secondInput.value),
               }).then(res => {
                   const {data}  = res;
                   if(data){
                       result.value = data.result
                   }
               }).catch(e => {
                   console.log(e.response.data.errors)
                   for(const key in e.response.data.errors) {
                       if(key === 'firstNumber'){
                           invalidNumberFirst.value = true;
                       }
                       if(key === 'secondNumber'){
                           invalidNumberSecond.value = true;
                       }
                   }
               }).finally(()=> {
                   showLoader.value = false
               })
            }else{
                invalidNumberSecond.value = invalidNumberFirst.value = true
            }
        }
        return {
            getFirstInputValue,
            getSecondInputValue,
            calculateSum,
            invalidNumberFirst,
            invalidNumberSecond,
            result,
            showLoader
        }
    }
})
</script>

<style scoped>
.hr-line {
    color: red;
    opacity: 1;
}
</style>
