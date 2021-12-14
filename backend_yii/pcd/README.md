ca lỗi: 161445,150316

Lỗ hỗng: 163411

Mã PX, QH sai
SELECT gid, maquan, maphuong, px, qh, ngaybaocao FROM cabenh_sxh 
WHERE 
maphuong IS NULL AND px IS NOT NULL AND
ngaybaocao >= '2019-01-01'
ORDER BY ngaybaocao DESC 

p6 Binh thanh chuyen P.13 k có trong ds