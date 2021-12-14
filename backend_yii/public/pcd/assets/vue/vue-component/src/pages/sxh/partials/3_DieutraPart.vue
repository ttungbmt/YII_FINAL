<template>
    <div>
        <b-row>
            <b-col :key="k" v-for="(i, k) in only(schema, ['songuoicutru', 'cutruduoi15'])">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>

        <div class="phieu-title mb-10">
            <span class="badge badge-flat badge-pill border-primary text-primary bold">2</span> Điều tra dịch tễ
        </div>
        <b-row class="mt-2">
            <b-col>
                <b-row>
                    <b-col>
                        <field-sxh name="tpbv"/>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col v-if="form.tpbv" md="6">
                        <field-sxh name="tpbv_bv" />
                    </b-col>
                </b-row>
            </b-col>
            <b-col v-if="form.tpbv==0">
                <b-row>
                    <b-col>
                        <field-sxh name="phcd"/>
                    </b-col>
                    <b-col v-if="form.phcd==1">
                        <field-sxh name="nhapvien"/>
                    </b-col>
                </b-row>
                <field-sxh name="nhapvien_bv" v-if="form.nhapvien == 1"/>
            </b-col>
        </b-row>

        <b-row>
            <b-col :key="k" v-for="(i, k) in only(schema, ['ngaymacbenh', 'ngaynhapvien', 'nghenghiep'])" :md="i.md">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <field-sxh name="xetnghiem"/>
            </b-col>
            <b-col :key="k" v-for="(i, k) in only(schema, ['ngaylaymau', 'loai_xn', 'ketqua_xn'])" v-if="form.xetnghiem==1">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>

        <b-row>
            <b-col :key="k" v-for="(i, k) in only(schema, ['dclamviec', 'dclamviec_tinh'])" :md="i.md">
                <field-sxh :name="i.name"/>
            </b-col>
            <b-col :key="'dclamviec-'+k" v-for="(i, k) in only(schema, ['dclamviecqh', 'dclamviecpx'])" :md="i.md" v-if="form.dclamviec_tinh == '79'">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>
        <field-sxh name="noilamviec_sxh"/>
        <div class="form-group">
            Trong vòng 2 tuần trước khi bị bệnh, BN có đi đến hay thường đến những nơi nào sau đây (đánh dấu nhiều ô):
        </div>
        <div>
            <b-row :key="k" v-for="(i, k) in only(schema, ['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu'])">
                <b-col md="3">
                    {{i.labelInline}}
                </b-col>
                <b-col md="9">
                    <field-sxh :name="i.name"/>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="3">
                    {{schema.noikhac.labelInline}}
                </b-col>
                <b-col md="3">
                    <field-sxh name="noikhac"/>
                </b-col>
                <b-col md="6" v-if="form.noikhac == 1">
                    <field-sxh name="noikhac_ghichu"/>
                </b-col>
            </b-row>
        </div>
        <div class="form-group">
            Các điểm đã đến ghi ở trên thuộc địa bàn (đánh dấu nhiều ô):
        </div>
        <b-row :key="k" v-for="(i, k) in only(schema, ['diemden_px', 'diemden_pxkhac', 'diemden_qhkhac'])">
            <b-col md="3">
                {{i.labelInline}}
            </b-col>
            <b-col md="9">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>

        <div class="form-group">
            Trong vòng 1 tháng qua, tại gia đình
        </div>
        <b-row>
            <b-col md="4">
                <field-sxh name="gdcosxh"/>
            </b-col>
            <b-col :key="k" v-for="(i, k) in only(schema, ['gdsonguoisxh', 'gdso15t'])" md="3" v-if="form.gdcosxh==1">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>
        <b-row>
            <b-col md="4">
                <field-sxh name="gdthuocsxh"/>
            </b-col>
            <b-col :key="k" v-for="(i, k) in only(schema, ['gdthuocsxhsonguoi', 'gdthuocsxh15t'])" md="3" v-if="form.gdthuocsxh==1">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>
        <div class="form-group">
            (nếu có người mắc bệnh SXH, điều tra ca bệnh tiếp tục theo mẫu điều tra này)
        </div>

        <div class="phieu-title mb-2">
            <span class="badge badge-flat badge-pill border-primary text-primary bold">3</span> Khảo sát lăng quăng
        </div>

        <p>Khảo sát khi ca bệnh là ca chỉ điểm / ca đầu tiên.</p>
        <ul>
            <li>Mục đích khảo sát là để có quyết định xử lý như ổ dịch nhỏ hay không.</li>
            <li>Nếu là các ca thứ phát chỉ khảo sát trong quá trình xử lý ổ dịch.</li>
        </ul>
        <p>Khảo sát nhà ca bệnh và 15 nhà chung quanh theo mẫu khảo sát lăng quăng.</p>

        <div class="form-inline">
            <label class="control-label mr-2">Kết quả:</label>
            <div v-for="(i, k) in only(schema, ['bi', 'ci'])" :key="k" class="mr-2">
                <field-sxh :name="i.name"/>
            </div>
        </div>

    </div>
</template>
<script>
    import { mapState } from 'vuex'

    export default {
        name: 'dieutra-part',
        computed: {
            ...mapState(['dm', 'form', 'schema'])
        },
    }
</script>