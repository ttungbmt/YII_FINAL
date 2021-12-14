<?php

use pcd\models\XacminhCb;

$newXm = (new XacminhCb())->attributes;
$xmCbs = collect($xacminhCbs)->map(function($item, $k){
    return $item->attributes;
})->all();
?>

<script src="<?= url('/libs/bower/jquery-sticky/jquery.sticky.js') ?>"></script>


<script>
    let model = <?= json_encode($model->toArray(), JSON_NUMERIC_CHECK)?>;
    let xacminhCbs = <?= json_encode($xmCbs, JSON_NUMERIC_CHECK)?>;
    let maphuong = '<?=userInfo()->ma_phuong ? userInfo()->ma_phuong : ''?>';
    let maquan = '<?=userInfo()->ma_phuong ? userInfo()->ma_quan : ''?>';
    let dm = {
        loai_dt: <?= json_encode($dm_loai_dt, JSON_NUMERIC_CHECK)?>,
        ht_dieutri: <?= json_encode($dm_ht_dieutri, JSON_NUMERIC_CHECK)?>,
        benh: <?= json_encode($dm_benh, JSON_NUMERIC_CHECK)?>,
        loaixacminh_cb: <?= json_encode($dm_xacminh_cb, JSON_NUMERIC_CHECK)?>,
    }
    let newXm = <?= json_encode($newXm, JSON_NUMERIC_CHECK)?>,
        isNew = _.isEmpty(xacminhCbs)

