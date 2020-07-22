<template>
    <div>
        <header>
            <p class="text-primary">Phiếu điều tra</p>
            <p class="text-primary">Ca bệnh sốt xuất huyết Dengue</p>
        </header>
        <div>
            <b-row>
                <b-col :key="k" v-for="(i, k) in only(schema, ['ngaynhanthongbao', 'ngaydieutra', 'maso'])">
                    <field-sxh :name="i.name"/>
                </b-col>
                <b-col></b-col>
            </b-row>
            <div class="phieu-title mb-2">
                <span class="badge badge-flat badge-pill border-primary text-primary">1</span> Xác minh ca bệnh
            </div>
            <b-row>
                <b-col :key="k" v-for="(i, k) in only(schema, ['hoten', 'phai', 'ngaysinh', 'tuoi'])">
                    <field-sxh :name="i.name"/>
                </b-col>
            </b-row>

            <div v-for="(v, k) in xacminh.items" :key="k">
                <b-row>
                    <b-col :key="k1" v-for="(i, k1) in only(schema, ['is_diachi', 'is_benhnhan', 'dienthoai'])">
                        <field-sxh :id="`field-${k}-${i.name}`" :name="`xacminh[${k}][${i.name}]`" v-if="!(i.name==='is_benhnhan' && k % 2)" :nameKey="i.name" :path="`xacminh.items.${k}.${i.name}`" :label="schema[i.name].label+` (${k+1})`" />
                    </b-col>
                    <b-col v-if="k === 0">
                        <div role="group" class="form-group" id="__BVID__113">
                            <label class="d-block">
                                <span>Vị trí (cũ)</span>
                                <b-badge class="ml-2" content="Tìm kiếm trên Google" v-tippy :href="`https://www.google.com/maps/search/${encodeURIComponent(form.vitri)}`" variant="info" target="_blank">Google</b-badge>
                                <b-badge content="Tìm kiếm trên Vietbando" v-tippy :href="`http://maps.vietbando.com/maps/?sk=${encodeURIComponent(form.vitri)}`" variant="secondary" target="_blank">Vietbando</b-badge>
                            </label>
                            <div>
                                {{form.vitri}}
                            </div>
                        </div>

                    </b-col>
                </b-row>
                <div v-if="((k+1)%2 != 0 || ((k+1)%2 == 0 &&  v.is_diachi == 1)) && v.is_benhnhan == null">
                    <b-row>
                        <b-col>
                            <field-sxh :id="`field-${k}-sonha`" :name="`xacminh[${k}][sonha]`" nameKey="sonha" :path="`xacminh.items.${k}.sonha`" :label="schema['sonha'].label+` (${k+1})`"/>
                        </b-col>
                        <b-col>
                            <field-sxh :id="`field-${k}-duong`" :name="`xacminh[${k}][duong]`" nameKey="duong" :path="`xacminh.items.${k}.duong`" :label="schema['duong'].label+` (${k+1})`"/>
                        </b-col>
                        <b-col v-if="v.tinh ==='HCM'&& v.px">
                            <field-sxh :id="`field-${k}-khupho`" :name="`xacminh[${k}][khupho]`" nameKey="khupho" :path="`xacminh.items.${k}.khupho`" :label="schema['khupho'].label+` (${k+1})`" :depends="[`field-${k}-px`]"/>
                        </b-col>
                        <b-col v-if="v.tinh ==='HCM'&& v.px">
                            <field-sxh :id="`field-${k}-to_dp`" :name="`xacminh[${k}][to_dp]`" nameKey="to_dp" :path="`xacminh.items.${k}.to_dp`" :label="schema['to_dp'].label+` (${k+1})`" :depends="[`field-${k}-khupho`]" :params="[`field-${k}-qh`, `field-${k}-px`]"/>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col md="6">
                            <field-sxh :id="`field-${k}-tinh`" :name="`xacminh[${k}][tinh]`" nameKey="tinh" :path="`xacminh.items.${k}.tinh`" :label="schema['tinh'].label+` (${k+1})`" :options="getDmTinh(k)"/>
                        </b-col>
                        <b-col v-if="v.tinh ==='HCM'">
                            <field-sxh :id="`field-${k}-qh`" :name="`xacminh[${k}][qh]`" nameKey="qh" :path="`xacminh.items.${k}.qh`" :label="schema['qh'].label+` (${k+1})`"/>
                        </b-col>
                        <b-col v-if="v.tinh ==='HCM'">
                            <field-sxh :id="`field-${k}-px`" :name="`xacminh[${k}][px]`" nameKey="px" :path="`xacminh.items.${k}.px`" :label="schema['px'].label+` (${k+1})`" :depends="[`field-${k}-qh`]"/>
                        </b-col>
                        <b-col v-if="v.tinh ==='TinhKhac'">
                            <field-sxh :id="`field-${k}-tinh_dc_khac`" :name="`xacminh[${k}][tinh_dc_khac]`" nameKey="tinh_dc_khac" :path="`xacminh.items.${k}.tinh_dc_khac`" :label="schema['tinh_dc_khac'].label+` (${k+1})`"/>
                        </b-col>
                    </b-row>
                </div>

            </div>

            <b-row v-if="shownDieutra">
                <b-col>
                    <field-sxh name="benhnoikhac"/>
                </b-col>
            </b-row>
            <div v-if="form.benhnoikhac==1">
                <b-row>
                    <b-col :key="k" v-for="(i, k) in only(schema, ['sonhakhac', 'duongkhac', 'khuphokhac', 'tokhac'])" :md="i.md">
                        <field-sxh :name="i.name"/>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="6">
                        <field-sxh name="tinhkhac" />
                    </b-col>
                    <b-col :key="k" v-for="(i, k) in only(schema, ['qhkhac', 'pxkhac'])" :md="i.md" v-if="form.tinhkhac==='HCM'">
                        <field-sxh :name="i.name"/>
                    </b-col>
                    <b-col v-if="form.tinhkhac==='TinhKhac'">
                        <field-sxh name="tinhnoikhac"/>
                    </b-col>
                </b-row>
            </div>
        </div>

    </div>
</template>
<script>
    import {isNil, reject} from 'lodash-es'
    import { mapState, mapGetters } from 'vuex'

    export default {
        name: 'xacminh-part',
        computed: {
            ...mapGetters([
                'lastXm',
            ]),
            ...mapState(['form', 'schema', 'xacminh', 'dm', 'shownDieutra'])
        },
        methods: {
            getDmTinh(index){
                return (!isNil(index) && index % 2 === 0) ?  reject(this.dm.tinh, {value: 'TinhKhac'}) : this.dm.tinh
            }
        }
    }
</script>