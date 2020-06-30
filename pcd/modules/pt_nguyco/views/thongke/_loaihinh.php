<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th style="min-width: 160px">
            <span v-if="loai_tk=='loaihinh'">Loại hình ĐNC</span>
            <span v-else>
                Đơn vị hành chính (<span v-if="!maquan && !maphuong">Quận huyện</span><span v-if="maquan && !maphuong">Phường xã</span><span v-if="maquan && maphuong">Khu phố</span>)
            </span>
        </th>
        <th>Số ĐNC đầu tháng</th>
        <th>Số ĐNC đã xóa</th>
        <th>Số ĐNC mới phát sinh</th>
        <th>Số ĐNC cuối tháng</th>
        <th>Điểm nguy cơ được giám sát</th>
        <th>Số lượt giám sát</th>
        <th>Số ĐNC có lăng quăng</th>
        <th>Số ĐNC có đề nghị xử phạt</th>
        <th>Số ĐNC có xử phạt</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td>{{v.name}}</td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'dauthang', v.dauthang)">{{v.dauthang | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'daxoa', v.daxoa)">{{v.daxoa | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'moi', v.moi)">{{v.moi | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'cuoithang', v.dauthang-v.daxoa+v.moi)">{{v.dauthang-v.daxoa+v.moi | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'gs', v.gs)">{{v.gs | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'luot_gs', v.luot_gs)">{{v.luot_gs | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'lq', v.lq)">{{v.lq | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'dx_xp', v.dx_xp)">{{v.dx_xp | number}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri(v.code, 'xp', v.xp)">{{v.xp | number}}</button></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'dauthang', _.sumBy(resp, 'dauthang'))">{{_.sumBy(resp, 'dauthang')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'daxoa', _.sumBy(resp, 'daxoa'))">{{_.sumBy(resp, 'daxoa')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'moi', _.sumBy(resp, 'moi'))">{{_.sumBy(resp, 'moi')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'cuoithang', _.sumBy(resp, 'dauthang') - _.sumBy(resp, 'daxoa') + _.sumBy(resp, 'moi'))">{{_.sumBy(resp, 'dauthang') - _.sumBy(resp, 'daxoa') + _.sumBy(resp, 'moi')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'gs', _.sumBy(resp, 'gs'))">{{_.sumBy(resp, 'gs')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'luot_gs', _.sumBy(resp, 'luot_gs'))">{{_.sumBy(resp, 'luot_gs')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'lq', _.sumBy(resp, 'lq'))">{{_.sumBy(resp, 'lq')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'dx_xp', _.sumBy(resp, 'dx_xp'))">{{_.sumBy(resp, 'dx_xp')}}</button></td>
        <td><button class="btn btn-link" @click="getLoaihinhUri('', 'xp', _.sumBy(resp, 'xp'))">{{_.sumBy(resp, 'xp')}}</button></td>
    </tr>
    </tfoot>
</table>

