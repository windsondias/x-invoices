<template>
    <input ref="inputRef" :value="formattedValue" />
</template>

<script>
import useCurrencyInput from "vue-currency-input";

export default {
    name: "InputMoney",
    props: {
        modelValue: Number,
        options: Object,
    },
    setup(props) {
        const { formattedValue, inputRef } = useCurrencyInput(props.options);

        return { inputRef, formattedValue };
    },
}
</script>

<style scoped>

</style>
