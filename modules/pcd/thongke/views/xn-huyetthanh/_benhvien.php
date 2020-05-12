<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th>Bệnh viện</th>
        <th v-if="showColMon(1)">T1</th>
        <th v-if="showColMon(2)">T2</th>
        <th v-if="showColMon(3)">T3</th>
        <th v-if="showColMon(4)">T4</th>
        <th v-if="showColMon(5)">T5</th>
        <th v-if="showColMon(6)">T6</th>
        <th v-if="showColMon(7)">T7</th>
        <th v-if="showColMon(6)">T8</th>
        <th v-if="showColMon(8)">T9</th>
        <th v-if="showColMon(10)">T10</th>
        <th v-if="showColMon(11)">T11</th>
        <th v-if="showColMon(12)">T12</th>
        <th>Tổng chỉ tiêu</th>
        <th>Số mẫu đã lấy</th>
        <th>Số mẫu còn lại</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td>{{v.donvi_gui | orZero}}</td>
        <td v-if="showColMon(1)">{{v.thang1 | orZero}}</td>
        <td v-if="showColMon(2)">{{v.thang2 | orZero}}</td>
        <td v-if="showColMon(3)">{{v.thang3 | orZero}}</td>
        <td v-if="showColMon(4)">{{v.thang4 | orZero}}</td>
        <td v-if="showColMon(5)">{{v.thang5 | orZero}}</td>
        <td v-if="showColMon(6)">{{v.thang6 | orZero}}</td>
        <td v-if="showColMon(7)">{{v.thang7 | orZero}}</td>
        <td v-if="showColMon(6)">{{v.thang8 | orZero}}</td>
        <td v-if="showColMon(8)">{{v.thang9 | orZero}}</td>
        <td v-if="showColMon(10)">{{v.thang10 | orZero}}</td>
        <td v-if="showColMon(11)">{{v.thang11 | orZero}}</td>
        <td v-if="showColMon(12)">{{v.thang12 | orZero}}</td>
        <td>{{v.chitieu}}</td>
        <td>{{v.count}}</td>
        <td>{{v.chitieu-v.count}}</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td v-if="showColMon(1)">{{_.sumBy(resp, 'thang1')}}</td>
        <td v-if="showColMon(2)">{{_.sumBy(resp, 'thang2')}}</td>
        <td v-if="showColMon(3)">{{_.sumBy(resp, 'thang3')}}</td>
        <td v-if="showColMon(4)">{{_.sumBy(resp, 'thang4')}}</td>
        <td v-if="showColMon(5)">{{_.sumBy(resp, 'thang5')}}</td>
        <td v-if="showColMon(6)">{{_.sumBy(resp, 'thang6')}}</td>
        <td v-if="showColMon(7)">{{_.sumBy(resp, 'thang7')}}</td>
        <td v-if="showColMon(6)">{{_.sumBy(resp, 'thang8')}}</td>
        <td v-if="showColMon(8)">{{_.sumBy(resp, 'thang9')}}</td>
        <td v-if="showColMon(10)">{{_.sumBy(resp, 'thang10')}}</td>
        <td v-if="showColMon(11)">{{_.sumBy(resp, 'thang11')}}</td>
        <td v-if="showColMon(12)">{{_.sumBy(resp, 'thang12')}}</td>
        <td>{{_.sumBy(resp, 'chitieu')}}</td>
        <td>{{_.sumBy(resp, 'count')}}</td>
        <td>{{_.sumBy(resp, 'chitieu')-_.sumBy(resp, 'count')}}</td>
    </tr>
    </tfoot>
</table>