//    if (isNew) {
//        xacminhCbs.push(newXm)
//        xacminhCbs.push(newXm)
//    } else {
//        if (!(xacminhCbs.length % 2)) {
//            xacminhCbs.push(newXm)
//        }
//        xacminhCbs.push(newXm)
//    }

    xacminhCbs = _(xacminhCbs).map(function (v, k) {
        if (_.isNull(v.tinh)) {
            v = {...v, tinh: 'HCM'}
        }
        
        if(k == 0 && _.isNull(v.qh) && _.isNull(v.px)){
            v = {...v, qh: maquan, px: maphuong}
        }
        return {...v, qh: _.isNull(v.qh) ? '' : v.qh, px: _.isNull(v.px) ? '' : v.px}
    }).value()


    const isBlank = (str) => {
        if (_.isString(str)) {
            str = str.trim()
            return str == '' ? true : false
        }

        return _.isNull(str)
    }

    let last_idx = xacminhCbs.length - 1


    const buildAddress = (sonha1, duong1, to1, khupho1) => {
        let str = ''
        let str1 = [sonha1, duong1].join(' ').trim()
        let str2 = (to1 == null && khupho1 == null) ? '' : [to1 ? `Tổ ${to1}` : null, khupho1 ? `Khu phố ${khupho1}` : null].join(', ')
        if (str1 !== '') {
            str += ', ' + str2
        } else {
            str += str2
        }
        return str
    }

    const null2blank = (model, arr) => {
        return _.reduce(arr, (acc, v) => ({...acc, [v]: _.isNull(model[v]) ? '' : model[v]}), {})
    }

    const toRawObject = (obj) => JSON.parse(JSON.stringify(obj))

    let data = {
        is_phuong: <?=role('phuong') ? 1 : 0?>,
        maphuong,
        m: {
            ...model,
            xacminhCbs,
        },
        dm,
    }

    let app = new Vue({
        el: '#cabenhForm',
        data: toRawObject(data),
        computed: {
            shownXm(){
              return  _.map(this.m.xacminhCbs, (i, k) => {
                  if (k === last_idx) return xacminhCbs[last_idx - 1].is_benhnhan === 0 ? 1 : 0

                  if((k+1)%2 && k !== 0){
                      let nn_xm = _.get(this.m, `xacminhCbs.${k-2}`, {}),
                          n_xm = _.get(this.m, `xacminhCbs.${k-1}`, {}),
                          cond1 = n_xm.is_diachi === 0,
                          cond2 = n_xm === 1 && (n_xm.px == nn_xm.px)

                      if(cond1 || cond2){
                          return 0
                      }
                  }
                  return 1
              })
            },
            dieutra_badge() {
                let label = _.get(this.dm.loai_dt, this.m.loaidieutra)
                let color = 'warning'
                switch (this.m.loaidieutra) {
                    case 0:
                        color = 'danger';
                        break;
                    case 1:
                        color = 'warning';
                        break;
                    case 2:
                        color = 'success';
                        break;
                    case 3:
                        color = 'blue';
                        break;
                }
                return `<span class="badge bg-${color}">${label}</span>`
            },
            xacminh_cb_badge() {
                let label = _.get(this.dm.loaixacminh_cb, this.m.loai_xm_cb, 'None')

               let color = 'warning'
               return `<span class="ml-2 badge badge-flat border-${color} text-${color}">${label}</span>`
            },
            diachicuoi() {

            },
            pp_dc(){
                return  _(this.m.xacminhCbs).slice(last_idx-3).head()
            },
            ll_dc(){
                return  _(this.m.xacminhCbs).slice(last_idx-2).head()
            },
            p_dc(){
                return  _(this.m.xacminhCbs).slice(last_idx-1).head()
            },
            l_dc(){
                return  _(this.m.xacminhCbs).last()
            },
            l_key(){
                return this.m.xacminhCbs.length - 1
            },
            hide_dieutra() {
                console.log(this.pp_dc, this.ll_dc, this.p_dc, this.l_dc);
                return this.p_dc.is_benhnhan === 1 || (this.ll_dc.px == this.pp_dc.px)
            },
            btn_save() {
               let label = 'Lưu phiếu',
                   color = 'primary',
                   listPxChuyen = this.m.chuyenCas.map(i => _.toString(i.px_chuyen))

                if(this.l_dc.px && this.l_dc.px != this.p_dc.px){
                    if(_.includes(listPxChuyen, this.l_dc.px)){
                        color = 'danger'
                        label += ' & trả ca'
                    } else {
                        color = 'warning'
                        label += ' & chuyển ca'
                    }
                }

                return `<button type="submit" class="btn bg-${color}-400 btn-labeled btn-labeled-left btn-rounded"> <b><i class="icon-file-check"></i></b> ${label}</button>`
            },
            shownBtnCc(){
                let cond1 = this.ll_dc.is_diachi === 0,
                    cond2 = this.ll_dc.is_diachi === 1 && (this.ll_dc.px == this.pp_dc.px),
                    cond3 = this.is_phuong

                if(cond1 || cond2 || cond3){
                    return 0
                }

                return 1
            },
            shown_benhnoikhac(){
                return this.p_dc.is_diachi === 1 && this.p_dc.is_benhnhan === 1;
            },
            geometry(){
                let lat = $('#inpLat').val(),
                    lng = $('#inpLng').val()
                if(lat && lng){
                    return L.marker([lat, lng]).toGeoJSON().geometry
                }
                // alert('Tọa độ không hợp lệ')
                return null
            }
        },
        watch: {
            'm.xacminhCbs': {
                handler: function (val, oldVal) {
                    if (val[last_idx - 1].is_benhnhan === 0) {
                        this.shownXm[last_idx] = 1
                    } else {
                        this.shownXm[last_idx] = 0
                    }

                    if (val[last_idx - 1].is_benhnhan === 0 && val[last_idx - 1].is_diachi === 1) {

                    }

                },
                deep: true
            },
            m: {
                handler: function (val, oldVal) {
                    this.$nextTick(this.resetJs)
                },
                deep: true
            }
        },
        mounted() {
//            let wo = ['diachi1', 'benhnhan1', 'diachi2', 'benhnhan2', 'diachi3', 'benhnhan3', 'chuandoan']
//
//            this.$watch(i => _.reduce(wo, (acc, v) => ({ ...acc, [v]: _.get(i, `m.${v}`) }), {}), (v, oldVal) => {

//            })
            this.resetJs();
            $("#cabenhForm .card-header").sticky({topSpacing: 0, zIndex: 1000});
            $("#row-xn").sticky({topSpacing: 55, zIndex: 1000})

            $(() => {
                this.markers = L.markerClusterGroup()
                window.map.addLayer(this.markers)
            })
        },
        methods: {
            checkOdich(){
                alert(`Đang tìm kiếm...`)
            },
            acceptCc(id){
                console.log(id)
                $.post('/admin/cabenh-sxh/accept-cc?id='+id).then(res => {
                    if(res.status === 'OK'){
                        new Noty({
                            text: 'Đã cho phép chuyển ca',
                            type: 'success',
                            layout: 'bottomRight',
                        }).show()
                    }
                })
            },

            shown_diachi(k){
              if(!((k+1) % 2)){
                  return this.m.xacminhCbs[k].is_diachi === 1
              }
              return true
            },
            setNullAttrs(attrs) {
                _.map(attrs, (v, k) => this.m[k] = v)
            },
            resetJs() {
                $('input[data-datepicker-source]').each(function (index, dom) {
                    let {datepicker, datepickerSource, krajeeKvdatepicker} = $(dom).data()
                    if (!datepicker) {
                        $(dom).kvDatepicker(window[krajeeKvdatepicker])
                    }
                })

                $('select[data-krajee-depdrop]').each(function (index, dom) {
                    let {depdrop, krajeeDepdrop} = $(dom).data()
                    if (!depdrop) {
                        $(dom).depdrop(window[krajeeDepdrop])
                    }
                })
            },
            openTbCungnha(gid) {

                let lat = $('#inpLat').val(),
                    lng = $('#inpLng').val(),
                    geometry

                if(lat && lng){
                    geometry = L.marker([lat, lng]).toGeoJSON().geometry
                }
                $('#cungnha-content').html(`<div class="progress mb-3"> <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 100%"> </div> </div>`)
                $.post(`/admin/cabenh-sxh/cungnha`, {
                    gid, geometry
                }).done(res => {
                    $('#cungnha-content').html(res)
                    let items = []
                    $('table#tb-cungnha > tbody > tr').each(function(index){
                        let {geometry, id, hoten} = $(this).data()
                        if(geometry){
                            let coords = geometry.coordinates,
                                m = L.marker(new L.LatLng(coords[1], coords[0]))
                            m.bindTooltip(`${index+1}. ${hoten}`)
                            items.push(m)
                        }
                    })
                    this.markers.clearLayers()
                    this.markers.addLayers(items)
                }).fail(e => {
                    $('#cungnha-content').html(`<div class="alert alert-warning border-0 alert-dismissible"> <button type="button" class="close" data-dismiss="alert"><span>×</span></button> Không tìm thấy ca cùng nhà trong bán kính 100 (m)</a>. </div>`)
                })
            }
        }
    })

    /*
    1
    dc1(k), bn1(k), dc2(c), qhk
    2
    dc1(k), bn1(k), dc2(c), pxk
    3
    dc1(k), bn1(k), dc2(k)
    dc3(k), bn3(k)
    dc1(k), bn1(c) (k có TH này)
    dc3(k), bn3(c) (k có TH này)
    4
    dc1(c), bn1(k), dc2(c), pxk
    dc3(c), bn3(k), pxk
    5
    dc1(c), bn1 (k), dc2(c), qhk
    dc3(c), bn3(k), qhk
    6
    dc1(c), bn1 (k), dc2(c), tk
    dc1(c), bn1 (k), dc2(k)
    dc3(c), bn3(k), tk
    7
    dc1(c), bn1(c), xd(ksxh)
    dc3(c), bn3(c), xd(ksxh)
    8
    dc1(c), bn1(c), xd(sxh)
    dc3(c), bn3(c), xd(sxh)
    */
</script>