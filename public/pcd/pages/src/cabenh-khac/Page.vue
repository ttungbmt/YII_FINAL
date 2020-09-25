<template>
    <b-card>
<!--        {{getFormValues('form-thuonghan')}}-->
        <m-form @submit="submitHandler" name="form-thuonghan" :builder="builder" :initial-values="initialValues"></m-form>

    </b-card>
</template>

<script>
    /*
        https://final-form.org/docs/final-form/field-names
        https://www.npmjs.com/package/keypather
        https://www.npmjs.com/package/objectpath
        https://www.npmjs.com/package/brackets2dots
    */
    import expand from 'keypather/expand'
    import builder from './builder'
    import {get} from 'vuex-pathify'
    import {mapState} from 'vuex'

    export default {
        name: 'PageCabenhKhac',
        data(){
            return {
                builder,
                initialValues: {

                }
            }
        },
        computed: {
            ...get('form', ['getFormValues'])
        },
        methods: {

            submitHandler (data) {
                console.log(data, expand(data))
            },
            onAccept(){
                this.$formulate.submit('form-thuonghan')
                // this.$formulate.setValues('form-thuonghan', {name: 'Hello World 123'})
                // this.$formulate.handle({
                //     inputErrors: { name: 'This address doesn’t appear valid' },
                //     formErrors: ['Required'],
                // }, 'form-thuonghan')
                // console.log()
                // this.$formulate.setValues('form-thuonghan', {name: 'Hello World'})
            }
        }
    }
</script>

<style lang="scss">
    @import './themes/bootstrap/bootstrap.scss';
</style>