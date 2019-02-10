<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">{{__('xml_importer')}}</heading>

            <div class="w-full flex items-center mb-6">
                <div class="flex w-full justify-end items-center mx-3"></div>
                <div class="flex-no-shrink ml-auto">
                    <router-link to="/xml-importer/configure" class="btn btn-default btn-primary">
                        {{ __('configuration') }}
                    </router-link>
                </div>
            </div>
        </div>

        <card class="flex flex-col p-8">
            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('last_update') }}</div>
                <div class="w-3/4">{{ lastUpdate }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('duration') }}</div>
                <div class="w-3/4">{{ duration }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('status') }}</div>
                <div class="w-3/4">{{ status }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('manual_upload') }}</div>
                <div class="w-3/4">
                    <input type="file" name="file" ref="file" accept="text/xml">
                </div>
            </div>

            <div class="flex my-4">
                <div class="w-3/4 ml-auto">
                    <button type="button"
                            class="btn btn-default btn-primary"
                            @click="sync">{{ __('sync_now') }}
                    </button>
                    <button type="button"
                            class="btn btn-default btn-primary"
                            @click="validate">{{ __('validate_parser') }}
                    </button>
                    <button type="button"
                            class="btn btn-default btn-primary"
                            @click="refresh">{{ __('refresh_status') }}
                    </button>
                </div>
            </div>
        </card>

        <portal to="modals">
            <transition name="fade">
                <modal v-if="modalOpen">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 1000px;">
                        <div class="bg-30 px-6 py-3 flex">
                            <div class="flex items-center justify-between w-full">
                                <strong>Validation result</strong>
                                <button type="button" @click.prevent="modalOpen = false" class="btn text-80 font-normal h-9 px-3 mr-3 btn-link">&times; Close</button>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Name
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('name') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Description
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('description') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Details
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('details') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Catalogue Number
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('catalogue_number') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Barcode
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('barcode') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Quantity In Stock
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('quantity_in_stock') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Minimum Order Quantity
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('minimum_order_quantity') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        VAT Rate
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('vatrate') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Price
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('price') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Category
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('category') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Unit
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('unit') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        Photo
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    {{ getProductField('photo') }}
                                </div>
                            </div>
                            <div class="flex border-b border-40">
                                <div class="w-1/4 py-4">
                                    <h4 class="font-normal text-80">
                                        RAW Data
                                    </h4>
                                </div>
                                <div class="w-3/4 py-4">
                                    <code-area :value="validationResponse.json"></code-area>
                                </div>
                            </div>
                        </div>
                    </div>
                </modal>
            </transition>
        </portal>
    </div>
</template>

<script>
    import CodeArea from "./CodeArea";

    export default {
        components: {CodeArea},
        data() {
            return {
                lastUpdate: null,
                duration: null,
                status: null,
                modalOpen: false,
                validationResponse: null,
            };
        },
        methods: {
            sync() {
                Nova.request()
                    .post('/nova-vendor/xml-importer/sync')
                    .then(() => {
                        this.$toasted.success(this.__('syncing_in_progress'));
                        setTimeout(this.refresh, 1000);
                    })
                    .catch(err => {
                        this.$toasted.success(this.__('please_check_config'));
                    });
            },

            validate() {
                let formData = new FormData();
                formData.append('xmlfile', this.$refs.file.files[0]);

                Nova.request()
                    .post('/nova-vendor/xml-importer/validate-parser', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(({data}) => {
                        this.validationResponse = data.payload;
                        this.modalOpen = true;
                    })
            },

            refresh() {
                Nova.request()
                    .get('/nova-vendor/xml-importer/status')
                    .then(({data}) => {
                        this.lastUpdate = data.payload.lastUpdate;
                        this.duration = data.payload.duration;
                        this.status = data.payload.status;
                    });
            },

            getProductField(field) {
                return _.isObject(this.validationResponse.product[field]) ? this.validationResponse.product[field][0] : this.validationResponse.product[field];
            }
        },
        created() {
            this.refresh();
        },
    };
</script>

