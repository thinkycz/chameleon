<template>
    <dropzone :destroyDropzone="false"
        :ref="elementId"
        @vdropzone-sending="sendingEvent"
        @vdropzone-removed-file="removeFile"
        @vdropzone-success="addedFile"
        @vdropzone-error="handleError"
        :id="elementId"
        :options="dropzoneOptions">
    </dropzone>
</template>

<script>
    import Dropzone from 'vue2-dropzone';

    export default {
        data() {
            return {
                dropzoneOptions: {
                    acceptedFiles: 'image/*',
                    addRemoveLinks: true,
                    url: '',
                    thumbnailWidth: 200,
                    maxFilesize: 2,
                    parallelUploads: 1,
                    uploadMultiple: true,
                    maxFiles: this.maxImages,
                },
            };
        },

        props: {
            maxImages: {
                default: 9,
                required: false,
            },

            elementId: {
                required: true,
            },

            route: {
                required: true,
            },

            prepopulate: {
                required: false,
                default() {
                    return [];
                },
            },

            deleteRoute: {
                required: false,
            },

            identifier: {
                required: false,
                default: null,
            },
        },

        components: {
            dropzone: Dropzone,
        },

        methods: {
            sendingEvent(file, xhr, formData) {
                formData.append('_token', document.head.querySelector('meta[name="csrf-token"]').content);

                if (this.identifier) {
                    formData.append('identifier', this.identifier);
                }
            },

            removeFile(file, xhr, formData) {
                console.log(file);

                if (!this.deleteRoute || typeof file.model === 'undefined') {
                    return false;
                }

                let route = `${this.deleteRoute}/${file.model}/${file.id}`;

                return axios.delete(route).then(res => {
                    return true;
                });
            },

            handleError(file, message, error) {
                Nova.$emit('error', message.message);
            },

            addedFile(file) {
                let response = JSON.parse(file.xhr.response);
                file.id = response.payload.media.id;
                file.model = response.payload.media.model_id;
            },
        },
        created() {
            let obj = {
                url: this.route,
                maxFiles: this.maxImages,
                dictDefaultMessage: this.__('upload_images'),
                dictFallbackMessage: this.__('dictFallbackMessage'),
                dictFallbackText: this.__('dictFallbackText'),
                dictFileTooBig: this.__('dictFileTooBig', {
                    filesize: '',
                    maxFilesize: 2,
                }),
                dictInvalidFileType: this.__('dictInvalidFileType'),
                dictResponseError: this.__('dictResponseError', { statusCode: '' }),
                dictCancelUpload: this.__('dictCancelUpload'),
                dictCancelUploadConfirmation: this.__('dictCancelUploadConfirmation'),
                dictRemoveFile: this.__('dictRemoveFile'),
                dictMaxFilesExceeded: this.__('dictMaxFilesExceeded'),
            };

            this.dropzoneOptions = { ...this.dropzoneOptions, ...obj };
        },
        mounted() {
            window._.forEach(this.prepopulate, image => {
                let file = { size: image.size, name: image.name, id: image.id };
                this.$refs[this.elementId].manuallyAddFile(file, window.baseURL + image.url);
            });
        },
    };
</script>

