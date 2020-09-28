<template>
    <b-card-header class="bg-white header-elements-inline" v-sticky>
        <div class="card-title  font-weight-semibold text-primary">
            <div class="float-left">
                <i class="icon-map5 position-left"></i> {{form.hoten | or('Phiếu điều tra SXH') |
                uppercase}}
                <span class="ml-2">
                    <b-badge :variant="loai_dt_item.variant"
                             :data-value="loai_dt_item.value">{{loai_dt_item.text}}</b-badge>
                     <b-badge variant="info" class="ml-2"
                              :data-value="xacminh_cb_item.value">{{xacminh_cb_item.text}}</b-badge>

                </span>
            </div>
        </div>
        <div class="header-elements">
            <li class="list-inline-item">
                <b-form-group class="text-right" v-if="unLockedBtn">
                    <button class="btn btn-success" type="button" @click="checkOdich" v-if="form.id" :disabled="!form.geom"><i class="fa fa-spinner fa-spin" v-if="$wait.is('checking.odich')"></i> Phát hiện ổ dịch</button>

                    <v-ladda type="submit" :button-class="`btn btn-`+(shownChuyenca ? 'danger': 'primary')"
                             :loading="loading">
                        <span v-if="shownChuyenca">Lưu và chuyển ca</span>
                        <span v-else>Lưu phiếu</span>
                    </v-ladda>
                </b-form-group>
                <div v-else>
                    <b-badge variant="danger" class="text-uppercase">Bạn không đủ quyền để cập nhật phiếu</b-badge>
                </div>
            </li>
        </div>
    </b-card-header>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import { last, head, get, includes, isNull } from 'lodash-es'


    export default {
        name: 'header-part',
        props: ['shownChuyenca'],
        computed: {
            ...mapState(['form', 'xacminh', 'shownDieutra', 'dm', 'loading', 'user']),
            loai_dt_item() {
                let loai_dt = this.form.loaidieutra,
                    colors = {0: 'danger', 1: 'warning', 2: 'info', 3: 'primary'},
                    status = this.dm.loaidieutra.find(v => v.value == loai_dt)
                status.variant = colors[status.value]
                return status
            },
            xacminh_cb_item() {
                let val = this.form.loai_xm_cb
                return this.dm.xacminh_cb.find(v => v.value == val) || {}
            },
            unLockedBtn() {
                let maphuong = this.user.maphuong,
                    px2 = get(last(this.form.xacminh), 'px')

                // if (isNull(px2) || maphuong == px2 || includes(this.user.roles, 'quan')) {
                //     return true
                // }

                return true
            },
        },
        methods: {
            ...mapActions(['checkOdich'])
        }

    }
</script>