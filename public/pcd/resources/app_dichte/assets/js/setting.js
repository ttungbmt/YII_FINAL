var chartColumn = {
  theme: "cms",
  language: "vi",
  type: "serial",
  //Style
  fontFamily: "Roboto",
  color: "#282830",
  fontSize: 12,

  numberFormatter: {precision:1, decimalSeparator:'.', thousandsSeparator:','},

  //3D
  depth3D: 3,

  //rotate: true,
  startDuration: 1.5,
  categoryAxis: {
    gridPosition: "start",
    labelRotation: 45,
  },
  guides: [],
  allLabels: [],
  balloon: {},
  legend: {
    enabled: true,
    useGraphSettings: true
  },
  chartScrollbar: {
    enabled: true
  },
  trendLines: [],
};

var chartPie = {
  type: "pie",
  language: "vi",
  //Style
  fontFamily: "Roboto",
  color: "#282830",
  fontSize: 12,

  angle: 12,
  balloonText: "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  depth3D: 5,
  allLabels: [],
  balloon: {},
  colors: [
    "#2CC990",
    "#EEE657",
    "#FCB941",
    "#FC6042",
    "#41F1EA"
  ],
}

$(function() {

  $('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "vi",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
  });




});

