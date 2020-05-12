<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th rowspan="2">STT</th>
        <th rowspan="2">Quận huyện</th>
        <th rowspan="2">Số lượng mẫu</th>
        <th colspan="2">Giới tính</th>
        <th colspan="5">Nhóm tuổi</th>
        <th colspan="2">Kết quả</th>
        <th v-if="loai_xn==='PCR'" colspan="4">Phân tuýp vi rút</th>
    </tr>
    <tr>
        <th>Nam</th>
        <th>Nữ</th>
        <th><=5</th>
        <th>6->10</th>
        <th>11->14</th>
        <th>15->17</th>
        <th>>=18</th>
        <th>Âm tính</th>
        <th>Dương tính</th>
        <th v-if="loai_xn==='PCR'">DEN-1</th>
        <th v-if="loai_xn==='PCR'">DEN-2</th>
        <th v-if="loai_xn==='PCR'">DEN-3</th>
        <th v-if="loai_xn==='PCR'">DEN-4</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td>{{v.tenquan}}</td>
        <td>{{v.count | orZero}}</td>
        <td>{{v.trai | orZero}}</td>
        <td>{{v.gai | orZero}}</td>
        <td>{{v.age_5 | orZero}}</td>
        <td>{{v.age_6_10 | orZero}}</td>
        <td>{{v.age_11_14 | orZero}}</td>
        <td>{{v.age_15_17 | orZero}}</td>
        <td>{{v.age_18 | orZero}}</td>
        <td>{{v.amtinh | orZero}}</td>
        <td>{{v.duongtinh | orZero}}</td>
        <td v-if="loai_xn==='PCR'">{{v.den1 | orZero}}</td>
        <td v-if="loai_xn==='PCR'">{{v.den2 | orZero}}</td>
        <td v-if="loai_xn==='PCR'">{{v.den3 | orZero}}</td>
        <td v-if="loai_xn==='PCR'">{{v.den4 | orZero}}</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td>{{_.sumBy(resp, 'count')}}</td>
        <td>{{_.sumBy(resp, 'trai')}}</td>
        <td>{{_.sumBy(resp, 'gai')}}</td>
        <td>{{_.sumBy(resp, 'age_5')}}</td>
        <td>{{_.sumBy(resp, 'age_6_10')}}</td>
        <td>{{_.sumBy(resp, 'age_11_14')}}</td>
        <td>{{_.sumBy(resp, 'age_15_17')}}</td>
        <td>{{_.sumBy(resp, 'age_18')}}</td>
        <td>{{_.sumBy(resp, 'amtinh')}}</td>
        <td>{{_.sumBy(resp, 'duongtinh')}}</td>
        <td v-if="loai_xn==='PCR'">{{_.sumBy(resp, 'den1')}}</td>
        <td v-if="loai_xn==='PCR'">{{_.sumBy(resp, 'den2')}}</td>
        <td v-if="loai_xn==='PCR'">{{_.sumBy(resp, 'den3')}}</td>
        <td v-if="loai_xn==='PCR'">{{_.sumBy(resp, 'den4')}}</td>
    </tr>
    </tfoot>
</table>