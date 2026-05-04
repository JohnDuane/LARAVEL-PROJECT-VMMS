<template>
    <form @submit.prevent="submitForm">
        <input type="number" v-model="quantity" @input="validateStock" />
        <span v-if="quantityError" class="error-message">{{ quantityError }}</span>
        <button type="submit" :disabled="isAddDisabled">Add</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            quantity: 0,
            stock: 100, // Example stock value
            quantityError: '',
            isAddDisabled: false,
        };
    },
    methods: {
        validateStock() {
            if (this.quantity > this.stock) {
                this.quantityError = 'Quantity exceeds available stock!';
                this.isAddDisabled = true;
            } else {
                this.quantityError = '';
                this.isAddDisabled = false;
            }
        },
        submitForm() {
            // Form submission logic here
        }
    }
};
</script>