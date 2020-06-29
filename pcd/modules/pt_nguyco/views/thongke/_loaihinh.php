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
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.dauthang | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.daxoa | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.moi | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.dauthang-v.daxoa+v.moi | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.gs | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.luot_gs | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.lq | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.dx_xp | number}}</a></td>
        <td><a target="_blank" href="/pt_nguyco/default/index">{{v.xp | number}}</a></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'dauthang')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'daxoa')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'moi')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'dauthang') - _.sumBy(resp, 'daxoa') + _.sumBy(resp, 'moi')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'gs')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'luot_gs')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'lq')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'dx_xp')}}</a></td>
        <td><a target="_blank" href="">{{_.sumBy(resp, 'xp')}}</a></td>
    </tr>
    </tfoot>
</table>

