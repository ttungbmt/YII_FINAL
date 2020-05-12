import { isEmpty } from 'lodash-es'
import $ from 'jquery'

// required: formId, postUrl

const mixin = {
    data() {
        return {
            isLoading: false,
            resp: null,
            formData: {}
        }
    },
    mounted() {
        if (this.formId) {
            this.$form = $(`#${this.formId}`)
            this.$form.on('beforeSubmit', this.onSubmit)
        }
    },
    computed: {
        shownResp() {
            return !this.isLoading && !isEmpty(this.resp)
        },
    },
    methods: {
        onSubmit(e) {
            e.preventDefault()
            this.getPost()
            return false
        },

        getFormData() {
            return this.$form.serializeObject()
        },
        async getPost() {
            this.formData = this.getFormData()
            this.beforePost(this.formData)
            this.isLoading = true
            try {
                const {body: resp} = await this.$http.post(this.postUrl, this.formData)
                this.afterPost(resp)
                this.isLoading = false
            } catch (error) {
                this.isLoading = false
                console.error(error);
            }
        },
        beforePost() {

        },
        afterPost(resp) {
            this.resp = resp.data
        },

    }
}

export default mixin