<template>
    <div>
        <heading class="mb-6">{{__('google_sheets_importer_configuration')}}</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="link">
                            {{__('google_sheets_link')}}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="link"
                            id="link"
                            type="text"
                            placeholder="Google Sheets Link"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="identifier">
                            {{__('identifier')}}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <select v-model="identifier"
                            name="identifier"
                            id="identifier"
                            required="required"
                            class="w-full form-control form-select">
                            <option value="barcode"
                                selected>{{__('barcode')}}</option>
                            <option value="catalogueNumber">{{__('catalogue')}}</option>
                        </select>
                    </div>
                </div>

                <div class="bg-30 flex px-8 py-4">
                    <button type="button"
                        class="btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3"
                        @click="saveConfiguration">
                        <span class="">{{__('save_configuration')}}</span>
                    </button>
                </div>
            </form>
        </div>

        <heading class="my-8">{{__('supported_columns')}}</heading>

        <div class="card overflow-hidden">
            <div class="overflow-x-auto relative">
                <table class="table w-full">
                    <tbody>
                        <tr>
                            <th scope="row">name</th>
                            <td>{{__('product_name')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">description</th>
                            <td>{{__('product_description')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">details</th>
                            <td>{{__('product_details')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">quantity_in_stock</th>
                            <td>{{__('qty_in_stock')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">minimum_order_quantity</th>
                            <td>{{__('min_order_qty')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">barcode</th>
                            <td>{{__('product_barcode')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">catalogue_number</th>
                            <td>{{__('product_catalogue')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">categories</th>
                            <td>{{__('categories')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">price.{price_level_import_code}</th>
                            <td>{{__('price_for_price_level')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">old_price.{price_level_import_code}</th>
                            <td>{{__('price_for_price_level')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">property.{property_type_import_code}</th>
                            <td>{{__('property_for_property_type')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">option.{property_type_import_code}</th>
                            <td>{{__('options_for_property_type')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">unit</th>
                            <td>{{__('selling_unit')}}</td>
                        </tr>
                        <tr>
                            <th scope="row">vatrate</th>
                            <td>{{__('vat_rate')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                link: null,
                identifier: 'barcode',
            };
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/google-sheets-importer/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.success(this.__('configuration_saved'));
                        this.$router.push('/google-sheets-importer');
                    });
            },
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/google-sheets-importer/settings')
                .then(({ data }) => {
                    this.link = data.payload ? data.payload.link : this.link;
                    this.identifier = data.payload ? data.payload.identifier : this.identifier;
                });
        },
    };
</script>