<style lang="scss" scoped>
    .vue-dropzone {
        box-sizing: border-box;
        * {
            box-sizing: border-box;
        }
        min-height: 250px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        background: #fff;
        padding: 20px;
        border-radius: 0.25rem;
        &.dz-clickable {
            cursor: pointer;
            * {
                cursor: default;
            }
            .dz-message {
                cursor: pointer;
                * {
                    cursor: pointer;
                }
            }
        }
        &.dz-started /deep/ .dz-message {
            display: none;
        }
        &.dz-drag-hover {
            border-style: solid;
            .dz-message {
                opacity: 0.5;
            }
        }
        /deep/ .dz-message {
            text-align: center;
            margin: 2em 0;
            font-size: 1.6rem;
        }
    }

    .vue-dropzone {
        /deep/ .dz-preview {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            margin: 16px;
            min-height: 100px;
            &:hover {
                z-index: 1000;
            }
            &.dz-file-preview {
                .dz-image {
                    border-radius: 20px;
                    background: #999;
                    background: linear-gradient(180deg, #eee, #ddd);
                }
                .dz-details {
                    opacity: 1;
                }
            }
            &.dz-image-preview {
                background: #fff;
                .dz-details {
                    transition: opacity 0.2s linear;
                }
            }
            .dz-remove {
                font-size: 14px;
                text-align: center;
                display: block;
                cursor: pointer;
                border: none;
                &:hover {
                    text-decoration: underline;
                }
            }
            &:hover .dz-details {
                opacity: 1;
            }
            .dz-details {
                z-index: 20;
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0;
                font-size: 13px;
                min-width: 100%;
                max-width: 100%;
                padding: 2em 1em;
                text-align: center;
                color: rgba(0, 0, 0, 0.9);
                line-height: 150%;
                .dz-size {
                    margin-bottom: 1em;
                    font-size: 16px;
                }
                .dz-filename {
                    white-space: nowrap;
                    &:hover span {
                        border: 1px solid hsla(0, 0%, 78%, 0.8);
                        background-color: hsla(0, 0%, 100%, 0.8);
                    }
                    overflow: hidden;
                    text-overflow: ellipsis;
                    &:not(:hover) span {
                        border: 1px solid transparent;
                    }
                    span {
                        background-color: hsla(0, 0%, 100%, 0.4);
                        padding: 0 0.4em;
                        border-radius: 3px;
                    }
                }
                .dz-size span {
                    background-color: hsla(0, 0%, 100%, 0.4);
                    padding: 0 0.4em;
                    border-radius: 3px;
                }
            }
            &:hover .dz-image img {
                -webkit-transform: scale(1.05);
                transform: scale(1.05);
                -webkit-filter: blur(8px);
                filter: blur(8px);
            }
            .dz-image {
                border-radius: 20px;
                overflow: hidden;
                width: 160px;
                height: 160px;
                position: relative;
                display: block;
                z-index: 10;
                img {
                    display: block;
                    max-width: 160px;
                    height: 160px !important;
                }
            }
            &.dz-success .dz-success-mark {
                -webkit-animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1);
                animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1);
            }
            &.dz-error .dz-error-mark {
                opacity: 1;
                -webkit-animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1);
                animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1);
            }
            .dz-error-mark,
            .dz-success-mark {
                pointer-events: none;
                opacity: 0;
                z-index: 500;
                position: absolute;
                display: block;
                top: 50%;
                left: 50%;
                margin-left: -27px;
                margin-top: -27px;
            }
            .dz-error-mark svg,
            .dz-success-mark svg {
                display: block;
                width: 54px;
                height: 54px;
            }
            &.dz-processing .dz-progress {
                opacity: 1;
                transition: all 0.2s linear;
            }
            &.dz-complete .dz-progress {
                opacity: 0;
                transition: opacity 0.4s ease-in;
            }
            &:not(.dz-processing) .dz-progress {
                -webkit-animation: pulse 6s ease infinite;
                animation: pulse 6s ease infinite;
            }
            .dz-progress {
                opacity: 1;
                z-index: 1000;
                pointer-events: none;
                position: absolute;
                height: 16px;
                left: 50%;
                top: 50%;
                margin-top: -8px;
                width: 80px;
                margin-left: -40px;
                background: hsla(0, 0%, 100%, 0.9);
                -webkit-transform: scale(1);
                border-radius: 8px;
                overflow: hidden;
                .dz-upload {
                    background: #333;
                    background: linear-gradient(180deg, #666, #444);
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 0;
                    transition: width 0.3s ease-in-out;
                }
            }
            &.dz-error {
                .dz-error-message {
                    display: block;
                }
                &:hover .dz-error-message {
                    opacity: 1;
                    pointer-events: auto;
                }
            }
            .dz-error-message {
                pointer-events: none;
                z-index: 1000;
                position: absolute;
                opacity: 0;
                transition: opacity 0.3s ease;
                border-radius: 8px;
                font-size: 13px;
                top: 130px;
                left: -10px;
                width: 140px;
                background: #be2626;
                background: linear-gradient(180deg, #be2626, #a92222);
                padding: 0.5em 1.2em;
                color: #fff;
                &:after {
                    content: '';
                    position: absolute;
                    top: -6px;
                    left: 64px;
                    width: 0;
                    height: 0;
                    border-left: 6px solid transparent;
                    border-right: 6px solid transparent;
                    border-bottom: 6px solid #be2626;
                }
            }
        }
        border: 1px solid #e5e5e5;
        letter-spacing: 0.2px;
        color: #777;
        transition: background-color 0.2s linear;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);

        &:hover {
            background-color: #f6f6f6;
        }
        i {
            color: #ccc;
        }

        /deep/ .dz-preview {
            .dz-image {
                img {
                    object-fit: contain !important;
                }
                &:hover img {
                    transform: none;
                    filter: none;
                }
            }
            .dz-details {
                bottom: 0;
                top: 0;
                color: #fff;
                background-color: rgba(33, 150, 243, 0.8);
                transition: opacity 0.2s linear;
                text-align: left;
                .dz-filename span,
                .dz-size span {
                    background-color: transparent;
                }
                .dz-filename {
                    &:not(:hover) span {
                        border: none;
                    }
                    &:hover span {
                        background-color: transparent;
                        border: none;
                    }
                }
            }
            .dz-progress .dz-upload {
                background: #ccc;
            }
            .dz-remove {
                position: absolute;
                z-index: 30;
                color: #fff;
                margin: 0 15px;
                padding: 10px;
                top: inherit;
                bottom: 15px;
                border: 2px solid #fff;
                text-decoration: none;
                text-transform: uppercase;
                font-size: 0.8rem;
                font-weight: 800;
                letter-spacing: 1.1px;
                opacity: 0;
            }
            &:hover .dz-remove {
                opacity: 1;
            }
            /deep/ .dz-error-mark,
            /deep/ .dz-success-mark {
                margin-left: auto !important;
                margin-top: auto !important;
                width: 100% !important;
                top: 30% !important;
                left: 35% !important;
            }
            /deep/ .dz-error-mark i,
            /deep/ .dz-success-mark i {
                color: #fff !important;
                font-size: 5rem !important;
            }
            .dz-error-message {
                top: 75%;
                left: 15%;
            }
        }
    }
</style>