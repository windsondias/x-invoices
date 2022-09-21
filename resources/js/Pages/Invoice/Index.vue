<template>
    <Main>
        <Head title="Invoices"/>
        <div class="row invoice-box shadow-lg p-3 rounded">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <Link class="btn btn-info" :href="$route('invoices.create')" method="get" as="button"
                              type="button">Create Invoice
                        </Link>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Number</th>
                                    <th scope="col">Invoice Date</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Bill To</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="invoices.data.length > 0" v-for="(invoice, index) in invoices.data"  :key="invoice.id">
                                    <td>{{ invoice.number }}</td>
                                    <td>{{ invoice.invoice_date }}</td>
                                    <td>{{ invoice.due_date }}</td>
                                    <td>{{ invoice.from }}</td>
                                    <td>{{ invoice.bill_to }}</td>
                                    <td class="text-end">
                                        <a :href="$route('invoices.print', invoice.id)" target="_blank">
                                            <button class="btn text-primary"><i class="bi bi-printer-fill"></i></button>
                                        </a>
                                        <Link class="btn text-danger" :href="$route('invoices.destroy', invoice.id)" method="delete" as="button" type="button"><i class="bi bi-trash-fill"></i></Link>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td style="text-align: center" colspan="6">No invoice found</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <Pagination class="mt-6" :links="invoices.links" />
                </div>
            </div>
        </div>
    </Main>
</template>

<script>
import Main from "../../Components/Layout/Main"
import {Head} from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'
import Pagination from "../../Components/Table/Pagination";

export default {
    name: "Index",
    components: {
        Main,
        Head,
        Link,
        Pagination
    },
    props: {
        invoices: Object
    }
}
</script>

<style scoped>

.invoice-box {
    min-height: calc(100vh - 180px);
    /*background-color: #DDDDDD;*/
}

</style>
