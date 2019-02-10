<template>
    <div>
        <heading class="mb-6">{{ __('xml_importer_config') }}</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">
                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="tag_name">
                            {{ __('tag_name') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="tag_name"
                                id="tag_name"
                                type="text"
                                :placeholder="__('tag_name')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="tag_depth">
                            {{ __('tag_depth') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="tag_depth"
                                id="tag_depth"
                                type="text"
                                :placeholder="__('tag_depth')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="identifier">
                            {{ __('identifier') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <select v-model="identifier"
                                name="identifier"
                                id="identifier"
                                required="required"
                                class="w-full form-control form-select">
                            <option value="barcode" selected>{{ __('barcode') }}</option>
                            <option value="catalogueNumber">{{ __('catalogue_number') }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="price_multiplier">
                            {{ __('price_multiplier') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="price_multiplier"
                                id="price_multiplier"
                                type="text"
                                :placeholder="__('price_multiplier')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>
            </form>
        </div>

        <div class="card overflow-hidden mt-6">
            <form autocomplete="off">

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="name">
                            {{ __('name') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="name"
                                id="name"
                                type="text"
                                :placeholder="__('name')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="name_static" name="name_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="description">
                            {{ __('description') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="description"
                                id="description"
                                type="text"
                                :placeholder="__('description')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="description_static" name="description_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="details">
                            {{ __('details') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="details"
                                id="details"
                                type="text"
                                :placeholder="__('details')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="details_static" name="details_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="catalogue_number">
                            {{ __('catalogue_number') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="catalogue_number"
                                id="catalogue_number"
                                type="text"
                                :placeholder="__('catalogue_number')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="catalogue_number_static" name="catalogue_number_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="barcode">
                            {{ __('barcode') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="barcode"
                                id="barcode"
                                type="text"
                                :placeholder="__('barcode')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="barcode_static" name="barcode_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="quantity_in_stock">
                            {{ __('quantity_in_stock') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="quantity_in_stock"
                                id="quantity_in_stock"
                                type="text"
                                :placeholder="__('quantity_in_stock')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="quantity_in_stock_static" name="quantity_in_stock_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="minimum_order_quantity">
                            {{ __('minimum_order_quantity') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="minimum_order_quantity"
                                id="minimum_order_quantity"
                                type="text"
                                :placeholder="__('minimum_order_quantity')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="minimum_order_quantity_static" name="minimum_order_quantity_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="vatrate">
                            {{ __('vatrate') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="vatrate"
                                id="vatrate"
                                type="text"
                                :placeholder="__('vatrate')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="vatrate_static" name="vatrate_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="price">
                            {{ __('price') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="price"
                                id="price"
                                type="text"
                                :placeholder="__('price')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="price_static" name="price_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="category">
                            {{ __('category') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="category"
                                id="category"
                                type="text"
                                :placeholder="__('category')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="category_static" name="category_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="unit">
                            {{ __('unit') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="unit"
                                id="unit"
                                type="text"
                                :placeholder="__('unit')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="unit_static" name="unit_static"></static-checkbox>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="photo">
                            {{ __('photo') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="photo"
                                id="photo"
                                type="text"
                                :placeholder="__('photo')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                    <div class="w-1/5 py-6 px-8">
                        <static-checkbox v-model="photo_static" name="photo_static"></static-checkbox>
                    </div>
                </div>

                <div class="bg-30 flex px-8 py-4">
                    <button type="button"
                            class="btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3"
                            @click="saveConfiguration">
                        <span class="">{{ __('save_config') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import StaticCheckbox from './StaticCheckbox';

    export default {
        data() {
            return {
                tag_name: '',
                tag_depth: '',
                identifier: 'barcode',
                price_multiplier: '1',
                name: '',
                description: '',
                details: '',
                catalogue_number: '',
                barcode: '',
                quantity_in_stock: '',
                minimum_order_quantity: '',
                vatrate: '',
                price: '',
                category: '',
                unit: '',
                photo: '',
                name_static: true,
                description_static: true,
                details_static: true,
                catalogue_number_static: true,
                barcode_static: true,
                quantity_in_stock_static: true,
                minimum_order_quantity_static: true,
                vatrate_static: true,
                price_static: true,
                category_static: true,
                unit_static: true,
                photo_static: true,
            };
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/xml-importer/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.success(this.__('configuration_saved'));
                        this.$router.push('/xml-importer');
                    });
            },
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/xml-importer/settings')
                .then(({data}) => {
                    let settings = data.payload.settings;

                    if (settings) {
                        this.tag_name = settings.tag_name ? settings.tag_name : null;
                        this.tag_depth = settings.tag_depth ? settings.tag_depth : null;
                        this.identifier = settings.identifier ? settings.identifier : null;
                        this.price_multiplier = settings.price_multiplier ? settings.price_multiplier : null;
                    }

                    let config = data.payload.config;

                    if (config) {
                        this.name_static = !_.isObject(config.name);
                        this.name = this.name_static ? config.name : config.name.uses;

                        this.description_static = !_.isObject(config.description);
                        this.description = this.description_static ? config.description : config.description.uses;

                        this.details_static = !_.isObject(config.details);
                        this.details = this.details_static ? config.details : config.details.uses;

                        this.catalogue_number_static = !_.isObject(config.catalogue_number);
                        this.catalogue_number = this.catalogue_number_static ? config.catalogue_number : config.catalogue_number.uses;

                        this.barcode_static = !_.isObject(config.barcode);
                        this.barcode = this.barcode_static ? config.barcode : config.barcode.uses;

                        this.quantity_in_stock_static = !_.isObject(config.quantity_in_stock);
                        this.quantity_in_stock = this.quantity_in_stock_static ? config.quantity_in_stock : config.quantity_in_stock.uses;

                        this.minimum_order_quantity_static = !_.isObject(config.minimum_order_quantity);
                        this.minimum_order_quantity = this.minimum_order_quantity_static ? config.minimum_order_quantity : config.minimum_order_quantity.uses;

                        this.vatrate_static = !_.isObject(config.vatrate);
                        this.vatrate = this.vatrate_static ? config.vatrate : config.vatrate.uses;

                        this.price_static = !_.isObject(config.price);
                        this.price = this.price_static ? config.price : config.price.uses;

                        this.category_static = !_.isObject(config.category);
                        this.category = this.category_static ? config.category : config.category.uses;

                        this.unit_static = !_.isObject(config.unit);
                        this.unit = this.unit_static ? config.unit : config.unit.uses;

                        this.photo_static = !_.isObject(config.photo);
                        this.photo = this.photo_static ? config.photo : config.photo.uses;
                    }
                });
        },

        components: {
            StaticCheckbox
        }
    };
</script>
