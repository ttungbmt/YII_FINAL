// This is included with the Parsley library itself,
// thus there is no use in adding it to your project.


Parsley.addMessages('vi', {
  defaultMessage: "Giá trị nhập không hợp lệ.",
  type: {
    email:        "Email không hợp lệ.",
    url:          "Url không hợp lệ.",
    number:       "Số không hợp lệ.",
    integer:      "Giá trị nhập phải là số nguyên.",
    digits:       "This value should be digits.",
    alphanum:     "This value should be alphanumeric."
  },
  notblank:       "Không được bỏ trống.",
  required:       "Yêu cầu nhập giá trị.",
  pattern:        "Giá trị không hợp lệ.",
  min:            "Giá trị nhập phải lớn hơn hoặc bằng %s. %s.",
  max:            "Giá trị nhập phải nhỏ hơn hoặc bằng %s.",
  range:          "This value should be between %s and %s.",
  minlength:      "Giá trị quá ngắn. %s ký tự hoặc nhiều hơn.",
  maxlength:      "Giá trị quá dài. %s ký tự hoặc ít hơn.",
  length:         "Độ dài giá trị không hợp lệ. Độ dài ký tự trong khoảng %s và %s.",
  mincheck:       "You must select at least %s choices.",
  maxcheck:       "You must select %s choices or fewer.",
  check:          "You must select between %s and %s choices.",
  equalto:        "Giá trị không khớp."
});

Parsley.setLocale('vi');
