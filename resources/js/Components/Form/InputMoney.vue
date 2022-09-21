<template>
    <input ref="inputRef" :value="formattedValue" />
</template>

<script>
import { watch } from 'vue'
import { useCurrencyInput } from "vue-currency-input";

export default {
    name: "InputMoney",
    props: {
        modelValue: Number,
        options: Object,
    },
    setup(props) {
        const { formattedValue, inputRef, setOptions, setValue } = useCurrencyInput(props.options);

        watch(
            () => props.modelValue, // Vue 2: props.value
            (value) => {
                setValue(value)
            }
        )

        watch(
            () => props.options,
            (options) => {
                setOptions(options)
            }
        )

        return { inputRef, formattedValue };
    },
}
</script>

<style scoped>

</style>
