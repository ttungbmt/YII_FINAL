<div id="tkcabenh" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">
                    <b><?=reset($tksxh)['ten_qh']?></b>
                    <b> - <?=reset($tksxh)['ten_px']?></b>
                </h5>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table-tkcabenh" class="table table-bordered">
                        <thead>

                        <tr>
                            <th rowspan="2" class="bold">Thông tin ca bệnh</th>
                            <th v-for="item in cb">KP - ấp</th>
                            <th rowspan="2" class="bold">Tổng cộng</th>
                        </tr>
                        <tr>
                            <th v-for="item in cb">{{item.khupho1}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td class="bold">Thu thập ca bệnh</td>
                            <td v-for="n in cb.length"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="bold">1. Không có địa chỉ tại PX</td>
                            <td v-for="item in cb">{{item.kdc_pxk}}</td>
                            <td>{{sumCols('kdc_pxk')}}</td>

                        </tr>
                        <tr>
                            <td>Địa chỉ ở PX khác trong QH</td>
                            <td v-for="item in cb">{{item.kdc_qhk}}</td>
                            <td>{{sumCols('kdc_qhk')}}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ ở QH khác</td>
                            <td v-for="item in cb">{{item.kdc_pxk}}</td>
                            <td>{{sumCols('kdc_pxk')}}</td>
                        </tr>
                        <tr>
                            <td>Không tìm được địa chỉ</td>
                            <td v-for="item in cb">{{item.kdc_tk}}</td>
                            <td>{{sumCols('kdc_tk')}}</td>
                        </tr>
                        <tr>
                            <td class="bold">2. Có địa chỉ - không BN</td>
                            <td v-for="n in cb.length"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Ca bệnh ở PX khác trong QH</td>
                            <td v-for="item in cb">{{item.cdc_kbn_pxk}}</td>
                            <td>{{sumCols('cdc_kbn_pxk')}}</td>
                        </tr>
                        <tr>
                            <td>Ca bệnh ở QH khác</td>
                            <td v-for="item in cb">{{item.cdc_kbn_qhk}}</td>
                            <td>{{sumCols('cdc_kbn_qhk')}}</td>
                        </tr>
                        <tr>
                            <td>Ca bệnh ở tỉnh khác/không biết</td>
                            <td v-for="item in cb">{{item.cdc_kbn_tk}}</td>
                            <td>{{sumCols('cdc_kbn_tk')}}</td>
                        </tr>
                        <tr>
                            <td class="bold">3. Có địa chỉ có BN</td>
                            <td v-for="n in cb.length"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>K. phải SXH</td>
                            <td v-for="item in cb">{{item.cdc_cbn_ksxh}}</td>
                            <td>{{sumCols('cdc_cbn_ksxh')}}</td>
                        </tr>
                        <tr>
                            <td>SXH</td>
                            <td v-for="item in cb">{{item.cdc_cbn_sxh}}</td>
                            <td>{{sumCols('cdc_cbn_sxh')}}</td>
                        </tr>
                        <tr>
                            <td class="bold">Tổng cộng</td>
                            <td v-for="n in cb.length"></td>
                            <td></td>
                        </tr>

                    </table>

                </div>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<script !src="">
    Vue.config.debug = true
    var home = new Vue({
//        parent: vm,
        el: '#tkcabenh',
        data: {
            cb: <?= json_encode($tksxh) ?>
        },
        methods: {
            sumCols: function(name){
                return  _.sumBy(this.cb, name);
            }
        }
    })
</script>
