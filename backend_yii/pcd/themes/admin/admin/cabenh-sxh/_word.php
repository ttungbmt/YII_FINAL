<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04-Sep-18
 * Time: 3:39 PM
 */

?>

<script src="<?= url('/pcd/assets/js/docxtemplater.js') ?>"></script>
<script src="<?= url('/pcd/assets/js/jszip.js') ?>"></script>
<script src="<?= url('/pcd/assets/js/files-saver.js') ?>"></script>
<script src="<?= url('/pcd/assets/js/jszip-utils.js') ?>"></script>

<script>
    function loadFile(url, callback) {
        JSZipUtils.getBinaryContent(url, callback);
    }

    loadFile("<?= url('/pcd/storage/samples/phieudieutra.docx') ?>", function (error, content) {
        if (error) {
            throw error
        }

        var zip = new JSZip(content);
        var doc = new Docxtemplater().loadZip(zip)
        doc.setData({
            tenquan: <?= json_encode($sxh->tenquan ? $sxh->tenquan : "") ?>,
            tenphuong: <?= json_encode($sxh->tenphuong ? $sxh->tenphuong : "") ?>,
            shs: <?= json_encode($sxh->shs ? $sxh->shs : "") ?>,
            ngaynhanthongbao: <?= json_encode($sxh->ngaynhanthongbao ? $sxh->ngaynhanthongbao : "") ?>,
            ngaydieutra: <?= json_encode($sxh->ngaydieutra ? $sxh->ngaydieutra : "") ?>,
            hoten: <?= json_encode($sxh->hoten ? $sxh->hoten : "") ?>,
            phai: <?= json_encode($sxh->phai ? $sxh->phai : "") ?>,
            ngaysinh: <?= json_encode($sxh->ngaysinh ? $sxh->ngaysinh : "") ?>,
            tuoi: <?= json_encode($sxh->tuoi ? $sxh->tuoi : "") ?>,
            is_diachi: "",
            is_benhnhan: "",
            dienthoai: <?= json_encode($sxh->dienthoai ? $sxh->dienthoai : "") ?>,
            vitri: <?= json_encode($sxh->vitri ? $sxh->vitri : "") ?>,
            sonha: <?= json_encode($sxh->sonha ? $sxh->sonha : "") ?>,
            duong: <?= json_encode($sxh->duong ? $sxh->duong : "") ?>,
            to_dp: <?= json_encode($sxh->to_dp ? $sxh->to_dp : "") ?>,
            khupho: <?= json_encode($sxh->khupho ? $sxh->khupho : "") ?>,
            tinh: <?= json_encode($sxh->tinh ? $sxh->tinh : "") ?>,
            qh_xm: <?= json_encode($sxh->qh_xm ? $sxh->qh_xm : "") ?>,
            px_xm: <?= json_encode($sxh->px_xm ? $sxh->px_xm : "") ?>,
            songuoicutru: <?= json_encode($sxh->songuoicutru ? $sxh->songuoicutru : "") ?>,
            cutruduoi15: <?= json_encode($sxh->cutruduoi15 ? $sxh->cutruduoi15 : "") ?>,
            tpbv: <?= json_encode($sxh->tpbv ? $sxh->tpbv : "") ?>,
            tpbv_bv: <?= json_encode($sxh->tpbv_bv ? $sxh->tpbv_bv : "") ?>,
            phcd: <?= json_encode($sxh->phcd ? $sxh->phcd : "") ?>,
            nhapvien: <?= json_encode($sxh->nhapvien ? $sxh->nhapvien : "") ?>,
            nhapvien_bv: <?= json_encode($sxh->nhapvien_bv ? $sxh->nhapvien_bv : "") ?>,
            ngaymacbenh_nv: <?= json_encode($sxh->ngaymacbenh_nv ? $sxh->ngaymacbenh_nv : "") ?>,
            ngaynhapvien: <?= json_encode($sxh->ngaynhapvien ? $sxh->ngaynhapvien : "") ?>,
            xetnghiem: <?= json_encode($sxh->xetnghiem ? $sxh->xetnghiem : "") ?>,
            ngaylaymau: <?= json_encode($sxh->ngaylaymau ? $sxh->ngaylaymau : "") ?>,
            loai_xn: <?= json_encode($sxh->loai_xn ? $sxh->loai_xn : "") ?>,
            ketqua_xn: <?= json_encode($sxh->ketqua_xn ? $sxh->ketqua_xn : "") ?>,
            nghenghiep: <?= json_encode($sxh->nghenghiep ? $sxh->nghenghiep : "") ?>,
            dclamviec: <?= json_encode($sxh->dclamviec ? $sxh->dclamviec : "") ?>,
            dclamviec_tinh: <?= json_encode($sxh->dclamviec_tinh ? $sxh->dclamviec_tinh : "") ?>,
            dclamviecqh: <?= json_encode($sxh->ten_dclamviecqh ? $sxh->ten_dclamviecqh : "") ?>,
            dclamviecpx: <?= json_encode($sxh->ten_dclamviecpx ? $sxh->ten_dclamviecpx : "") ?>,
            noilamviec_sxh_co: <?= json_encode($sxh->noilamviec_sxh === 1 ? 1 : "") ?>,
            noilamviec_sxh_khong: <?= json_encode($sxh->noilamviec_sxh === 0 ? 1 : "") ?>,
            noilamviec_sxh_khongro: <?= json_encode($sxh->noilamviec_sxh === 9 ? 1 : "") ?>,
            nhacobnsxh_co: <?= json_encode($sxh->nhacobnsxh === 1 ? 1 : "") ?>,
            nhacobnsxh_khong: <?= json_encode($sxh->nhacobnsxh === 0 ? 1 : "") ?>,
            nhaconguoibenh_co: <?= json_encode($sxh->nhaconguoibenh === 1 ? 1 : "") ?>,
            nhaconguoibenh_khon: <?= json_encode($sxh->nhaconguoibenh === 0 ? 1 : "") ?>,
            bvpk_co: <?= json_encode($sxh->bvpk === 1 ? 1 : "") ?>,
            bvpk_khong: <?= json_encode($sxh->bvpk === 0 ? 1 : "") ?>,
            nhatho_co: <?= json_encode($sxh->nhatho === 1 ? 1 : "") ?>,
            nhatho_khong: <?= json_encode($sxh->nhatho === 0 ? 1 : "") ?>,
            dinh_co: <?= json_encode($sxh->dinh === 1 ? 1 : "") ?>,
            dinh_khong: <?= json_encode($sxh->dinh === 0 ? 1 : "") ?>,
            chua_co: <?= json_encode($sxh->chua === 1 ? 1 : "") ?>,
            chua_khong: <?= json_encode($sxh->chua === 0 ? 1 : "") ?>,
            congvien_co: <?= json_encode($sxh->congvien === 1 ? 1 : "") ?>,
            congvien_khong: <?= json_encode($sxh->congvien === 0 ? 1 : "") ?>,
            noihoihop_co: <?= json_encode($sxh->noihoihop === 1 ? 1 : "") ?>,
            noihoihop_khong: <?= json_encode($sxh->noihoihop === 0 ? 1 : "") ?>,
            noixd_co: <?= json_encode($sxh->noixd === 1 ? 1 : "") ?>,
            noixd_khong: <?= json_encode($sxh->noixd === 0 ? 1 : "") ?>,
            cafe_co: <?= json_encode($sxh->cafe === 1 ? 1 : "") ?>,
            cafe_khong: <?= json_encode($sxh->cafe === 0 ? 1 : "") ?>,
            noichannuoi_co: <?= json_encode($sxh->noichannuoi === 1 ? 1 : "") ?>,
            noichannuoi_khong: <?= json_encode($sxh->noichannuoi === 0 ? 1 : "") ?>,
            noibancay_co: <?= json_encode($sxh->noibancay === 1 ? 1 : "") ?>,
            noibancay_khong: <?= json_encode($sxh->noibancay === 0 ? 1 : "") ?>,
            vuaphelieu_co: <?= json_encode($sxh->vuaphelieu === 1 ? 1 : "") ?>,
            vuaphelieu_khong: <?= json_encode($sxh->vuaphelieu === 0 ? 1 : "") ?>,
            noikhac_co: <?= json_encode($sxh->noikhac === 1 ? 1 : "") ?>,
            noikhac_khong: <?= json_encode($sxh->noikhac === 0 ? 1 : "") ?>,
            noikhac_ghichu: <?= json_encode($sxh->noikhac_ghichu ? $sxh->noikhac_ghichu : "") ?>,
            diemden_px_co: <?= json_encode($sxh->diemden_px === 1 ? 1 : "") ?>,
            diemden_px_khong: <?= json_encode($sxh->diemden_px === 0 ? 1 : "") ?>,
            diemden_pxkhac_co: <?= json_encode($sxh->diemden_pxkhac === 1 ? 1 : "") ?>,
            diemden_pxkhac_khong: <?= json_encode($sxh->diemden_pxkhac === 0 ? 1 : "") ?>,
            diemden_qhkhac_co: <?= json_encode($sxh->diemden_qhkhac === 1 ? 1 : "") ?>,
            diemden_qhkhac_khong: <?= json_encode($sxh->diemden_qhkhac === 0 ? 1 : "") ?>,
            gdcosxh_co: <?= json_encode($sxh->gdcosxh === 1 ? 1 : "") ?>,
            gdcosxh_khong: <?= json_encode($sxh->gdcosxh === 0 ? 1 : "") ?>,
            gdcosxh_khongro: <?= json_encode($sxh->gdcosxh === 9 ? 1 : "") ?>,
            gdsonguoisxh: <?= json_encode($sxh->gdsonguoisxh ? $sxh->gdsonguoisxh : "") ?>,
            gdso15t: <?= json_encode($sxh->gdso15t ? $sxh->gdso15t : "") ?>,
            gdthuocsxh_co: <?= json_encode($sxh->gdthuocsxh === 1 ? 1 : "") ?>,
            gdthuocsxh_khong: <?= json_encode($sxh->gdthuocsxh === 0 ? 1 : "") ?>,
            gdthuocsxh_khongro: <?= json_encode($sxh->gdthuocsxh === 9 ? 1 : "") ?>,
            gdthuocsxhsonguoi: <?= json_encode($sxh->gdthuocsxhsonguoi ? $sxh->gdthuocsxhsonguoi : "") ?>,
            gdthuocsxh15t: <?= json_encode($sxh->gdthuocsxh15t ? $sxh->gdthuocsxh15t : "") ?>,
            bi: <?= json_encode($sxh->bi ? $sxh->bi : "") ?>,
            ci: <?= json_encode($sxh->ci ? $sxh->ci : "") ?>,
            cachidiem_co: <?= json_encode($sxh->cachidiem === 1 ? 1 : "") ?>,
            cachidiem_khong: <?= json_encode($sxh->cachidiem === 0 ? 1 : "") ?>,
            dietlangquang_co: <?= json_encode($sxh->dietlangquang === 1 ? 1 : "") ?>,
            dietlangquang_khong: <?= json_encode($sxh->dietlangquang === 0 ? 1 : "") ?>,
            giamsattheodoi_co: <?= json_encode($sxh->giamsattheodoi === 1 ? 1 : "") ?>,
            giamsattheodoi_khong: <?= json_encode($sxh->giamsattheodoi === 0 ? 1 : "") ?>,
            xulyonho_co: <?= json_encode($sxh->xulyonho === 1 ? 1 : "") ?>,
            xulyonho_khong: <?= json_encode($sxh->xulyonho === 0 ? 1 : "") ?>,
            cathuphat_co: <?= json_encode($sxh->cathuphat === 1 ? 1 : "") ?>,
            cathuphat_khong: <?= json_encode($sxh->cathuphat === 0 ? 1 : "") ?>,
            odichmoi_co: <?= json_encode($sxh->odichmoi === 1 ? 1 : "") ?>,
            odichmoi_khong: <?= json_encode($sxh->odichmoi === 0 ? 1 : "") ?>,
            odichcu_co: <?= json_encode($sxh->odichcu === 1 ? 1 : "") ?>,
            odichcu_khong: <?= json_encode($sxh->odichcu === 0 ? 1 : "") ?>,
            odichcu_xuly: <?= json_encode($sxh->odichcu_xuly ? $sxh->odichcu_xuly : "") ?>,
            xuly_trong: <?= json_encode($sxh->xuly === 1 ? 1 : "") ?>,
            xuly_sau: <?= json_encode($sxh->xuly === 0 ? 1 : "") ?>,
            xuly_ngay: <?= json_encode($sxh->xuly_ngay ? $sxh->xuly_ngay : "") ?>,
            xuatvien_roi: <?= json_encode($sxh->xuatvien === 1 ? 1 : "") ?>,
            xuatvien_chua: <?= json_encode($sxh->xuatvien === 0 ? 1 : "") ?>,
            xuatvien_khongro: <?= json_encode($sxh->xuatvien === 9 ? 1 : "") ?>,
            ngayxuatvien: <?= json_encode($sxh->ngayxuatvien ? $sxh->ngayxuatvien : "") ?>,
            chuandoan_sxh: <?= json_encode($sxh->chuandoan === 1 ? 1 : "") ?>,
            chuandoan_sieuvi: <?= json_encode($sxh->chuandoan === 2 ? 1 : "") ?>,
            chuandoan_bk: <?= json_encode($sxh->chuandoan === 3 ? 1 : "") ?>,
            chuandoan_khac: <?= json_encode($sxh->chuandoan_khac ? $sxh->chuandoan_khac : "") ?>,
            nguoidieutra: <?= json_encode($sxh->nguoidieutra ? $sxh->nguoidieutra : "") ?>,
            nguoidieutra_sdt: <?= json_encode($sxh->nguoidieutra_sdt ? $sxh->nguoidieutra_sdt : "") ?>,
        });

        try {
            doc.render()
        }
        catch (error) {
            var e = {
                message: error.message,
                name: error.name,
                stack: error.stack,
                properties: error.properties,
            }
            console.log(JSON.stringify({error: e}));
            throw error;
        }

        var out = doc.getZip().generate({
            type: "blob",
            mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        })
        saveAs(out, "phieudieutra.docx")
    })
</script>
