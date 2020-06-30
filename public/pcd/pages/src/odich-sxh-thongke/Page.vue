<template>
    <div>
        <b-card header-class="p-0">
            <m-form @submit="onSubmit">
                <div class="grid grid-cols-2 gap-4">
                    <m-field type="select" :items="dm_loai_tk" label="Loại thống kê" v-model="form.loai_tk"></m-field>
                    <m-field type="select" items="cat.qh" label="Hành chính" :placeholder="form.maquan ? null : `Thành phố`" v-model="form.hc"></m-field>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <m-field type="date" label="Từ ngày Ngày xử lý" v-model="form.date_from" placeholder="DD/MM/YYYY"></m-field>
                    <m-field type="date" label="Đến ngày" v-model="form.date_to" placeholder="DD/MM/YYYY"></m-field>
                </div>

                <m-btn type="submit" color="primary" :loading="$wait.any">Thống kê</m-btn>
            </m-form>
        </b-card>


        <v-wait for="thongke">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>

            <b-alert show v-if="info" class="border-0" dismissible>{{info}}</b-alert>

            <div v-if="!_.isEmpty(data)" >
                <m-btn class="mb-2 mr-3" type="export" :exportOptions="exportOptions" size="sm">Xuất Excel</m-btn>
                <div class="bg-white">
                    <m-table id="tb-thongke" :fields="fields" :items="data" :options="tbOptions"></m-table>
                </div>

            </div>

        </v-wait>
    </div>

</template>
<script>
    import {isEmpty} from 'lodash-es'

    export default {
        name: 'page-thongke-odich',
        components: {

        },
        data() {
            return {
                dm_loai_tk: {
                    1: 'Báo cáo PHC',
                    2: 'Báo cáo DLQ',
                    3: 'Tổng hợp xử lý OD',
                },
                tbOptions: {
                    bordered: true,
                    'sticky-header': true,
                },
                form: {
                    date_from: '',
                    date_to: '',
                    ...pageData.form
                },
                info: '',
                data: {

                },
                fields: [
                ],
                exportOptions: {
                    selector: '#tb-thongke',
                    filename: 'BienbanXLOD.xlsx',
                }
            }
        },
        mounted() {

        },
        methods: {
            onSubmit(){
                this.$wait.start('thongke');
                this.info = ''

                let data = this.form

                this.$http.post(window.location.href, data).then(({data}) => {
                    this.fields = data.fields.map(v => {
                        v.thAttr = function (value, key, item, type) {
                            return {
                                'data-f-bold': true
                            }
                        }

                        return v
                    })
                    this.data = data.data

                    if(isEmpty(this.data)) this.info = 'Không có dữ liệu'

                    this.$wait.end('thongke');
                }).catch((e) => {
                    this.$wait.end('thongke');
                    this.info = 'Error'
                })
            },
            resetData(){
                this.fields = []
                this.data = []
            },
        },
        watch: {
            'form.loai_tk': function (val) {
                this.resetData()
            }
        }
    }
</script>








