<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th style="min-width: 160px">
            <span v-if="loai_tk=='loaihinh'">Loại hình ĐNC</span>
            <span v-else>Đơn vị hành chính</span>
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
        <td>{{v.dauthang | number}}</td>
        <td>{{v.daxoa | number}}</td>
        <td>{{v.moi | number}}</td>
        <td>{{v.dauthang-v.daxoa+v.moi | number}}</td>
        <td>{{v.gs | number}}</td>
        <td>{{v.luot_gs | number}}</td>
        <td>{{v.lq | number}}</td>
        <td>{{v.dx_xp | number}}</td>
        <td>{{v.xp | number}}</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td>{{_.sumBy(resp, 'dauthang')}}</td>
        <td>{{_.sumBy(resp, 'daxoa')}}</td>
        <td>{{_.sumBy(resp, 'moi')}}</td>
        <td>{{_.sumBy(resp, 'dauthang') - _.sumBy(resp, 'daxoa') + _.sumBy(resp, 'moi')}}</td>
        <td>{{_.sumBy(resp, 'gs')}}</td>
        <td>{{_.sumBy(resp, 'luot_gs')}}</td>
        <td>{{_.sumBy(resp, 'lq')}}</td>
        <td>{{_.sumBy(resp, 'dx_xp')}}</td>
        <td>{{_.sumBy(resp, 'xp')}}</td>
    </tr>
    </tfoot>
</table>

