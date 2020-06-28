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
    import {map, head} from 'lodash-es'

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
                let errors =  map(this.$refs.form.errors, v => v[0]).filter(v => v)

                this.$emit('submit', this.$store.get(this.options.model), {
                    $form: this.$refs.form,
                    errors
                })
            },
            filterErrors(errors){
                return map(errors, v => head(v))
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