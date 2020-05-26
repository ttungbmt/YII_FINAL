WITH gs AS (
SELECT
	pt_nguyco_id,
	MAX(CASE WHEN ngay_gs IS NOT NULL THEN 1 END) gs,
	COUNT(CASE WHEN TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' THEN 1 END) luot_gs,
	MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' AND vc_lq = 1) THEN 1 END) lq,
	MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' AND dexuat_xp = 1) THEN 1 END) dx_xp,
	MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' AND xuphat = 1) THEN 1 END) xp
	FROM phieu_gs GROUP BY pt_nguyco_id
),

dnc AS (
	SELECT
	pt.gid,
	pt.loaihinh_id,
	TO_CHAR(ngayxoa, 'MM/YYYY') mo_xoa,
	TO_CHAR(ngaycapnhat, 'MM/YYYY') mo_capnhat,
	MAX(CASE WHEN ngay_gs IS NOT NULL THEN 1 END) gs,
	COUNT(CASE WHEN TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' THEN 1 END) luot_gs,
	MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' AND vc_lq = 1) THEN 1 END) lq,
	MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' AND dexuat_xp = 1) THEN 1 END) dx_xp,
	MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '09/2020' AND xuphat = 1) THEN 1 END) xp

	FROM pt_nguyco pt
	LEFT JOIN phieu_gs pgs ON pgs.pt_nguyco_id = pt.gid
	GROUP BY 1,2,3,4
	ORDER BY 1
),
dnc_gs AS (
	SELECT
	loaihinh_id,
	(COUNT(*) - COUNT(CASE WHEN mo_xoa = '08/2020' THEN 1 END)) dauthang,
	COUNT(CASE WHEN mo_xoa = '09/2020' THEN 1 END) daxoa,
	COUNT(CASE WHEN mo_capnhat = '09/2020' THEN 1 END) moi,
	MAX(luot_gs) luot_gs,
	MAX(lq) lq,
	MAX(dx_xp) dx_xp,
	MAX(xp) xp
	FROM dnc
	GROUP BY loaihinh_id)

SELECT id, ten_lh, dnc_gs.* FROM dm_loaihinh lh
LEFT JOIN dnc_gs ON dnc_gs.loaihinh_id = lh.id
WHERE id NOT IN (20,21,22) ORDER BY id