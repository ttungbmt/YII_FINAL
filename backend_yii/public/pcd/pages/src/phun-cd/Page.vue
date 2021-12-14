<template>
    <b-card header-class="p-0">
        <b-card-text>
            <m-form @submit="handleSubmit" v-bind="formOptions">
                <component v-bind:is="i.component" v-for="(i, k) in schema" v-bind="i" :key="k"></component>

                <b-button-group class="mx-1">
                    <b-button variant="primary" type="submit"><i v-if="loading" class="icon-spinner2 spinner"></i> Lưu kết quả</b-button>
                </b-button-group>
            </m-form>
        </b-card-text>
    </b-card>
</template>
<script>
    import {get as pGet} from 'vuex-pathify'

    export default {
        name: 'page-form',
        components: {

        },
        computed: {
            schema: pGet('form.schema'),
            modal: pGet('modal'),
        },
        data() {
            return {
                formOptions: {
                    method: 'POST',
                    options: {
                        model: 'form.values'
                    }
                },

                loading: false,
                errors: []
            }
        },
        watch: {

        },
        mounted() {

        },
        methods: {
            handleSubmit(values, {errors, $form}){

            },
        }
    }
</script>








