<script setup lang="ts">
import { useCurrencyInput } from 'vue-currency-input';
import { watch } from 'vue';

const props = defineProps({
    modelValue: Number,
    label: String,
    prefix: String,
    errorsMessage: String
});

const { inputRef, formattedValue, numberValue, setValue } = useCurrencyInput({
    locale: 'pt-BR',
    currency: 'BRL',
    currencyDisplay: "hidden",
    hideCurrencySymbolOnFocus: false,
    hideGroupingSeparatorOnFocus: false,
    precision: 2,
    valueRange: { min: 0 },
});

watch(
    () => props.modelValue,
    (value) => {
        setValue(value);
    }
);
</script>

<template>
    <v-text-field
        :label="label"
        v-model="formattedValue"
        :error-messages="errorsMessage"
        :prefix="prefix"
        ref="inputRef"
    />
</template>
