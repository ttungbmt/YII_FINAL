<table id="tb-export" class="table table-sm table-bordered" style="min-width: 1640px">
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên ĐNC</th>
        <th>Địa chỉ</th>
        <th>QH</th>
        <th>PX</th>
        <th>Nhóm</th>
        <th style="width: 300px">Loại hình</th>
        <th v-for="m in _.range(1, 13)">T{{m}}</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td><a :href="`/pt_nguyco/default/update?id=${v.gid}`" target="_blank">{{v.ten_cs}}</a></td>
        <td>{{v.diachi}}</td>
        <td>{{v.tenquan}}</td>
        <td>{{v.tenphuong}}</td>
        <td>{{v.nhom}}</td>
        <td>{{v.loaihinh}}</td>
        <td v-for="m in _.range(1, 13)">{{_.chain(v.giamsats).find({month: m}).get('count').value()}}</td>
    </tr>
    </tbody>
</table>

