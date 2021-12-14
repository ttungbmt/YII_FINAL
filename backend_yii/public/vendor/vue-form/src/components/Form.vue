<template>
    <validation-observer v-slot="{ invalid, handleSubmit, reset, errors, failed }" ref="form" slim>
        <form @submit.prevent="handleSubmit(onSubmit)" v-bind="$attrs">
            <b-alert show dismissible fade variant="danger" class="m-alert mt-2" v-if="failed">
                <div v-for="message in filterErrors(errors)">
                    {{message}}
                </div>
            </b-alert>
            <slot />
        </form>
    </validation-observer>
</template>
<script>
    import {map, head, has} from 'lodash-es'

    export default {
        name: 'm-form',
        props: {
            options: [Object]
        },
        provide () {
            return {
                formOptions: this.options
            }
        },
        methods: {
            onSubmit () {
                let value = has(this.options, 'model') ? this.$store.get(this.options.model): {}

                this.$emit('submit', value, {
                    $form: this.$refs.form,
                    errors: this.getErrors()
                })

            },
            filterErrors(errors){
                return map(errors, v => head(v))
            },
            getErrors(){
                return map(this.$refs.form.errors, v => v[0]).filter(v => v)
            }
        },
        mounted(){
            this.form = this.$refs.form
        },
    }
</script>

<style scoped>
    .m-alert {
        border: none;
    }
</style>