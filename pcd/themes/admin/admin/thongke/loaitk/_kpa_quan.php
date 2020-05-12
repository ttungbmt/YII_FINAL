<style>
    #table-tkcabenh tbody tr:nth-child(4) td {
        font-weight: bold;
    }
</style>
<?php if(empty($model->getFirstErrors())): ?>
    <div id="tkcabenh">
        <div class="table-responsive">
            <table id="table-tkcabenh" class="table table-bordered">
                <thead>

                <tr>
                    <th rowspan="2">Thông tin ca bệnh</th>
                    <th v-if="cap=='quan'" v-for="item in tk_kpa">PX</th>
                    <th v-if="cap=='phuong'" v-for="item in tk_kpa">KP - ấp</th>
                    <th rowspan="2">Tổng cộng</th>
                </tr>
                <tr>
                    <th v-if="" v-for="item in cb">{{item.khupho1}}</th>
                    <th v-if="cap=='quan'" v-for="item in tk_kpa">{{item.ten_px}}</th>
                    <th v-if="cap=='phuong'" v-for="item in tk_kpa">{{item.khupho1 ? item.khupho1 : 'KHONG RO'}}</th>
                </tr>
                </thead>
                <tbody>

                <tr class="table-info">
                    <td class="font-weight-semibold">Thu thập ca bệnh</td>
                    <td class="font-weight-semibold" v-for="item in tk_kpa">{{item.kdc_qhk + item.kdc_pxk + item.kdc_tk + item.cdc_kbn_pxk + item.cdc_kbn_qhk + item.cdc_kbn_tk + item.cdc_cbn_ksxh + item.cdc_cbn_sxh}}</td>
                    <td class="font-weight-semibold">{{ttcb_tc}}</td>
                </tr>
                <tr class="table-success">
                    <td class="font-weight-semibold">1. Không có địa chỉ tại PX</td>
                    <td v-for="item in tk_kpa" class="font-weight-semibold">
                        {{item.kdc_qhk + item.kdc_pxk + item.kdc_tk}}
                    </td>
                    <td class="font-weight-semibold">{{kdc}}</td>
                </tr>
                <tr>
                    <td>Không tìm được địa chỉ</td>
                    <td v-for="item in tk_kpa">{{item.kdc_tk}}</td>
                    <td>{{sumCols('kdc_tk')}}</td>
                </tr>
                <tr class="table-success">
                    <td>2. Có địa chỉ - không BN</td>
                    <td v-for="item in tk_kpa">{{item.cdc_kbn_pxk + item.cdc_kbn_qhk + item.cdc_kbn_tk}}</td>
                    <td>{{cdc_kbn}}</td>
                </tr>
                <tr>
                    <td>Ca bệnh ở tỉnh khác/không biết</td>
                    <td v-for="item in tk_kpa">{{item.cdc_kbn_tk}}</td>
                    <td>{{sumCols('cdc_kbn_tk')}}</td>
                </tr>
                <tr class="table-success">
                    <td class="font-weight-semibold">3. Có địa chỉ có BN</td>
                    <td v-for="item in tk_kpa" class="font-weight-semibold">{{item.cdc_cbn_ksxh + item.cdc_cbn_sxh}}</td>
                    <td class="font-weight-semibold">{{ cdc_cbn }}</td>
                </tr>
                <tr>
                    <td>K. phải SXH</td>
                    <td v-for="item in tk_kpa">{{item.cdc_cbn_ksxh}}</td>
                    <td>{{sumCols('cdc_cbn_ksxh')}}</td>
                </tr>
                <tr>
                    <td>SXH</td>
                    <td v-for="item in tk_kpa">{{item.cdc_cbn_sxh}}</td>
                    <td>{{sumCols('cdc_cbn_sxh')}}</td>
                </tr>
            </table>

        </div>
    </div>

    <div class="text-right mt-2">
        <a download="ThongKeSXH.xls" href="#" onclick="return ExcellentExport.excel(this, 'table-tkcabenh', 'Báo cáo');" class="btn btn-primary">Xuất Excel <i class="icon-arrow-right14 position-right"></i></a>
    </div>

    <script !src="">
        new Vue({
            el: '#tkcabenh',
            data: {
                cap: <?= isset($model->dataTK['cap']) ? json_encode($model->dataTK['cap']) :  '{}' ?>,
                tk_kpa: <?= isset($model->dataTK['tk_kpa']) ? json_encode($model->dataTK['tk_kpa']) : '{}'?>,
            },
            computed: {
                kdc : function(){
                    return this.sumCols('kdc_qhk') + this.sumCols('kdc_pxk') + this.sumCols('kdc_tk');
                },
                cdc_kbn: function(){
                    return this.sumCols('cdc_kbn_pxk') + this.sumCols('cdc_kbn_qhk') + this.sumCols('cdc_kbn_tk')
                },
                cdc_cbn: function(){
                    return this.sumCols('cdc_cbn_ksxh') + this.sumCols('cdc_cbn_sxh');
                },
                ttcb_tc: function(){
                    return this.kdc + this.cdc_kbn + this.cdc_cbn;
                }
            },
            methods: {
                sumCols: function(name){
                    return  _.sumBy(this.tk_kpa, name);
                }
            }
        })
    </script>

<?php endif; ?>