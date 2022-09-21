<template>
    <Main>
        <Head title="Invoices Create"/>
        <form @submit.prevent="form.post($route('invoices.store'))">
            <div class="row invoice-box shadow-lg p-3 rounded">
                <div class="col-md-4 mb-3">
                    <h3>Create new invoice</h3>
                </div>
                <div class="col-md-8 text-end mb-3">
                    <button v-show="lastInvoice !== null" type="button" class="btn btn-outline-info" @click="fillFields">
                        Fill in the fields with data from the last invoice
                    </button>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input v-model="form.invoice_number" type="text" placeholder="Invoice Number"
                               class="form-control" :class="form.errors.invoice_number ? 'is-invalid': ''"
                               id="invoice_number">
                        <label for="invoice_number">Invoice Number</label>
                        <div class="invalid-feedback" v-if="form.errors.invoice_number">{{
                                form.errors.invoice_number
                            }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input v-model="form.invoice_date" type="date" placeholder="Invoice Date" class="form-control"
                               :class="form.errors.invoice_date ? 'is-invalid': ''"
                               id="invoice_date">
                        <label for="invoice_date">Invoice Date</label>
                        <div class="invalid-feedback" v-if="form.errors.invoice_date">{{
                                form.errors.invoice_date
                            }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input v-model="form.due_date" type="date" placeholder="Invoice Due Date" class="form-control"
                               :class="form.errors.due_date ? 'is-invalid': ''"
                               id="due_date">
                        <label for="due_date">Due Date</label>
                        <div class="invalid-feedback" v-if="form.errors.due_date">{{ form.errors.due_date }}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <textarea v-model="form.from" class="form-control" :class="form.errors.from ? 'is-invalid': ''"
                              placeholder="Invoice From" id="from"
                              style="height: 100px"></textarea>
                        <label for="from">From</label>
                        <div class="invalid-feedback" v-if="form.errors.from">{{ form.errors.from }}</div>
                    </div>
                    <div class="form-floating mb-3">
                    <textarea v-model="form.bill_to" class="form-control"
                              :class="form.errors.bill_to ? 'is-invalid': ''" placeholder="Invoice Bill" id="bill_to"
                              style="height: 100px"></textarea>
                        <label for="bill_to">Bill To</label>
                        <div class="invalid-feedback" v-if="form.errors.bill_to">{{ form.errors.bill_to }}</div>
                    </div>
                    <div class="form-floating mb-3">
                    <textarea v-model="form.ship_to" class="form-control"
                              :class="form.errors.ship_to ? 'is-invalid': ''" placeholder="Invoice Ship" id="ship_to"
                              style="height: 100px"></textarea>
                        <label for="ship_to">Ship To</label>
                        <div class="invalid-feedback" v-if="form.errors.ship_to">{{ form.errors.ship_to }}</div>
                    </div>
                    <div class="form-floating mb-3">
                    <textarea v-model="form.terms" class="form-control"
                              :class="form.errors.terms ? 'is-invalid': ''" placeholder="Terms" id="terms"
                              style="height: 100px"></textarea>
                        <label for="terms">Terms & Conditions</label>
                        <div class="invalid-feedback" v-if="form.errors.terms">{{ form.errors.terms }}</div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <h5>Items
                        <button class="btn btn-info btn-sm" @click="addItem" type="button">Add Item</button>
                    </h5>
                </div>
                <div class="row" v-for="(item, index) in form.items" v-bind:key="index" id="item-block">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input v-model="item.quantity" type="text" placeholder="Quantity" class="form-control" :class="form.errors[`items.${index}.quantity`] ? 'is-invalid': ''"
                                   id="quantity">
                            <label for="quantity">Quantity</label>
                            <div class="invalid-feedback" v-if="form.errors[`items.${index}.quantity`]">{{ form.errors[`items.${index}.quantity`] }}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                    <textarea v-model="item.description" class="form-control" :class="form.errors[`items.${index}.description`] ? 'is-invalid': ''" placeholder="Description"
                              id="description"
                    ></textarea>
                            <label for="description">Description</label>
                            <div class="invalid-feedback" v-if="form.errors[`items.${index}.description`]">{{ form.errors[`items.${index}.description`] }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <InputMoney v-model="item.unit_price" :options="{ currency: 'EUR' }" id="unit_price" class="form-control" placeholder="Unit price" :class="form.errors[`items.${index}.unit_price`] ? 'is-invalid': ''"/>
                            <label for="unit_price">Unit price</label>
                            <div class="invalid-feedback" v-if="form.errors[`items.${index}.unit_price`]">{{ form.errors[`items.${index}.unit_price`] }}</div>
                        </div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div class="d-grid gap-2">
                            <button class="btn btn-danger " @click="removeItem(index)" type="button">
                                <i class="bi bi-trash" style="font-size: 28px;"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Create Invoice</button>
                    </div>
                </div>
            </div>
        </form>
    </Main>
</template>

<script>
import Main from "../../Components/Layout/Main"
import {Head, useForm} from '@inertiajs/inertia-vue3'
import InputMoney from "../../Components/Form/InputMoney";

export default {
    name: "Create",
    components: {
        Main,
        Head,
        InputMoney
    },
    props: {
        lastInvoice: Object,
    },
    setup() {
        const form = useForm({
            invoice_number: null,
            invoice_date: null,
            due_date: null,
            from: null,
            bill_to: null,
            ship_to: null,
            terms: null,
            items: [
                {
                    quantity: null,
                    description: null,
                    unit_price: null
                }
            ]
        })

        return {form}
    },
    methods: {
        addItem(data) {
            this.form.items.push({
                quantity: data.quantity ?? null,
                description: data.description ?? null,
                unit_price: data.unit_price ?? null
            })
        },
        removeItem(index) {
            if (this.form.items.length > 1) this.form.items.splice(index, 1)
        },
        fillFields(){
            this.form.from = this.lastInvoice.from
            this.form.invoice_date = this.lastInvoice.invoice_date
            this.form.due_date = this.lastInvoice.due_date
            this.form.bill_to = this.lastInvoice.bill_to
            this.form.ship_to = this.lastInvoice.ship_to
            this.form.terms = this.lastInvoice.terms
            if (this.form.items.length > 0) this.form.items.splice(0, 1)
            this.lastInvoice.items.forEach((value, index) => {
                this.addItem(value);
            })
        }
    },
    computed: {
        invoiceNumber: function () {
            return this.lastInvoice !== null ? Number(this.lastInvoice.number) + 1 : null
        }
    },
    mounted() {
        this.form.invoice_number = this.invoiceNumber
    }
}
</script>

<style scoped>

.invoice-box {
    min-height: calc(100vh - 180px);
    /*background-color: #DDDDDD;*/
}

</style>
