<template>
    <div>
        <div class="phieu-title mb-2 mt-2">
            <span class="badge badge-flat badge-pill border-primary text-primary bold">4</span> Hướng xử lý
        </div>
        <p class="font-weight-semibold text-primary">Ca bệnh</p>
        <b-row>
            <b-col class="font-weight-semibold" md="4">
                {{_.get(schema, 'cachidiem.labelInline')}}
            </b-col>
            <b-col md="4">
                <field-sxh name="cachidiem"/>
            </b-col>
        </b-row>
        <div v-if="form.cachidiem == 1">
            <div class="form-group font-weight-semibold"> Dự kiến xử lý</div>
            <b-row :key="k" v-for="(i, k) in only(schema, ['dietlangquang', 'giamsattheodoi'])">
                <b-col md="4">
                    {{i.labelInline}}
                </b-col>
                <b-col md="4">
                    <field-sxh :name="i.name"/>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="4">
                    {{_.get(schema, 'xulyonho.labelInline')}}
                </b-col>
                <b-col md="4">
                    <field-sxh name="xulyonho"/>
                </b-col>

            </b-row>
            <b-row v-if="form.xulyonho == 0">
                <b-col md="4">
                    {{_.get(schema, 'xulyorong.labelInline')}}
                </b-col>
                <b-col md="4">
                    <field-sxh name="xulyorong"/>
                </b-col>
            </b-row>
        </div>
        <div v-if="form.cachidiem == 0">
            <b-row>
                <b-col class="font-weight-semibold" md="4">
                    2. Ca bệnh thứ phát
                </b-col>
                <b-col md="4">
                    <field-sxh name="cathuphat"/>
                </b-col>
            </b-row>
            <div v-if="form.cathuphat == 1">
                <b-row>
                    <b-col md="3">
                        Ổ dịch mới
                    </b-col>
                    <b-col md="9">
                        <field-sxh name="odichmoi"/>
                    </b-col>
                </b-row>
                <b-row v-if="form.odichmoi == 0">
                    <b-col md="3">
                        Ổ dịch cũ đã xác định
                    </b-col>
                    <b-col md="3">
                        <field-sxh name="odichcu"/>
                    </b-col>
                    <b-col md="3" v-if="form.odichcu == 1">
                        <field-sxh name="odichcu_xuly"/>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                        <field-sxh name="xuly"/>
                    </b-col>
                    <b-col v-if="form.xuly == 3">
                        <field-sxh name="xuly_ngay"/>
                    </b-col>
                </b-row>
            </div>
        </div>


        <div class="phieu-title mb-2">
            <span class="badge badge-flat badge-pill border-primary text-primary bold">5</span> Kết luận
        </div>
        <b-row v-if="form.ht_dieutri == 1">
            <b-col>
                <field-sxh name="xuatvien"/>
            </b-col>
            <b-col v-if="form.xuatvien == 1">
                <field-sxh name="ngayxuatvien"/>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <field-sxh name="chuandoan" :options="dm_chuandoan"/>
            </b-col>
            <b-col v-if="form.chuandoan == 3">
                <field-sxh name="chuandoan_khac"/>
            </b-col>
        </b-row>

        <div class="form-group"><i>* Điều tra ghi phiếu đầy đủ và không bỏ sót bất kỳ nội dung nào. <br>
            * Mẫu phiếu được thực hiện:  ca bệnh thông báo khi bệnh nhân có ở tại nhà, cư trú có thể ở bất cứ nơi đâu, bệnh sốt xuất huyết hay là bệnh khác.
        </i></div>
    </div>
</template>
<script>
    import { mapState } from 'vuex'

    export default {
        name: 'xuly-part',
        computed: {
            ...mapState(['form', 'schema', 'dm']),
            dm_chuandoan(){
                if(this.form.xuatvien == 0) return this.dm.chuandoan.filter(v => v.value === 1)

                return this.dm.chuandoan
            }
        },
    }
</script>