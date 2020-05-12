<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th>Loại hình</th>
        <th>Số lượng</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td>{{v.loaihinh}}</td>
        <td>{{v.count}}</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td>{{_.sumBy(resp, 'count')}}</td>
    </tr>
    </tfoot>
</table>