<?= $this->render('_error', ['model' => $model, 'errors' => $model->getErrors()]);?>
<?php if(empty($model->getFirstErrors())): ?>

<div id="tkcabenh">
    <div class="table-responsive">
        <table id="table-tkcabenh" class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Thông tin ca bệnh</th>
                    <th style="text-align: center" v-if="cap=='quan'" v-for="item in tk_kpa">PX</th>
                    <th style="text-align: center" v-if="cap=='phuong'" v-for="item in tk_kpa">KP - ấp</th>
                    <th style="text-align: center" rowspan="2">Tổng cộng</th>
                </tr>
                <tr>
                    <th style="text-align: center" v-if="" v-for="item in cb">{{item.khupho1}}</th>
                    <th style="text-align: center" v-if="cap=='quan'" v-for="item in tk_kpa">{{item.ten_px}}</th>
                    <th style="text-align: center" v-if="cap=='phuong'" v-for="item in tk_kpa">{{item.khupho1 ? item.khupho1 : 'KHONG RO'}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold">Thu thập ca bệnh</td>
                    <td style="font-weight: bold" v-for="item in tk_kpa">{{item.kdc_qhk + item.kdc_pxk + item.kdc_tk + item.cdc_kbn_pxk + item.cdc_kbn_qhk + item.cdc_kbn_tk + item.cdc_cbn_sot + item.cdc_cbn_benhkhac + item.cdc_cbn_sxh}}</td>
                    <td style="font-weight: bold" >{{ttcb_tc}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">1. Không có địa chỉ tại PX</td>
                    <td style="font-weight: bold" v-for="i in tk_kpa">
                        {{i.kdc_qhk + i.kdc_pxk + i.kdc_tk}}
                    </td>
                    <td style="font-weight: bold">{{kdc}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ ở PX khác trong QH</td>
                    <td v-for="item in tk_kpa">{{item.kdc_qhk}}</td>
                    <td>{{sumCols('kdc_qhk')}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ ở QH khác</td>
                    <td v-for="item in tk_kpa">{{item.kdc_pxk}}</td>
                    <td>{{sumCols('kdc_pxk')}}</td>
                </tr>
                <tr>
                    <td>Không tìm được địa chỉ</td>
                    <td v-for="item in tk_kpa">{{item.kdc_tk}}</td>
                    <td>{{sumCols('kdc_tk')}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">2. Có địa chỉ - không BN</td>
                    <td style="font-weight: bold" v-for="item in tk_kpa">{{item.cdc_kbn_pxk + item.cdc_kbn_qhk + item.cdc_kbn_tk}}</td>
                    <td style="font-weight: bold">{{cdc_kbn}}</td>
                </tr>
                <tr>
                    <td>Ca bệnh ở PX khác trong QH</td>
                    <td v-for="item in tk_kpa">{{item.cdc_kbn_pxk}}</td>
                    <td>{{sumCols('cdc_kbn_pxk')}}</td>
                </tr>
                <tr>
                    <td>Ca bệnh ở QH khác</td>
                    <td v-for="item in tk_kpa">{{item.cdc_kbn_qhk}}</td>
                    <td>{{sumCols('cdc_kbn_qhk')}}</td>
                </tr>
                <tr>
                    <td>Ca bệnh ở tỉnh khác/không biết</td>
                    <td v-for="item in tk_kpa">{{item.cdc_kbn_tk}}</td>
                    <td>{{sumCols('cdc_kbn_tk')}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">3. Có địa chỉ có BN</td>
                    <td style="font-weight: bold" v-for="item in tk_kpa">{{item.cdc_cbn_sot + item.cdc_cbn_benhkhac + item.cdc_cbn_sxh}}</td>
                    <td style="font-weight: bold">{{ cdc_cbn }}</td>
                </tr>
                <tr>
                    <td>K. phải SXH</td>
                    <td v-for="item in tk_kpa">{{item.cdc_cbn_sot + item.cdc_cbn_benhkhac}}</td>
                    <td>{{sumCols('cdc_cbn_sot') + sumCols('cdc_cbn_benhkhac')}}</td>
                </tr>
                <tr>
                    <td>SXH</td>
                    <td v-for="item in tk_kpa">{{item.cdc_cbn_sxh}}</td>
                    <td>{{sumCols('cdc_cbn_sxh')}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="text-right mt-20">
    <a download="ThongKeSXH.xls" href="#" onclick="return ExcellentExport.excel(this, 'table-tkcabenh', 'Báo cáo');" class="btn btn-primary">Xuất Excel <i class="icon-arrow-right14 position-right"></i></a>
    <!--    <button id="btnExportExcel" class="btn btn-primary">Xuất Excel <i class="icon-arrow-right14 position-right"></i></button>-->
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
                return this.sumCols('cdc_cbn_sot') + this.sumCols('cdc_cbn_benhkhac') +  this.sumCols('cdc_cbn_sxh');
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

<script !src="">

    $(function () {
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
            return function(table, name) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                window.location.href = uri + base64(format(template, ctx))
            }
        })()


        $("#btnExportExcel").click(function(e) {
//            tableToExcel('table-tkcabenh', 'ThongKeSXH');
//            window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('#tkcabenh').html()));
//            e.preventDefault();
        });
    });


</script>
